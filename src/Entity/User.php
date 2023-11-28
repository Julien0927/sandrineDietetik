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
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\ManyToMany(targetEntity: AllergenType::class, inversedBy: 'users')]
    private Collection $allergenType;

    #[ORM\ManyToMany(targetEntity: DietType::class, inversedBy: 'users')]
    private Collection $dietType;

    public function __construct()
    {
        $this->allergenType = new ArrayCollection();
        $this->dietType = new ArrayCollection();
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
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER'; 'ROLE_ADMIN'; // ROLE_USER

        
        return array_unique($roles);
    }

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection<int, AllergenType>
     */
    public function getAllergenType(): Collection
    {
        return $this->allergenType;
    }

    public function addAllergenType(AllergenType $allergenType): static
    {
        if (!$this->allergenType->contains($allergenType)) {
            $this->allergenType->add($allergenType);
        }

        return $this;
    }

    public function removeAllergenType(AllergenType $allergenType): static
    {
        $this->allergenType->removeElement($allergenType);

        return $this;
    }

    /**
     * @return Collection<int, DietType>
     */
    public function getDietType(): Collection
    {
        return $this->dietType;
    }

    public function addDietType(DietType $dietType): static
    {
        if (!$this->dietType->contains($dietType)) {
            $this->dietType->add($dietType);
        }

        return $this;
    }

    public function removeDietType(DietType $dietType): static
    {
        $this->dietType->removeElement($dietType);

        return $this;
    }

}
