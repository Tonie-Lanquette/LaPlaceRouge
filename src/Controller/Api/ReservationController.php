<?php

namespace App\Controller\Api;

use App\Manager\ReservationManager;
use App\Repository\TableRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{

    public function __construct(
        private ReservationManager $reservationManager
    ) {}



    #[Route('/reservation/api/new', name: 'app_new_reservation_api')]
    public function newReservation(Request $request, ReservationManager $reservationManager): Response
    {

        try {

            $data = json_decode($request->getContent(), true);
            $reservation = $reservationManager->newReservation($data);

            return $this->json(['status' => 'succes', 'reservation' => $reservation], Response::HTTP_CREATED, [], ['groups' => "reservation_information"]);
            //! Rajouter le mailing en plus d'un message de succes lors de la reservation (flemme atm mais a faire)

        } catch (Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[Route('/reservation/api/table', name: 'app_table_api')]
    public function testTable(Request $request): Response
    {

        try {

            $data = json_decode($request->getContent(), true);
            $date = $data['date'];
            $shift = $data['shift'];
            $table = $this->reservationManager->getRemainingTable($date, $shift);

            return $this->json(['status' => 'succes', 'tables' => $table], Response::HTTP_OK, [], [
                'groups' => "remaining_table"
            ]);
        } catch (Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }


    #[Route('/reservation/api/numberPeople', name: 'app_numberPeople_reservation_api')]
    public function numberPeople(Request $request, ReservationManager $reservationManager): Response
    {

        try {

            $data = json_decode($request->getContent(), true);
            $numberPeople = $reservationManager->numberPeople($data);

            return $this->json(['numberPeople' => $numberPeople], Response::HTTP_CREATED);
            //! Rajouter le mailing en plus d'un message de succes lors de la reservation (flemme atm mais a faire)

        } catch (Exception $e) {
            return $this->json(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
