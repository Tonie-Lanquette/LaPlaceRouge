<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['reservation_information'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['reservation_information'])]
    private ?int $numberPeople = null;

    #[ORM\Column(length: 50)]
    #[Groups(['reservation_information'])]
    private ?string $date = null;

    #[ORM\Column(length: 50)]
    #[Groups(['reservation_information'])]
    private ?string $shift = null;

    #[ORM\Column(length: 50)]
    #[Groups(['reservation_information'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    #[Groups(['reservation_information'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['reservation_information'])]
    private ?string $email = null;

    /**
     * @var Collection<int, Table>
     */
    #[ORM\ManyToMany(targetEntity: Table::class, mappedBy: 'reservations')]
    private Collection $tables;

    public function __construct()
    {
        $this->tables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberPeople(): ?int
    {
        return $this->numberPeople;
    }

    public function setNumberPeople(int $numberPeople): static
    {
        $this->numberPeople = $numberPeople;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getShift(): ?string
    {
        return $this->shift;
    }

    public function setShift(string $shift): static
    {
        $this->shift = $shift;

        return $this;
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
     * @return Collection<int, Table>
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    public function addTable(Table $table): static
    {
        if (!$this->tables->contains($table)) {
            $this->tables->add($table);
            $table->addReservations($this);
        }

        return $this;
    }

    public function removeTable(Table $table): static
    {
        if ($this->tables->removeElement($table)) {
            $table->removeReservations($this);
        }

        return $this;
    }
}
