<?php

namespace App\Entity;

use App\Entity\Constants\JobStatuses;
use App\Repository\JobRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=JobRepository::class)
 *
 * @ExclusionPolicy("all")
 */
class Job
{
    use Traits\IdentifiableTrait;
    use Traits\RemovableTrait;

    /**
     * @ORM\Column(type="string", length=150)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 1,
     *      max = 150,
     *      minMessage = "Summary must be at least {{ limit }} characters long",
     *      maxMessage = "Summary cannot be longer than {{ limit }} characters"
     * )
     *
     * @Serializer\Expose
     * @Serializer\Groups({"default", "list"})
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     *
     * @Assert\Length(
     *      min = 3,
     *      max = 500,
     *      minMessage = "Description must be at least {{ limit }} characters long",
     *      maxMessage = "Description cannot be longer than {{ limit }} characters"
     * )
     *
     * @Serializer\Expose
     * @Serializer\Groups({"default", "list"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=10)
     *
     * @Assert\NotBlank
     * @Assert\Choice(callback = "getStatuses")
     *
     * @Serializer\Expose
     * @Serializer\Groups({"default", "list"})
     */
    private $status = JobStatuses::STATUS_OPEN;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "First and last name must be at least {{ limit }} characters long",
     *      maxMessage = "Description cannot be longer than {{ limit }} characters"
     * )
     *
     * @Serializer\Expose
     * @Serializer\Groups({"default", "list"})
     */
    private $raisedBy;

    /**
     * @ORM\ManyToOne(targetEntity="Property", inversedBy="jobs")
     * @ORM\JoinColumn(name="propety_id", referencedColumnName="id")
     *
     * @Serializer\Expose
     * @Serializer\Groups({"default", "list"})
     */
    private $property;

    /**
     * Get summary
     *
     * @return string|null
     */
    public function getSummary(): ?string
    {
        return $this->summary;
    }

    /**
     * Set summary
     *
     * @param string|null $summary
     * @return $this
     */
    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string|null $description
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get sstatus
     *
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return array
     */
    public function getStatuses(): array
    {
        return JobStatuses::JOB_STATUSES;
    }

    /**
     * Get raised by
     *
     * @return string|null
     */
    public function getRaisedBy(): ?string
    {
        return $this->raisedBy;
    }

    /**
     * Set raised by
     *
     * @param string|null $raisedBy
     * @return $this
     */
    public function setRaisedBy(?string $raisedBy): self
    {
        $this->raisedBy = $raisedBy;

        return $this;
    }

    /**
     * Set property
     *
     * @param Property $property
     * @return self
     */
    public function setProperty(Property $property): Job
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property
     *
     * @return Property
     */
    public function getProperty(): ?Property
    {
        return $this->property;
    }
}
