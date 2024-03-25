<?php

namespace app\controllers;

use app\class\models\repositories\UsersRepository;
use app\services\CSRFToken;
use app\services\PasswordHash;
use app\services\PasswordVerify;
use app\services\Response;
use app\services\Sanitize;

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
    use PasswordHash;
    use PasswordVerify;

    public function homePage()
    {
        $csrfRegister = $this->CSRFToken('csrfRegister');
        $csrfLogin = $this->CSRFToken('csrfLogin');

        $viewData = [
            'csrfRegister' => $csrfRegister,
            'csrfLogin' => $csrfLogin
        ];
        $this->render('home', $viewData);
    }

    public function register()
    {
        if (isset($_POST['csrfRegister'], $_SESSION['csrfRegister']) && !empty($_POST['csrfRegister']) && !empty($_SESSION['csrfRegister']) && $_POST['csrfRegister'] === $_SESSION['csrfRegister']) {
            if (isset($_POST['firstnameRegister'], $_POST['lastnameRegister'], $_POST['mailRegister'], $_POST['passwordRegister']) && !empty($_POST['firstnameRegister']) && !empty($_POST['lastnameRegister']) && !empty($_POST['mailRegister']) && !empty($_POST['passwordRegister'])) {
                $formData = [
                    'firstname' => $_POST['firstnameRegister'],
                    'lastname' => $_POST['lastnameRegister'],
                    'mail' => $_POST['mailRegister']
                ];
                $formDataSanitize = $this->sanitize($formData);
                $passwordHash = $this->passwordHash($_POST['passwordRegister']);

                $data =  [
                    ...$formDataSanitize,
                    'passwordHash' => $passwordHash
                ];

                $this->usersRepo->create($data);
                $_SESSION['userIsConnected'] = true;
                // debug($newUser);
                // $newUser->getFirstname();


                $csrfRegister = $this->CSRFToken('csrfRegister');
                $viewData = [
                    'csrfRegister' => $csrfRegister,
                    'register' => 'register'
                ];
                $this->render('home', $viewData);
            }
        } else {
            $csrfRegister = $this->CSRFToken('csrfRegister');
            $viewData = [
                'csrfRegister' => $csrfRegister,
                'bugCSRF' => 'bugCSRF'
            ];
            $this->render('home', $viewData);
        }
    }

    public function login()
    {
        if (isset($_POST['csrfLogin']) && !empty($_POST['csrfLogin']) && $_POST['csrfLogin'] === $_SESSION['csrfLogin']) {
            if (isset($_POST['mailLogin'], $_POST['passwordLogin']) && !empty($_POST['mailLogin']) && !empty($_POST['passwordLogin'])) {
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
