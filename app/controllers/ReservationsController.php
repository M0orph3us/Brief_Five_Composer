<?php

namespace app\controllers;

use app\models\repositories\ReservationsRepository;

use app\services\Response;
use app\services\CSRFToken;
use app\services\Sanitize;
use app\services\IssetFormData;
use app\services\Constraints;

final class ReservationsController
{
    // params

    // constructor
    public function __construct()
    {
    }


    // methods
    use Response;
    use CSRFToken;
    use Sanitize;
    use IssetFormData;
    use Constraints;



    public function reservationPage()
    {
        $csrfReservation = $this->createCSRFToken('csrfReservation');
        $viewData = [
            'csrfReservation' => $csrfReservation
        ];

        $this->render('reservation', $viewData);
    }

    public function createReservation()
    {
        $reservationsRepo = new ReservationsRepository();
        $reservationsRepo->createReservation($data);

        header('Location: /Brief_Five_Composer/reservation');
    }
}
