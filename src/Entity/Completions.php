<?php

namespace App\Entity;

use App\Repository\CompletionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompletionsRepository::class)]
class Completions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'completions')]
    private ?User $user = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $completedAt = null;

    #[ORM\ManyToOne(inversedBy: 'completions')]
    private ?UserChallenges $user_challenges = null;


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

    public function getCompletedAt(): ?\DateTimeInterface
    {
        return $this->completedAt;
    }

    public function setCompletedAt(\DateTimeInterface $completedAt): static
    {
        $this->completedAt = $completedAt;

        return $this;
    }

    public function getUserChallenges(): ?UserChallenges
    {
        return $this->user_challenges;
    }

    public function setUserChallenges(?UserChallenges $user_challenges): static
    {
        $this->user_challenges = $user_challenges;

        return $this;
    }
}
