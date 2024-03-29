<?php

namespace app\controllers;

use app\models\repositories\AvailableTablesRepository;
use app\models\repositories\RelationalDataRepository;
use app\models\repositories\UsersRepository;

use app\services\Response;
use app\services\Constraints;
use app\services\CSRFToken;
use app\services\Sanitize;
use app\services\IssetFormData;
use app\services\Password;

final class UserController
{
    // params

    // constructor
    public function __construct()
    {
    }

    // methods
    use Response;
    use Constraints;
    use CSRFToken;
    use Sanitize;
    use IssetFormData;
    use Password;

    public function profilPage()
    {
        $userRepo = new UsersRepository;
        $getRelationalDataRepo = new RelationalDataRepository();

        $getReservationByUser = $getRelationalDataRepo->getReservationByUser($_SESSION['uuidUser']);
        $userProfil = $userRepo->findOne('users', 'uuid', $_SESSION['uuidUser']);

        $viewData = [
            'userProfil' => $userProfil,
            '$getReservationByUser' => $$getReservationByUser
        ];
        $this->render('profil', $viewData);
    }

    public function registerPage()
    {
        $csrfRegister = $this->createCSRFToken('csrfRegister');
        $viewData = [
            'csrfRegister' => $csrfRegister,
        ];

        $this->render('register', $viewData);
    }

    public function loginPage()
    {
        $csrfLogin = $this->createCSRFToken('csrfLogin');

        $viewData = [
            'csrfLogin' => $csrfLogin
        ];
        $this->render('login', $viewData);
    }

    public function homePage()
    {
        unset($_SESSION['csrfLogin']);
        unset($_SESSION['csrfRegister']);

        $this->render('home');
    }

    public function openingDayPage()
    {
        $openingRepo = new AvailableTablesRepository();
        $getOpeningDay = $openingRepo->findAll('opening');

        $viewData = [
            'getOpeningDay' => $getOpeningDay
        ];

        $this->render('opening_Days', $viewData);
    }

    public function userRegister()
    {
        if ($this->verifyCSRFToken($_POST['csrfRegister'], $_SESSION['csrfRegister'])) {
            if ($this->issetFormData($_POST)) {
                if ($this->notEmpty($_POST)) {
                    if ($this->minLengthConstraint($_POST['firstnameRegister'], 3) && $this->maxLengthConstraint($_POST['firstnameRegister'], 20)) {
                        $formData['firstnameRegister'] = $_POST['firstnameRegister'];
                    } else {
                        $error['firstnameLength'] = 'Your first name must be between 3 and 20 characters';
                    };
                    if ($this->minLengthConstraint($_POST['lastnameRegister'], 1) && $this->maxLengthConstraint($_POST['lastnameRegister'], 20)) {
                        $formData['lastnameRegister'] = $_POST['lastnameRegister'];
                    } else {
                        $error['lastnameLength'] = 'Your last name must be between 1 and 20 characters';
                    };
                    if ($this->minLengthConstraint($_POST['mailRegister'], 5) && $this->maxLengthConstraint($_POST['mailRegister'], 100)) {
                        $formData['mailRegister'] = $_POST['mailRegister'];
                    } else {
                        $error['mailLength'] = 'Your mail must be between 5 and 20 characters';
                    };
                    if ($this->checkDoublePassword($_POST['firstPasswordRegister'], $_POST['secondPasswordRegister'])) {
                        $password = $_POST['firstPasswordRegister'];
                    } else {
                        $error['password'] = 'Your confirmation password does not match the 1st';
                    };
                } else {
                    $error = [];
                    $error += $this->notEmpty($_POST);
                };

                if (!empty($error)) {
                    $csrfRegister = $this->createCSRFToken('csrfRegister');
                    $viewData = [
                        'csrfRegister' => $csrfRegister,
                        'error' => $error
                    ];
                    $this->render('register', $viewData);
                } else {
                    $formDataSanitize = $this->sanitize($formData);
                    $passwordHash = $this->PasswordHash($password);

                    $data =  [
                        ...$formDataSanitize,
                        'passwordHash' => $passwordHash
                    ];

                    $usersRepo = new UsersRepository();
                    $usersRepo->create($data);

                    header('Location:' . URL_HOMEPAGE);
                }
            }
        }
    }

    public function login()
    {
        if ($this->verifyCSRFToken($_POST['csrfLogin'], $_SESSION['csrfLogin'])) {
            if ($this->issetFormData($_POST)) {
                if ($this->notEmpty($_POST)) {
                    $mail = $_POST['mailLogin'];
                    $password = $_POST['passwordLogin'];
                } else {
                    $error = [];
                    $error += $this->notEmpty($_POST);
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
                            unset($_SESSION['adminIsConnected']);
                            unset($_SESSION['superAdminIsConnected']);
                            $_SESSION['userIsConnected'] = true;
                            $_SESSION['uuidUser'] = $getUser->getUuid();
                        }
                        if ($getRole === 'admin') {
                            unset($_SESSION['superAdminIsConnected']);
                            unset($_SESSION['userIsConnected']);
                            $_SESSION['adminIsConnected'] = true;
                        }
                        if ($getRole === 'super_admin') {
                            unset($_SESSION['adminIsConnected']);
                            unset($_SESSION['userIsConnected']);
                            $_SESSION['superAdminIsConnected'] = true;
                        }

                        header('Location: ' . URL_HOMEPAGE);
                    } else {
                        $error = 'This password does not match';
                        $csrfLogin = $this->createCSRFToken('csrfLogin');
                        $viewData = [
                            'wrongPassword' => $error,
                            'csrfLogin' => $csrfLogin
                        ];
                        $this->render('login', $viewData);
                    }
                }
            }
        }
    }

    public function updateProfil()
    {
        $userRepo = new UsersRepository();
        $userRepo->update($_SESSION['uuidUser'], $data);
    }

    public function deleteProfil()
    {
        $userRepo = new UsersRepository();
        $userRepo->delete('users', $_SESSION['uuidUser']);
    }




    public function logout()
    {
        session_start();
        session_destroy();

        header('Location:' . URL_HOMEPAGE);
    }
}
