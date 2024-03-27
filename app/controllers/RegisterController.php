<?php

namespace app\controllers;

use app\models\repositories\UsersRepository;
use app\services\Constraints;
use app\services\CSRFToken;
use app\services\IssetFormData;
use app\services\Password;
use app\services\Response;
use app\services\Sanitize;

final class RegisterController
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
    use Password;
    use CSRFToken;
    use IssetFormData;
    use Constraints;
    use Sanitize;

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
                    $error['empty'] = $this->notEmpty($_POST);
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
                    $passwordHash = $this->passwordHash($password);

                    $data =  [
                        ...$formDataSanitize,
                        'passwordHash' => $passwordHash
                    ];

                    $newUser = $this->usersRepo->create($data);
                    $firstname = $newUser->getFirstname();
                    $csrfRegister = $this->createCSRFToken('csrfRegister');
                    $viewData = [
                        'csrfRegister' => $csrfRegister,
                        'firstname' => $firstname
                    ];
                    $this->render('home', $viewData);
                }
            }
        }
    }

    public function registerPage()
    {
        $csrfRegister = $this->createCSRFToken('csrfRegister');

        $viewData = [
            'csrfRegister' => $csrfRegister
        ];

        $this->render('register', $viewData);
    }
}