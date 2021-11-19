<?php

namespace App\Entity;

use App\Repository\WorkEntryRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=WorkEntryRepository::class)
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class WorkEntry
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="workEntries")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var DateTime $deletedAt
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(DateTime $deletedAt): self
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    public function getAsArray(): array
    {
        $workEntry = [
            'id' => $this->id,
            'userId' => $this->user->getId(),
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'startDate' => $this->startDate
        ];

        if ($this->endDate)
            $workEntry['endDate'] = $this->endDate;

        return $workEntry;
    }
}
