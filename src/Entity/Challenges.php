<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ChallengesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChallengesRepository::class)]
#[ApiResource]
class Challenges
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $points_award = null;

    #[ORM\Column(nullable: true)]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $start_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $end_date = null;

    /**
     * @var Collection<int, UserChallenges>
     */
    #[ORM\OneToMany(targetEntity: UserChallenges::class, mappedBy: 'challenge')]
    private Collection $userChallenges;

    /**
     * @var Collection<int, Completions>
     */
    #[ORM\OneToMany(targetEntity: Completions::class, mappedBy: 'challenges')]
    private Collection $completions;

    public function __construct()
    {
        $this->userChallenges = new ArrayCollection();
        $this->completions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPointsAward(): ?int
    {
        return $this->points_award;
    }

    public function setPointsAward(int $points_award): static
    {
        $this->points_award = $points_award;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection<int, UserChallenges>
     */
    public function getUserChallenges(): Collection
    {
        return $this->userChallenges;
    }

    public function addUserChallenge(UserChallenges $userChallenge): static
    {
        if (!$this->userChallenges->contains($userChallenge)) {
            $this->userChallenges->add($userChallenge);
            $userChallenge->setChallenge($this);
        }

        return $this;
    }

    public function removeUserChallenge(UserChallenges $userChallenge): static
    {
        if ($this->userChallenges->removeElement($userChallenge)) {
            // set the owning side to null (unless already changed)
            if ($userChallenge->getChallenge() === $this) {
                $userChallenge->setChallenge(null);
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
            $completion->setChallenges($this);
        }

        return $this;
    }

    public function removeCompletion(Completions $completion): static
    {
        if ($this->completions->removeElement($completion)) {
            // set the owning side to null (unless already changed)
            if ($completion->getChallenges() === $this) {
                $completion->setChallenges(null);
            }
        }

        return $this;
    }
}
