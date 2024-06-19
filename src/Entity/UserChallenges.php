<?php

namespace App\Entity;

use App\Repository\UserChallengesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserChallengesRepository::class)]
class UserChallenges
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userChallenges')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userChallenges')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Challenges $challenge = null;

    #[ORM\Column]
    private ?bool $is_completed = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $completion_date = null;

    #[ORM\Column(nullable: true)]
    private ?int $progress = null;

    /**
     * @var Collection<int, Completions>
     */
    #[ORM\OneToMany(targetEntity: Completions::class, mappedBy: 'user_challenges')]
    private Collection $completions;

    public function __construct()
    {
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

    public function getChallenge(): ?Challenges
    {
        return $this->challenge;
    }

    public function setChallenge(?Challenges $challenge): static
    {
        $this->challenge = $challenge;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->is_completed;
    }

    public function setCompleted(bool $is_completed): static
    {
        $this->is_completed = $is_completed;

        return $this;
    }

    public function getCompletionDate(): ?\DateTimeInterface
    {
        return $this->completion_date;
    }

    public function setCompletionDate(?\DateTimeInterface $completion_date): static
    {
        $this->completion_date = $completion_date;

        return $this;
    }

    public function getProgress(): ?int
    {
        return $this->progress;
    }

    public function setProgress(?int $progress): static
    {
        $this->progress = $progress;

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
            $completion->setUserChallenges($this);
        }

        return $this;
    }

    public function removeCompletion(Completions $completion): static
    {
        if ($this->completions->removeElement($completion)) {
            // set the owning side to null (unless already changed)
            if ($completion->getUserChallenges() === $this) {
                $completion->setUserChallenges(null);
            }
        }

        return $this;
    }
}
