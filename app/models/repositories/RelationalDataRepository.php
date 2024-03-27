<?php

namespace app\models\repositories;

use app\class\Database;
use Exception;
use PDO;
use PDOException;

final class RelationalDataRepository
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