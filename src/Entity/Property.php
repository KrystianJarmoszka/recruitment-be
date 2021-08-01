<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 *
 * @ExclusionPolicy("all")
 */
class Property
{
    use Traits\IdentifiableTrait;
    use Traits\RemovableTrait;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Name must be at least {{ limit }} characters long",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters"
     * )
     *
     * @Serializer\Expose
     * @Serializer\Groups({"default", "list"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Job", mappedBy="property")
     */
    protected $jobs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Adds a job to the collection.
     *
     * @param Job $job
     * @return $this
     */
    public function addJob(Job $job): Property
    {
        if ($this->jobs->contains($job) === false) {
            $this->jobs->add($job);
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    /**
     * Sets the collection of jobs
     *
     * @param ArrayCollection $jobs
     * @return $this
     */
    public function setJobs(ArrayCollection $jobs): self
    {
        $this->jobs = $jobs;

        return $this;
    }

    /**
     * Remove job
     *
     * @param Job $job
     * @return $this
     */
    public function removeJob(Job $job): Property
    {
        $this->jobs->removeElement($job);

        return $this;
    }
}
