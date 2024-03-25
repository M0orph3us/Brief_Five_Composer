<?php

namespace app\models\repositories;

use app\class\Database;
use Exception;
use PDO;
use PDOException;

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

    // SELECT DATE_FORMAT(created_at, '%d-%m-%Y') AS formatted_date FROM your_table;

}