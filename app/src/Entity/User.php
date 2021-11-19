<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=false)
 */
class User
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var DateTime $deletedAt
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToMany(targetEntity=WorkEntry::class, mappedBy="user")
     */
    private $workEntries;

    public function __construct()
    {
        $this->workEntries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt
        ];
    }

    /**
     * @return Collection|WorkEntry[]
     */
    public function getWorkEntries(): Collection
    {
        return $this->workEntries;
    }

    public function addWorkEntry(WorkEntry $workEntry): self
    {
        if (!$this->workEntries->contains($workEntry)) {
            $this->workEntries[] = $workEntry;
            $workEntry->setUserId($this);
        }

        return $this;
    }

    public function removeWorkEntry(WorkEntry $workEntry): self
    {
        if ($this->workEntries->removeElement($workEntry)) {
            // set the owning side to null (unless already changed)
            if ($workEntry->getUserId() === $this) {
                $workEntry->setUserId(null);
            }
        }

        return $this;
    }
}
