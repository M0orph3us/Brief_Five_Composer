<?php

namespace app\controllers;

use app\models\repositories\UsersRepository;
use app\services\Response;

final class ProfilController
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

    public function profilPage()
    {
        $userProfil = $this->usersRepo->readOne();
        $viewData = [
            'userProfil' => $userProfil
        ];
        $this->render('profil', $viewData);
    }
}