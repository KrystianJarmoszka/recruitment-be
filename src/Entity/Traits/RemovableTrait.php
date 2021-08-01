<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Exclude;
use App\Entity\Constants\RemovableInterface;

/**
 * Class RemovableTrait
 * @package App\Entity\Traits
 */
trait RemovableTrait
{
    /**
     * @var integer
     *
     * @ORM\Column(name="removable", type="smallint", nullable=false)
     * @Assert\Choice(callback = "getRemovableOptions")
     *
     * @Exclude
     */
    protected $removable;

    /**
     * @ORM\PrePersist
     */
    public function setRemovableValue()
    {
        if (!isset($this->removable)) {
            $this->removable = RemovableInterface::NOT_REMOVED;
        }
    }

    /**
     * @return integer
     */
    public function getRemovable(): int
    {
        return $this->removable;
    }

    /**
     * @return bool
     */
    public function isRemoved(): bool
    {
        return $this->removable == RemovableInterface::REMOVED;
    }

    /**
     * @return array
     */
    public static function getRemovableOptions(): array
    {
        return [
            RemovableInterface::NOT_REMOVED,
            RemovableInterface::REMOVED
        ];
    }

    /**
     * @param $removable
     * @return $this
     * @throws \Exception
     */
    public function setRemovable($removable): RemovableTrait
    {
        if (!in_array($removable, self::getRemovableOptions())) {
            throw new \Exception('Invalid Removable Option');
        }

        $this->removable = $removable;

        return $this;
    }

    /**
     * @param $alias
     * @param QueryBuilder $qb
     */
    public static function hideRemoved($alias, QueryBuilder $qb)
    {
        $qb->andWhere(sprintf('%s.removable = :notRemoved', $alias))
            ->setParameter('notRemoved', RemovableInterface::NOT_REMOVED);
    }
}
