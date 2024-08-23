<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $price = null;

    /**
     * @var Collection<int, Dishies>
     */
    #[ORM\ManyToMany(targetEntity: Dishies::class, mappedBy: 'menu')]
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
            $dishy->addMenu($this);
        }

        return $this;
    }

    public function removeDishy(Dishies $dishy): static
    {
        if ($this->dishies->removeElement($dishy)) {
            $dishy->removeMenu($this);
        }

        return $this;
    }
}
