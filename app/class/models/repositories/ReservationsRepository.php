<?php

namespace app\class\models\repositories;

use app\class\Database;

final class ReservationsRepository
{
    // params
    private $db;

    // contructor
    public function __construct()
    {
        $this->db = new Database();
        $this->db = $this->db->getDb();
    }

    // CRUD

}
