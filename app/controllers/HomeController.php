<?php

namespace app\controllers;

use app\models\repositories\UsersRepository;
use app\services\CSRFToken;
use app\services\IssetFormData;
use app\services\Sanitize;
use app\services\Response;

final class HomeController
{
    // params
    private $usersRepo;

    // constructor
    public function __construct()
    {
        $this->usersRepo = new UsersRepository();
    }


    // methods
    use Response;
    use CSRFToken;
    use Sanitize;
    use IssetFormData;

    public function homePage()
    {
        $csrfLogin = $this->createCSRFToken('csrfLogin');

        $viewData = [
            'csrfLogin' => $csrfLogin
        ];
        $this->render('home', $viewData);
    }

    public function login()
    {
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header('Location: /Brief_Five_Composer/');
    }
}
