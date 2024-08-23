<?php

namespace App\Entity;

use App\Repository\TableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[UniqueEntity('number')]
    private ?int $id = null;

    #[Assert\Type(type: 'integer', message: 'Le numéro doit être écrit en chiffres.',)]
    #[Assert\NoSuspiciousCharacters]
    #[ORM\Column]
    private ?int $number = null;

    #[Assert\Type(type: 'integer', message: 'La capacité doit être écrite en chiffres.',)]
    #[Assert\NoSuspiciousCharacters]
    #[ORM\Column(length: 255)]
    private ?string $capacity = null;

    /**
     * @var Collection<int, reservation>
     */
    #[ORM\ManyToMany(targetEntity: Reservation::class, inversedBy: 'tables')]
    private Collection $reservation;

    public function __construct()
    {
        $this->reservation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getCapacity(): ?string
    {
        return $this->capacity;
    }

    public function setCapacity(string $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection<int, reservation>
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(reservation $reservation): static
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation->add($reservation);
        }

        return $this;
    }

    public function removeReservation(reservation $reservation): static
    {
        $this->reservation->removeElement($reservation);

        return $this;
    }
}
