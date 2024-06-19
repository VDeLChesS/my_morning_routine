<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RoutineActivitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoutineActivitiesRepository::class)]
#[ApiResource]
class RoutineActivities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'routineActivities')]
    private ?MorningRoutines $routine = null;

    #[ORM\ManyToOne(inversedBy: 'routineActivities')]
    private ?Activities $activity = null;

    #[ORM\Column]
    private ?int $activity_order = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @var Collection<int, Completions>
     */
    #[ORM\OneToMany(targetEntity: Completions::class, mappedBy: 'RoutineActivities')]
    private Collection $completions;

    public function __construct()
    {
        $this->completions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoutine(): ?MorningRoutines
    {
        return $this->routine;
    }

    public function setRoutine(?MorningRoutines $routine): static
    {
        $this->routine = $routine;

        return $this;
    }

    public function getActivity(): ?Activities
    {
        return $this->activity;
    }

    public function setActivity(?Activities $activity): static
    {
        $this->activity = $activity;

        return $this;
    }

    public function getActivityOrder(): ?int
    {
        return $this->activity_order;
    }

    public function setActivityOrder(int $activity_order): static
    {
        $this->activity_order = $activity_order;

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
            $completion->setRoutineActivities($this);
        }

        return $this;
    }

    public function removeCompletion(Completions $completion): static
    {
        if ($this->completions->removeElement($completion)) {
            // set the owning side to null (unless already changed)
            if ($completion->getRoutineActivities() === $this) {
                $completion->setRoutineActivities(null);
            }
        }

        return $this;
    }
}
