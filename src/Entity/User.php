<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $fname = null;

    #[ORM\Column(length: 255)]
    private ?string $lname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    /**
     * @var Collection<int, MorningRoutines>
     */
    #[ORM\OneToMany(targetEntity: MorningRoutines::class, mappedBy: 'user')]
    private Collection $morningRoutines;

    /**
     * @var Collection<int, Completions>
     */
    #[ORM\OneToMany(targetEntity: Completions::class, mappedBy: 'user')]
    private Collection $completions;

    /**
     * @var Collection<int, UserRewards>
     */
    #[ORM\OneToMany(targetEntity: UserRewards::class, mappedBy: 'user')]
    private Collection $userRewards;

    /**
     * @var Collection<int, Insights>
     */
    #[ORM\OneToMany(targetEntity: Insights::class, mappedBy: 'user')]
    private Collection $insights;

    /**
     * @var Collection<int, UserChallenges>
     */
    #[ORM\OneToMany(targetEntity: UserChallenges::class, mappedBy: 'user')]
    private Collection $userChallenges;

    public function __construct()
    {
        $this->morningRoutines = new ArrayCollection();
        $this->completions = new ArrayCollection();
        $this->userRewards = new ArrayCollection();
        $this->insights = new ArrayCollection();
        $this->userChallenges = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): static
    {
        $this->fname = $fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(string $lname): static
    {
        $this->lname = $lname;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, MorningRoutines>
     */
    public function getMorningRoutines(): Collection
    {
        return $this->morningRoutines;
    }

    public function addMorningRoutine(MorningRoutines $morningRoutine): static
    {
        if (!$this->morningRoutines->contains($morningRoutine)) {
            $this->morningRoutines->add($morningRoutine);
            $morningRoutine->setUser($this);
        }

        return $this;
    }

    public function removeMorningRoutine(MorningRoutines $morningRoutine): static
    {
        if ($this->morningRoutines->removeElement($morningRoutine)) {
            // set the owning side to null (unless already changed)
            if ($morningRoutine->getUser() === $this) {
                $morningRoutine->setUser(null);
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
            $completion->setUser($this);
        }

        return $this;
    }

    public function removeCompletion(Completions $completion): static
    {
        if ($this->completions->removeElement($completion)) {
            // set the owning side to null (unless already changed)
            if ($completion->getUser() === $this) {
                $completion->setUser(null);
            }
        }

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
            $userReward->setUser($this);
        }

        return $this;
    }

    public function removeUserReward(UserRewards $userReward): static
    {
        if ($this->userRewards->removeElement($userReward)) {
            // set the owning side to null (unless already changed)
            if ($userReward->getUser() === $this) {
                $userReward->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Insights>
     */
    public function getInsights(): Collection
    {
        return $this->insights;
    }

    public function addInsight(Insights $insight): static
    {
        if (!$this->insights->contains($insight)) {
            $this->insights->add($insight);
            $insight->setUser($this);
        }

        return $this;
    }

    public function removeInsight(Insights $insight): static
    {
        if ($this->insights->removeElement($insight)) {
            // set the owning side to null (unless already changed)
            if ($insight->getUser() === $this) {
                $insight->setUser(null);
            }
        }

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
            $userChallenge->setUser($this);
        }

        return $this;
    }

    public function removeUserChallenge(UserChallenges $userChallenge): static
    {
        if ($this->userChallenges->removeElement($userChallenge)) {
            // set the owning side to null (unless already changed)
            if ($userChallenge->getUser() === $this) {
                $userChallenge->setUser(null);
            }
        }

        return $this;
    }
}
