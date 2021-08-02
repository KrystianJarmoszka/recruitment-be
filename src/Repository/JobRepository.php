<?php

namespace App\Repository;

use App\Entity\Job;
use App\Entity\Traits\RemovableTrait;
use App\Repository\Filter\BaseFilter;
use App\Repository\Filter\JobListFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @param JobListFilter $listFilterModel
     * @return int|mixed|string
     * @throws \Exception
     */
    public function filterAndReturn(JobListFilter $listFilterModel)
    {
        $qb = $this->createQueryBuilder('e');

        if (!$listFilterModel->getPage() && !$listFilterModel->getLimit()) {
            $qb->setMaxResults(JobListFilter::LIMIT);
        }

        $this->applyFilter($qb, $listFilterModel);

        return $qb->getQuery()->getResult();
    }

    public function applyFilter(QueryBuilder $qb, JobListFilter $listFilterModel): JobRepository
    {
        $this->hideRemoved($qb);

        if ($listFilterModel->getOrder()) {
            $qb->orderBy(
                'e.id',
                $listFilterModel->getOrder()
            );
        }

        if ($listFilterModel->getSummary()) {
            $qb->andWhere('e.summary LIKE :name');
            $qb->orWhere('e.description LIKE :name');

            $qb->leftJoin('e.property', 'ep')
                ->orWhere('ep.name LIKE :name');

            $qb->setParameter(':name', sprintf('%%%s%%', $listFilterModel->getSummary()));
        }

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @return $this
     */
    public function hideRemoved(QueryBuilder $qb): JobRepository
    {
        RemovableTrait::hideRemoved('e', $qb);

        return $this;
    }
}
