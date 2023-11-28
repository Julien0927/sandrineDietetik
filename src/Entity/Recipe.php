<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe 
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $ingredients = null;

    #[ORM\Column]
    private ?int $preparationTime = null;

    #[ORM\Column]
    private ?int $cookingTime = null;

    #[ORM\Column]
    private ?int $timeOfRest = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $steps = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[ORM\Column]
    private ?bool $isAccessible = null;

    #[ORM\ManyToMany(targetEntity: AllergenType::class, inversedBy: 'recipes')]
    #[ORM\JoinTable(name: 'recipe_allergen_type')]
    private ?Collection $allergenType = null;

    #[ORM\ManyToMany(targetEntity: DietType::class, inversedBy: 'recipes')]
    #[ORM\JoinTable(name: 'recipe_diet_type')]
    private ?Collection $dietType = null;

    #[ORM\ManyToMany(targetEntity: Score::class, inversedBy: 'recipes')]
    #[ORM\JoinTable(name: 'recipe_score')]
    private Collection $note;

    public function __construct()
    {
        $this->allergenType = new ArrayCollection();
        $this->dietType = new ArrayCollection();
        $this->note = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): static
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(int $preparationTime): static
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getCookingTime(): ?int
    {
        return $this->cookingTime;
    }

    public function setCookingTime(int $cookingTime): static
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getTimeOfRest(): ?int
    {
        return $this->timeOfRest;
    }

    public function setTimeOfRest(int $timeOfRest): static
    {
        $this->timeOfRest = $timeOfRest;

        return $this;
    }

    public function getSteps(): ?string
    {
        return $this->steps;
    }

    public function setSteps(string $steps): static
    {
        $this->steps = $steps;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function isIsAccessible(): ?bool
    {
        return $this->isAccessible;
    }

    public function setIsAccessible(bool $isAccessible): static
    {
        $this->isAccessible = $isAccessible;

        return $this;
    }

    /**
     * @return Collection<int, AllergenType>
     */
    public function getAllergenType(): ?Collection
    {
        return $this->allergenType;
    }

    public function addAllergenType(?AllergenType $allergenType): static
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
    public function getDietType(): ?Collection
    {
        if($this->dietType === null){
            $this->dietType = new ArrayCollection();
        }else {
        return $this->dietType;
    }
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

    /**
     * @return Collection<int, Score>
     */
    public function getNote(): Collection
    {
        return $this->note;
    }

    public function addNote(Score $note): static
    {
        if (!$this->note->contains($note)) {
            $this->note->add($note);
        }

        return $this;
    }

    public function removeNote(Score $note): static
    {
        $this->note->removeElement($note);

        return $this;
    }

    /**
     * @return float|null
     */
    //Fonction pour calculer la moyenne des notes
    public function getAverageNote(): ?float
    {
    $totalNotes = 0;
    $numOfNotes = count($this->note);

    if ($numOfNotes === 0) {
        return null;
    }

    foreach ($this->note as $note) {
        $totalNotes += $note->getNote();
    }

    return $totalNotes / $numOfNotes;
    }

}
