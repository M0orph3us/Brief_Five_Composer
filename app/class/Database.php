<?php

namespace app\class;

use Exception;
use PDO;
use PDOException;

class Database
{
    // params
    private $db;

    // constructor
    public function __construct()
    {
        $this->connexionDB();
    }

    // methods
    private function connexionDB()
    {
        try {
            $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
            $this->db = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    public function getDb()
    {
        return $this->db;
    }


    public function initDB($urlInitDB)
    {
        $sql = file_get_contents($urlInitDB);
        try {
            $request = $this->db->prepare($sql);
            $request->execute();
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    public function initData($urlInitData)
    {
        $sql = file_get_contents($urlInitData);
        try {
            $request = $this->db->prepare($sql);
            $request->execute();
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}
