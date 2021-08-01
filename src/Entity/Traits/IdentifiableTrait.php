<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class IdentifiableTrait
 *
 * @package App\Entity\Traits
 */
trait IdentifiableTrait
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Expose
     * @Serializer\Groups({"default", "list"})
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Remove id on clone
     */
    function __clone()
    {
        $this->id = null;
    }
}
