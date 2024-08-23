<?php

namespace App\Entity;

use App\Repository\DishiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DishiesRepository::class)]
#[UniqueEntity('title')]
class Dishies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NoSuspiciousCharacters]
    #[Assert\Type(type: 'integer', message: 'Le prix doit être écrit en chiffres.',)]
    #[Assert\Positive(message: "Le prix ne peut pas être négatif.")]
    #[Assert\NotBlank(message: "Le prix ne peut pas être vide.")]
    #[ORM\Column]
    private ?int $price = null;

    #[Assert\NoSuspiciousCharacters]
    #[Assert\Length(min: 5, minMessage: "Le nom doit faire au minimum 5 caractères.", max: 255, maxMessage: "Le nom doit faire au plus 255 caractères.")]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide.")]
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[Assert\NoSuspiciousCharacters]
    #[Assert\Length(min: 5, minMessage: "La description doit faire au minimum 5 caractères.", max: 255, maxMessage: "La description doit faire au plus 255 caractères.")]
    #[Assert\NotBlank(message: "La description ne peut pas être vide.")]
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[Assert\NoSuspiciousCharacters]
    #[Assert\Url(message: "Le format attendu est un url.")]
    #[Assert\Length(min: 5, minMessage: "Le lien doit faire au minimum 5 caractères.", max: 255, maxMessage: "Le lien doit faire au plus 255 caractères.")]
    #[Assert\NotBlank(message: "Le lien ne peut pas être vide.")]
    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    #[Assert\NoSuspiciousCharacters]
    #[Assert\NotBlank(message: "La catégorie ne peut pas être vide.")]
    #[ORM\ManyToOne(inversedBy: 'dishies')]
    private ?categories $categories = null;

    /**
     * @var Collection<int, Menu>
     */
    #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'dishies')]
    private Collection $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCategories(): ?categories
    {
        return $this->categories;
    }

    public function setCategories(?categories $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): static
    {
        if (!$this->menus->contains($menu)) {
            $this->menus->add($menu);
            $menu->addDishy($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): static
    {
        if ($this->menus->removeElement($menu)) {
            $menu->removeDishy($this);
        }

        return $this;
    }
}
