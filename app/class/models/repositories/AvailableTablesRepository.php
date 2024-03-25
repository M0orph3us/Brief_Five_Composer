<?php

namespace app\class\models\repositories;

use app\class\Database;
use Exception;
use PDOException;

final class AvailableTablesRepository
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

    // /**
    //  * @param int $number
    //  * @return AvailableTables
    //  */
    // public function create(int $number): AvailableTables
    // {
    //     $sql = "INSERT INTO available_tables (quantity_tables) VALUE(:quantity_tables)";
    //     try {

    //         $params = [
    //             'quantity_tables' => $number
    //         ];

    //         $stmt = $this->db->prepare($sql);
    //         $stmt->execute($params);
    //         $stmt->closeCursor();

    //         $getUuid = $this->getUuid();
    //         $params =  [
    //             'uuid' => $getUuid
    //         ];
    //         $tables = new AvailableTables($params);
    //         return $tables;
    //     } catch (PDOException $error) {
    //         throw new Exception('Error: ' . $error->getMessage());
    //     }
    // }


    /**
     * @return int
     */
    public function readOne(): int
    {
        $sql = 'SELECT * FROM available_tables ';
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchColumn(1);
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    // /**
    //  * @return int
    //  */
    // public function readAll()
    // {
    //     $sql = "SELECT * FROM available_tables";
    //     try {
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->execute();
    //         $result = $stmt->fetchAll(PDO::FETCH_CLASS, AvailableTables::class);
    //         $stmt->closeCursor();

    //         return $result;
    //     } catch (PDOException $error) {
    //         throw new Exception('Error: ' . $error->getMessage());
    //     }
    // }

    /**
     * @param int $number
     * @return void
     */
    public function update(int $number): void
    {
        $sql = 'UPDATE available_tables SET quantity_tables = :quantity_tables';
        $params = [
            'quantity_tables' => $number
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
    // /**
    //  * @return void
    //  */
    // public function delete(): void
    // {
    //     $sql = 'DELETE FROM available_tables';

    //     try {
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->execute();
    //         $stmt->closeCursor();
    //     } catch (PDOException $error) {
    //         throw new Exception('Error: ' . $error->getMessage());
    //     }
    // }

    // /**
    //  * @return string
    //  */
    // public function getUuid(): string
    // {
    //     $sql = 'SELECT BIN_TO_UUID(uuid) AS uuid FROM available_tables';
    //     try {
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->execute();
    //         $result = $stmt->fetchColumn();
    //         $stmt->closeCursor();

    //         return $result;
    //     } catch (PDOException $error) {
    //         throw new Exception('Error: ' . $error->getMessage());
    //     }
    // }
}