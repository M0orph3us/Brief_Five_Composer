<?php
// This trait is only functional with the same structure of the app and with uuids

namespace app\services;

use Exception;
use PDO;
use PDOException;

trait SQLRequest
{

    /**
     * @param string $table
     * @return object[] | null
     */
    public function findAll(string $table): ?array
    {
        $Table = ucfirst($table);
        $sql = "SELECT $table.*, BIN_TO_UUID(uuid) AS uuid FROM $table";
        try {
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, "app\\models\\$Table");
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @param  string $table
     * @param  string $where
     * @param  string $data
     * @return object|null
     */
    public function findOne(string $table, string $where, string $data): ?object
    {
        $Table = ucfirst($table);
        $sql = "SELECT $table.*, BIN_TO_UUID(uuid) AS uuid FROM $table WHERE $where = :$where";
        $params = [
            $where => $data
        ];
        try {
            $stmt = $this->getDb()->prepare($sql);
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
     * @param  string $table
     * @param  string $uuid
     * @return void
     */
    public function delete(string $table, string $uuid): void
    {
        $sql = "DELETE FROM $table WHERE uuid = UUID_TO_BIN(:uuid)";
        $params = [
            'uuid' => $uuid
        ];
        try {
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            $_SESSION[$table . 'isDeleted'] = true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }



    /**
     * @param  string $table
     * @param  string $where
     * @param  string $data
     * @return string
     */
    public function getUuid(string $table, string $where, string $data): string
    {
        $sql = "SELECT BIN_TO_UUID(uuid) AS uuid FROM $table WHERE $where = :$where";
        $params = [
            $where => $data
        ];
        try {
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchColumn();
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}
