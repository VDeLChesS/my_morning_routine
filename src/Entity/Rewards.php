<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RewardsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RewardsRepository::class)]
#[ApiResource]
class Rewards
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    /**
     * @var Collection<int, UserRewards>
     */
    #[ORM\OneToMany(targetEntity: UserRewards::class, mappedBy: 'reward')]
    private Collection $userRewards;

    public function __construct()
    {
        $this->userRewards = new ArrayCollection();
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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
     * @return Collection<int, UserRewards>
     */
    public function getUserRewards(): Collection
    {
        return $this->userRewards;
    }

    public function addUserReward(UserRewards $userReward): static
    {
        if (!$this->userRewards->contains($userReward)) {
            $this->userRewards->add($userReward);
            $userReward->setReward($this);
        }

        return $this;
    }

    public function removeUserReward(UserRewards $userReward): static
    {
        if ($this->userRewards->removeElement($userReward)) {
            // set the owning side to null (unless already changed)
            if ($userReward->getReward() === $this) {
                $userReward->setReward(null);
            }
        }

        return $this;
    }
}
