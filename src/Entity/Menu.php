<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[UniqueEntity('name')]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NoSuspiciousCharacters]
    #[Assert\Length(min: 5, minMessage: "Le nom doit faire au minimum 5 caractères.", max: 255, maxMessage: "Le nom doit faire au plus 255 caractères.")]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide.")]
    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[Assert\NoSuspiciousCharacters]
    #[Assert\Type(type: 'integer', message: 'Le prix doit être écrit en chiffres.',)]
    #[Assert\Positive(message: "Le prix ne peut pas être négatif.")]
    #[Assert\NotBlank(message: "Le prix ne peut pas être vide.")]
    #[ORM\Column]
    private ?int $price = null;

    /**
     * @var Collection<int, Dishies>
     */
    #[Assert\NoSuspiciousCharacters]
    #[Assert\NotNull]
    #[ORM\ManyToMany(targetEntity: Dishies::class, inversedBy: 'menus')]
    private Collection $dishies;

    public function __construct()
    {
        $this->dishies = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Dishies>
     */
    public function getDishies(): Collection
    {
        return $this->dishies;
    }

    public function addDishy(Dishies $dishy): static
    {
        if (!$this->dishies->contains($dishy)) {
            $this->dishies->add($dishy);
        }

        return $this;
    }

    public function removeDishy(Dishies $dishy): static
    {
        $this->dishies->removeElement($dishy);

        return $this;
    }
}
