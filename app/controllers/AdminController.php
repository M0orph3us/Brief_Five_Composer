<?php

namespace app\controllers;

use app\models\repositories\ReservationsRepository;
use app\models\repositories\TeamsRepository;
use app\services\Response;

final class AdminController
{
    // params
    private $reservationsRepo;
    private $teamsRepo;

    // constructor
    public function __construct()
    {
        $this->reservationsRepo = new ReservationsRepository();
        $this->teamsRepo = new TeamsRepository();
    }

    // methods
    use Response;

    public function adminPage()
    {
        $allReservations = $this->reservationsRepo->readAll();
        $teams = $this->teamsRepo->readAll();

        $viewData = [
            'allReservations' => $allReservations,
            'teams' => $teams
        ];

        $this->render('admin', $viewData);
    }

    public function allTeams()
    {
        $getTeams = $this->teamsRepo;
        $getAllTeams = $getTeams->readAll();

        $viewData = [
            'getAllTeams' => $getAllTeams
        ];

        $this->render('admin', $viewData);
    }
}