<?php

namespace app\controllers;

use app\models\repositories\UsersRepository;
use app\services\Constraints;
use app\services\CSRFToken;
use app\services\IssetFormData;
use app\services\Password;
use app\services\Sanitize;
use app\services\Response;

final class HomeController
{
    // params
    private $usersRepo;

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
    use Password;

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
        if ($this->verifyCSRFToken($_POST['csrfLogin'], $_SESSION['csrfLogin'])) {
            if ($this->issetFormData($_POST)) {
                if ($this->notEmpty($_POST)) {
                    $mail = $_POST['mailLogin'];
                    $password = $_POST['passwordLogin'];
                } else {
                    $error['empty'] = $this->notEmpty($_POST);
                };

                if (!empty($error)) {
                    $csrfLogin = $this->createCSRFToken('csrfLogin');
                    $viewData = [
                        'csrfLogin' => $csrfLogin,
                        'error' => $error
                    ];
                    $this->render('home', $viewData);
                } else {
                    $mailSanitize = htmlentities($mail);
                    $userRepo = new UsersRepository();
                    $getUser = $userRepo->findOne('users', 'mail', $mailSanitize);
                    $getPasswordUser = $getUser->getPassword();
                    if (password_verify($password, $getPasswordUser)) {
                        $getRole = $getUser->getRole();
                        if ($getRole === 'user') {
                            $_SESSION['userIsConnected'] = true;
                        }
                        if ($getRole === 'admin') {
                            $_SESSION['adminIsConnected'] = true;
                        }
                        $csrfLogin = $this->createCSRFToken('csrfLogin');
                        $firstname = $getUser->getFirstname();
                        $createdDate = $getUser->getCreated_at();
                        $viewData = [
                            'csrfLogin' => $csrfLogin,
                            'firstname' => $firstname,
                            'createdAt' => $createdDate
                        ];

                        $this->render('home', $viewData);
                    } else {
                        $error = 'This password does not match';
                        $viewData = [
                            'wrongPassword' => $error
                        ];
                        $this->render('home', $viewData);
                    }
                }
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();

        header('Location: /Brief_Five_Composer/');
    }
}