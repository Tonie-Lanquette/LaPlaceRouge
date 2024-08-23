<?php

namespace App\Entity;

use App\Repository\DishiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DishiesRepository::class)]
class Dishies
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $picture = null;

    /**
     * @var Collection<int, menu>
     */
    #[ORM\ManyToMany(targetEntity: menu::class, inversedBy: 'dishies')]
    private Collection $menu;

    #[ORM\ManyToOne(inversedBy: 'dishies')]
    private ?categories $categories = null;

    public function __construct()
    {
        $this->menu = new ArrayCollection();
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

    /**
     * @return Collection<int, menu>
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(menu $menu): static
    {
        if (!$this->menu->contains($menu)) {
            $this->menu->add($menu);
        }

        return $this;
    }

    public function removeMenu(menu $menu): static
    {
        $this->menu->removeElement($menu);

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
}
