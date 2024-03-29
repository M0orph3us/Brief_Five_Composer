<?php

namespace app\controllers;

use app\models\repositories\ReservationsRepository;

use app\services\Response;
use app\services\CSRFToken;
use app\services\Sanitize;
use app\services\IssetFormData;
use app\services\Constraints;
use DateTimeImmutable;

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

        if ($this->verifyCSRFToken($_POST['csrfReservation'], $_SESSION['csrfReservation'])) {
            if ($this->issetFormData($_POST)) {
                if ($this->notEmpty($_POST)) {
                    $date = new DateTimeImmutable($_POST['reserved-on']);
                    $dateFormated = $date->format('Y-m-d');
                    $data = [
                        'uuidUsers' => $_SESSION['uuidUser'],
                        'numberOfPersons' => $_POST['number-of-person'],
                        'babyChair' => $_POST['chair-baby'],
                        'reservedOn' => $dateFormated
                    ];
                }
            }
        }
        $reservationsRepo = new ReservationsRepository();
        $reservationsRepo->createReservation($data);

        header('Location: /Brief_Five_Composer/reservation');
    }
}