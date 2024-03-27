<?php

namespace app\router;

use app\controllers\AdminController;
use app\controllers\HomeController;
use app\controllers\ProfilController;
use app\controllers\ReservationController;
use app\controllers\RegisterController;

require __DIR__ . '/../../config/configRouter.php';

class Router
{
    public static function route($uri)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($uri) {
            case URL_HOMEPAGE:
                $home = new HomeController();
                if ($method === 'POST') {
                    $home->login();
                }
                if ($method === 'GET') {
                    $home->homePage();
                }

                break;

            case URL_REGISTER:
                $register = new RegisterController();
                if ($method === 'POST') {
                    $register->userRegister();
                }
                if ($method === 'GET') {
                    $register->registerPage();
                }
                break;


            case URL_PROFILPAGE:
                $profil = new ProfilController();
                $profil->profilPage();
                break;

            case URL_RESERVATIONPAGE:
                $reservation = new ReservationController();
                break;

            case URL_ADMINPAGE:
                $admin = new AdminController();
                break;

            case URL_LOGOUT:
                $logout = new HomeController();
                $logout->logout();
                break;


            default:
                header("HTTP/1.0 404 Not Found");
                require_once __DIR__ .  "/../views/404.php";
                exit();
                break;
        }
    }
}