<?php

namespace app\controllers;

use app\models\repositories\RelationalDataRepository;
use app\models\repositories\ReservationsRepository;
use app\models\repositories\TeamsRepository;

use app\services\Constraints;
use app\services\CSRFToken;
use app\services\IssetFormData;
use app\services\Response;
use app\services\Sanitize;

final class AdminController
{
    // params

    // constructor
    public function __construct()
    {
    }

    // methods
    use Response;
    use CSRFToken;
    use Constraints;
    use IssetFormData;
    use Sanitize;


    public function adminPage()
    {

        $teamsRepo = new TeamsRepository();
        $relationalDataRepo = new RelationalDataRepository();

        $allReservationsWithTeams = $relationalDataRepo->getAllReservationsWithTeams();
        $allReservationsWithoutTeams = $relationalDataRepo->getAllResevationsWhitoutTeams();
        $allTeams = $teamsRepo->findAll('teams');

        $viewData = [
            'allteams' => $allTeams,
            'allReservationsWithTeams' => $allReservationsWithTeams,
            'allReservationsWithoutTeams' => $allReservationsWithoutTeams
        ];

        $this->render('admin', $viewData);
    }

    public function assignTeamsByReservations()
    {
        if ($this->issetFormData($_POST)) {
            $uuidTeams = $_POST['select-teams'];
            $uuidReservations = $_POST['select-reservations'];
        }
        $reservationsRepo = new ReservationsRepository();
        $reservationsRepo->assignReservation($uuidTeams, $uuidReservations);
        header('Location: ' . URL_ADMINPAGE);
    }

    public function deleteTeams()
    {
    }
}