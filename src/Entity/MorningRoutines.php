<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MorningRoutinesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MorningRoutinesRepository::class)]
#[ApiResource]
class MorningRoutines
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'morningRoutines')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?bool $active = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @var Collection<int, RoutineActivities>
     */
    #[ORM\OneToMany(targetEntity: RoutineActivities::class, mappedBy: 'routine')]
    private Collection $routineActivities;

    /**
     * @var Collection<int, Completions>
     */
    #[ORM\OneToMany(targetEntity: Completions::class, mappedBy: 'morningRoutine')]
    private Collection $completions;

    public function __construct()
    {
        $this->routineActivities = new ArrayCollection();
        $this->completions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, RoutineActivities>
     */
    public function getRoutineActivities(): Collection
    {
        return $this->routineActivities;
    }

    public function addRoutineActivity(RoutineActivities $routineActivity): static
    {
        if (!$this->routineActivities->contains($routineActivity)) {
            $this->routineActivities->add($routineActivity);
            $routineActivity->setRoutine($this);
        }

        return $this;
    }

    public function removeRoutineActivity(RoutineActivities $routineActivity): static
    {
        if ($this->routineActivities->removeElement($routineActivity)) {
            // set the owning side to null (unless already changed)
            if ($routineActivity->getRoutine() === $this) {
                $routineActivity->setRoutine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Completions>
     */
    public function getCompletions(): Collection
    {
        return $this->completions;
    }

    public function addCompletion(Completions $completion): static
    {
        if (!$this->completions->contains($completion)) {
            $this->completions->add($completion);
            $completion->setMorningRoutine($this);
        }

        return $this;
    }

    public function removeCompletion(Completions $completion): static
    {
        if ($this->completions->removeElement($completion)) {
            // set the owning side to null (unless already changed)
            if ($completion->getMorningRoutine() === $this) {
                $completion->setMorningRoutine(null);
            }
        }

        return $this;
    }
}
