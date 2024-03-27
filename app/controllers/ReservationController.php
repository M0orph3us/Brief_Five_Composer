<?php

namespace app\controllers;

use app\models\repositories\ReservationsRepository;
use app\services\Response;

final class ReservationController
{
    // params
    private $reservationsRepo;

    // constructor
    public function __construct()
    {
        $this->reservationsRepo = new ReservationsRepository();
    }

    // methods
    use Response;

    public function reservationPage()
    {
        $newReservation = $this->reservationsRepo->readAll();
        $viewData = [
            'newReservation' => $newReservation
        ];
        $this->render('reservation', $viewData);
    }
}
