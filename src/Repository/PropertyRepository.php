<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\Traits\RemovableTrait;
use App\Repository\Filter\BaseFilter;
use App\Repository\Filter\PropertyListFilter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @param PropertyListFilter $listFilterModel
     * @return int|mixed|string
     * @throws \Exception
     */
    public function filterAndReturn(PropertyListFilter $listFilterModel)
    {
        $qb = $this->createQueryBuilder('e');

        $this->applyFilter($qb, $listFilterModel);

        return $qb->getQuery()->getResult();
    }

    public function applyFilter(QueryBuilder $qb, BaseFilter $listFilterModel): PropertyRepository
    {
        $this->hideRemoved($qb);

        if ($listFilterModel->getOrder()) {
            $qb->orderBy(
                'e.id',
                $listFilterModel->getOrder()
            );
        }

        if ($listFilterModel->getName()) {
            $qb->andWhere('e.name LIKE :name');

            $qb->setParameter(':name', sprintf('%%%s%%', $listFilterModel->getName()));
        }

        return $this;
    }

    /**
     * @param QueryBuilder $qb
     * @return $this
     */
    public function hideRemoved(QueryBuilder $qb): PropertyRepository
    {
        RemovableTrait::hideRemoved('e', $qb);

        return $this;
    }
}
