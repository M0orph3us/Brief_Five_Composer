<?php

namespace app\router;

use app\controllers\AdminController;
use app\controllers\HomeController;
use app\controllers\ProfilController;
use app\controllers\ReservationController;

class Router
{
    public static function route($uri)
    {
        switch ($uri) {
            case URL_HOMEPAGE:
                $home = new HomeController();
                $home->homePage();
                break;

            case URL_REGISTER:
                $home = new HomeController();
                $home->register();
                break;

            case URL_LOGIN:
                $home = new HomeController();
                $home->login();
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
