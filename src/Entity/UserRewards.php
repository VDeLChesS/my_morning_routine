<?php

namespace App\Entity;

use App\Repository\UserRewardsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRewardsRepository::class)]
class UserRewards
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'userRewards')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'userRewards')]
    private ?Rewards $reward = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $earnedAt = null;

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

    public function getReward(): ?Rewards
    {
        return $this->reward;
    }

    public function setReward(?Rewards $reward): static
    {
        $this->reward = $reward;

        return $this;
    }

    public function getEarnedAt(): ?\DateTimeInterface
    {
        return $this->earnedAt;
    }

    public function setEarnedAt(\DateTimeInterface $earnedAt): static
    {
        $this->earnedAt = $earnedAt;

        return $this;
    }
}
