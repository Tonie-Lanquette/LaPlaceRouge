<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_dish_all', 'api_menu_all'])]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Dishies>
     */
    #[ORM\OneToMany(targetEntity: Dishies::class, mappedBy: 'categories')]
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
            $dishy->setCategories($this);
        }

        return $this;
    }

    public function removeDishy(Dishies $dishy): static
    {
        if ($this->dishies->removeElement($dishy)) {
            // set the owning side to null (unless already changed)
            if ($dishy->getCategories() === $this) {
                $dishy->setCategories(null);
            }
        }

        return $this;
    }
}
