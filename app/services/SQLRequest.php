<?php

namespace app\services;

use Exception;
use PDO;
use PDOException;

trait SQLRequest
{

    /**
     * @param string $table
     * @return object[]
     */
    public function findAll(string $table)
    {
        $Table = ucfirst($table);
        $sql = "SELECT * FROM $table";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, "app\\models\\$Table");
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @param string $table
     * @param string $where
     * @param string $data
     * @return object
     */
    public function findOne(string $table, string $where, string $data)
    {
        $Table = ucfirst($table);
        $sql = "SELECT * FROM $table WHERE $where = :$where";
        $params = [
            $where => $data
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->setFetchMode(PDO::FETCH_CLASS, "app\\models\\$Table");
            $result = $stmt->fetch();
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
    /**
     * @param string $table
     * @param string $uuid
     * @return void
     */
    public function delete(string $table, string $uuid): void
    {
        $sql = "DELETE FROM $table WHERE uuid = UUID_TO_BIN(:uuid)";
        $params = [
            'uuid' => $uuid
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @param string $table
     * @return string
     */
    public function getUuid(string $table, string $where, string $data)
    {
        $sql = "SELECT BIN_TO_UUID(uuid) AS uuid FROM $table WHERE $where = :$where";
        $params = [
            $where => $data
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchColumn();
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}