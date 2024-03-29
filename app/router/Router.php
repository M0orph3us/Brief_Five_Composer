<?php

namespace app\router;

use app\controllers\AdminController;
use app\controllers\ReservationsController;
use app\controllers\UserController;

class Router
{
    public static function route($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($uri) {
            case URL_HOMEPAGE:
                $user = new UserController();
                if ($method === 'GET') {
                    $user->homePage();
                }
                break;

            case URL_REGISTER:
                $user = new UserController();
                if ($method === 'GET') {
                    $user->registerPage();
                }
                if ($method === 'POST') {
                    $user->userRegister();
                }
                break;

            case URL_LOGIN:
                $user = new UserController();
                if ($method === 'GET') {
                    $user->loginPage();
                }
                if ($method === 'POST') {
                    $user->login();
                }
                break;

            case URL_OPENINGDAY:
                $user = new UserController();
                if ($method === 'GET') {
                    $user->openingDayPage();
                }
                break;


            case URL_PROFILPAGE:
                $user = new UserController();
                if ($method === 'GET') {
                    $user->profilPage();
                }
                if ($method === 'PUT') {
                    $user->updateProfil();
                }
                if ($method === 'DELETE') {
                    $user->deleteProfil();
                }
                break;

            case URL_RESERVATIONPAGE:
                $reservation = new ReservationsController();
                if ($method === 'GET') {
                    $reservation->reservationPage();
                }
                if ($method === 'POST') {
                    $reservation->createReservation();
                }
                break;

            case URL_ADMINPAGE:
                $admin = new AdminController();
                if ($method === 'GET') {
                    $admin->adminPage();
                }
                if ($method === 'POST') {
                    $admin->assignTeamsByReservations();
                }
                break;

            case URL_LOGOUT:
                $logout = new UserController();
                if ($method === 'GET') {
                    $logout->logout();
                }
                break;


            default:
                header("HTTP/1.0 404 Not Found");
                require_once __DIR__ .  "/../views/404.php";
                exit();
                break;
        }
    }
}