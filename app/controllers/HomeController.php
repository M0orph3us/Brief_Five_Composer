<?php

namespace app\controllers;

use app\models\repositories\UsersRepository;
use app\services\Constraints;
use app\services\CSRFToken;
use app\services\IssetFormData;
use app\services\Password;
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
    use Password;
    use Constraints;
    use IssetFormData;

    public function homePage()
    {
        $csrfRegister = $this->createCSRFToken('csrfRegister');
        $csrfLogin = $this->createCSRFToken('csrfLogin');

        $viewData = [
            'csrfRegister' => $csrfRegister,
            'csrfLogin' => $csrfLogin
        ];
        $this->render('home', $viewData);
    }

    public function register()
    {
        if ($this->verifyCSRFToken($_POST['csrfRegister'], $_SESSION['csrfRegister'])) {
            if ($this->issetFormData($_POST)) {
                if ($this->notEmpty($_POST)) {
                    if ($this->checkDoublePassword($_POST['firstPasswordRegister'], $_POST['secondPasswordRegister'])) {
                        $password = $_POST['firstPasswordRegister'];
                    } else {
                    }
                    if ($this->minLengthConstraint($_POST['firstnameRegister'], 3)) {
                    } else {
                    }
                } else {
                    $viewData['empty'] = $this->notEmpty($_POST);
                    $this->render('home', $viewData);
                }
            }
        }
        $formData = [
            'firstname' => $_POST['firstnameRegister'],
            'lastname' => $_POST['lastnameRegister'],
            'mail' => $_POST['mailRegister']
        ];
        $formDataSanitize = $this->sanitize($formData);
        $passwordHash = $this->passwordHash($password);

        $data =  [
            ...$formDataSanitize,
            'passwordHash' => $passwordHash
        ];

        $newUser = $this->usersRepo->create($data);
        debug($newUser, 0);
        debug($newUser->getFirstname());


        $csrfRegister = $this->createCSRFToken('csrfRegister');
        $viewData = [
            'csrfRegister' => $csrfRegister
        ];
        $this->render('home', $viewData);
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