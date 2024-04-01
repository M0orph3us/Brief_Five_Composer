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
        $csrfUpdate = $this->createCSRFToken('csrfUpdate');

        $viewData = [
            'csrfUpdate' => $csrfUpdate,
            'userProfil' => $userProfil,
            'getReservationByUser' => $getReservationByUser
        ];
        $this->render('profil', $viewData);
    }

    public function updateProfil()
    {
        if ($this->verifyCSRFToken($_POST['csrfUpdate'], $_SESSION['csrfUpdate'])) {
            if ($this->issetFormData($_POST)) {
                if ($this->notEmpty($_POST) === true) {
                    if ($this->minLengthConstraint($_POST['firstnameUpdate'], 3) && $this->maxLengthConstraint($_POST['firstnameUpdate'], 20)) {
                        $formData['firstname'] = $_POST['firstnameUpdate'];
                    } else {
                        $error['firstnameLength'] = 'Your first name must be between 3 and 20 characters';
                    };
                    if ($this->minLengthConstraint($_POST['lastnameUpdate'], 2) && $this->maxLengthConstraint($_POST['lastnameUpdate'], 20)) {
                        $formData['lastname'] = $_POST['lastnameUpdate'];
                    } else {
                        $error['lastnameLength'] = 'Your last name must be between 1 and 20 characters';
                    };
                    if (filter_var($_POST['mailUpdate'], FILTER_VALIDATE_EMAIL) !== false) {
                        if ($this->minLengthConstraint($_POST['mailUpdate'], 5) && $this->maxLengthConstraint($_POST['mailUpdate'], 100)) {
                            $formData['mail'] = $_POST['mailUpdate'];
                        } else {
                            $error['mailLength'] = 'Your mail must be between 5 and 20 characters';
                        };
                    } else {
                        $error['mailFormat'] = 'Your email is not in the correct format';
                    }
                    if ($this->checkDoublePassword($_POST['passwordUpdate'], $_POST['confirmPasswordUpdate'])) {
                        $password = $_POST['passwordUpdate'];
                    } else {
                        $error['password'] = 'Your confirmation password does not match the 1st';
                    };
                } else {
                    $error = [];
                    $error += $this->notEmpty($_POST);
                    debug($error);
                };
                if (!empty($error)) {
                    $csrfUpdate = $this->createCSRFToken('csrfUpdate');
                    $viewData = [
                        'csrfUpdate' => $csrfUpdate,
                        'error' => $error
                    ];
                    $this->render('profil', $viewData);
                } else {
                    $formDataSanitize = $this->sanitize($formData);
                    $passwordHash = $this->PasswordHash($password);

                    $data =  [
                        ...$formDataSanitize,
                        'password' => $passwordHash,
                        'uuid' => $_SESSION['uuidUser']
                    ];

                    $usersRepo = new UsersRepository();
                    if ($usersRepo->update('users', $data, 'uuid')) {
                        $_SESSION['isUpdated'] = true;
                        header('Location:' . URL_PROFILPAGE);
                    };
                }
            }
        }
    }

    public function deleteProfil()
    {
        $userRepo = new UsersRepository();
        $userRepo->delete('users', $_SESSION['uuidUser']);
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
        unset($_SESSION['csrfUpdate']);

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
                if ($this->notEmpty($_POST) === true) {
                    if ($this->minLengthConstraint($_POST['firstnameRegister'], 3) && $this->maxLengthConstraint($_POST['firstnameRegister'], 20)) {
                        $formData['firstname'] = $_POST['firstnameRegister'];
                    } else {
                        $error['firstnameLength'] = 'Your first name must be between 3 and 20 characters';
                    };
                    if ($this->minLengthConstraint($_POST['lastnameRegister'], 2) && $this->maxLengthConstraint($_POST['lastnameRegister'], 20)) {
                        $formData['lastname'] = $_POST['lastnameRegister'];
                    } else {
                        $error['lastnameLength'] = 'Your last name must be between 1 and 20 characters';
                    };
                    if (filter_var($_POST['mailRegister'], FILTER_VALIDATE_EMAIL) !== false) {
                        if ($this->minLengthConstraint($_POST['mailRegister'], 5) && $this->maxLengthConstraint($_POST['mailRegister'], 100)) {
                            $formData['mail'] = $_POST['mailRegister'];
                        } else {
                            $error['mailLength'] = 'Your mail must be between 5 and 20 characters';
                        };
                    } else {
                        $error['mailFormat'] = 'Your email is not in the correct format';
                    }
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
                    debug($formDataSanitize);

                    $data =  [
                        ...$formDataSanitize,
                        'password' => $passwordHash
                    ];

                    $usersRepo = new UsersRepository();
                    if ($usersRepo->create('users', $data)) {
                        $_SESSION['isRegisted'] = true;
                        header('Location:' . URL_HOMEPAGE);
                    };
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
                    if ($getUser === false) {
                        $viewData = [
                            'mailError' => 'this email does not exist'
                        ];
                        $this->render('login', $viewData);
                    } else {
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
    }


    public function logout()
    {
        session_start();
        session_destroy();

        header('Location:' . URL_HOMEPAGE);
    }
}