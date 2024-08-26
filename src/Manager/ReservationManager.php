<?php

namespace App\Manager;

use App\Entity\Reservation;
use App\Manager\SanitizerManager;
use App\Repository\ReservationRepository;
use App\Repository\TableRepository;
use Doctrine\ORM\EntityManagerInterface;

class ReservationManager
{

    public function __construct(
        private SanitizerManager $sanitizerManager,
        private ReservationRepository $reservationRepository,
        private EntityManagerInterface $entityManager,
        private TableRepository $tableRepository
    ) {}


    public function newReservation(array $data): Reservation
    {

        $firstname = $this->sanitizerManager->sanitize($data["firstname"]);
        $lastname = $this->sanitizerManager->sanitize($data["lastname"]);
        $email = $this->sanitizerManager->sanitize($data["email"]);
        $date = $data["date"];
        $shift = $data["shift"];
        $numberPeople = $data["numberPeople"];
        $numberPeople2 = $data["numberPeople"];


        $tableOf4Available = count($this->tableRepository->findBy(["capacity" => "4"]));
        $tableOf2Available = count($this->tableRepository->findBy(["capacity" => "2"]));
        $tableOf4Needed = 0;
        $tableOf2Needed = 0;

        //* Requete qui recup toutes les reservations existantes sur les memes dates et shifts-

        $remainingTables = $this->getRemainingTable($date, $shift);

        //* Boucle pour definir le nombre de table disponible pour les deux types
        foreach ($remainingTables as $tables) {
            if ($tables->getCapacity() == 4) {
                $tableOf4Available -= 1;
            }

            if ($tables->getCapacity() == 2) {
                $tableOf2Available -= 1;
            }
        }


        //* Faire le tri des tables pour n'avoir dans une variable que les tables qui sont disponibles pour le créneau demandé
        $allTablesIds = array_map(function ($table) {
            return $table->getId();
        }, $this->tableRepository->findAll());

        $remainingTablesIds = array_map(function ($table) {
            return $table->getId();
        }, $remainingTables);

        $usableTableIds = array_diff($allTablesIds, $remainingTablesIds);

        $usableTables = $this->tableRepository->findBy(['id' => $usableTableIds]);

        //*Nb de table de 4 necessaire
        while ($numberPeople >= 3 && $tableOf4Available > 0 && $tableOf4Needed <= 20) {
            $numberPeople -= 4;
            $tableOf4Available -= 1;
            $tableOf4Needed += 1;
        }

        //*Nb de table de 2 necessaire
        while ($numberPeople >= 1 && $tableOf2Available > 0 && $tableOf2Needed <= 20) {
            $numberPeople -= 2;
            $tableOf2Available -= 1;
            $tableOf2Needed += 1;
        }

        if ($numberPeople < 0) {
            $numberPeople = 0;
        }

        $reservation = new Reservation;


        $reservation->setFirstname($firstname);
        $reservation->setLastname($lastname);
        $reservation->setEmail($email);
        $reservation->setDate($date);
        $reservation->setNumberPeople($numberPeople2);
        $reservation->setShift($shift);

        //* boucle a crée pour ajouter le nombre de table necessaire et qui ne sont pas utilisées

        foreach ($usableTables as $usableTable) {
            if ($tableOf4Needed > 0 && $usableTable->getCapacity() == 4) {
                $reservation->addTable($usableTable);
                $tableOf4Needed -= 1;
            }

            if ($tableOf2Needed > 0 && $usableTable->getCapacity() == 2) {
                $reservation->addTable($usableTable);
                $tableOf2Needed -= 1;
            }
        }
        $this->entityManager->persist($reservation);
        $this->entityManager->flush();

        return $reservation;
    }


    public function getRemainingTable(string $date, string $shift): array
    {

        try {

            $qb = $this->entityManager->createQueryBuilder()
                ->select('t')
                ->from('App\Entity\Table', 't')
                ->innerJoin('t.reservations', 'r')
                ->where('r.date = :date')
                ->andWhere('r.shift =:shift')
                ->setParameter('date', $date)
                ->setParameter('shift', $shift)
                ->getQuery()
                ->getResult();

            return $qb;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
