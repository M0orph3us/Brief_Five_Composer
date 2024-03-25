<?php

namespace app\class;

use Exception;
use PDO;
use PDOException;

final class Database
{
    // params
    private $db;

    // constructor
    public function __construct()
    {
        require __DIR__ . '/../../config/configDb.php';
        $this->connexionDB($CONFIG);
    }

    // Methods
    private function connexionDB($CONFIG)
    {
        try {
            $dsn = "mysql:host=" . $CONFIG['DB_HOST'] . ";dbname=" . $CONFIG['DB_NAME'];
            $this->db = new PDO($dsn, $CONFIG['DB_USER'], $CONFIG['DB_PASSWORD'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    public function getDb()
    {
        return $this->db;
    }


    public function initDB()
    {
        $sql = file_get_contents('../SQL/initDB.sql');
        try {
            $request = $this->db->prepare($sql);
            $request->execute();
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}