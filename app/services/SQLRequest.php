<?php
// This trait is only functional with the same structure of this app and with uuid

namespace app\services;

use Exception;
use PDO;
use PDOException;

trait SQLRequest
{

    /**
     * @param  string  $table
     * @param  array   $columnsValue
     * @return boolean
     */
    public function create(string $table, array $columnsValue): bool
    {

        foreach ($columnsValue as $key => $value) {
            $columns[] = $key;
            $values[] = ":$key";
            $params[$key] = $value;
        }
        $columnsToUpdate = implode(", ", $columns);
        $valuesToCreate = implode(", ", $values);

        $sql = "INSERT INTO $table ($columnsToUpdate) VALUE($valuesToCreate)";
        try {
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            return true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
            return false;
        }
    }



    /**
     * @param string $table
     * @return object[]
     */
    public function findAll(string $table): array
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
     * @param  string $paramsData
     * @return object|false
     */
    public function findOne(string $table, string $where, string $paramsData): object | false
    {
        if ($where === 'uuid') {
            $data = "UUID_TO_BIN(:$where)";
        } else {
            $data = ":$where";
        }
        $Table = ucfirst($table);
        $sql = "SELECT $table.*, BIN_TO_UUID(uuid) AS uuid FROM $table WHERE $where = $data";
        $params = [
            $where => $paramsData
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
     * @param  string  $table
     * @param  array   $setColumnsData
     * @param  string  $where
     * @return boolean
     */
    public function update(string $table, array $setColumnsData, string $where): bool
    {
        foreach ($setColumnsData as $key => $value) {
            $params[$key] = $value;
            $columns[] = "$key = :$key";
            if ($where === 'uuid') {
                $data = "UUID_TO_BIN(:$where)";
            } else {
                $data = ":$where";
            }
        }
        $setColumns = implode(", ", $columns);
        $sql = "UPDATE $table SET $setColumns  WHERE $where = $data";
        try {
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            return true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
            return false;
        }
    }

    /**
     * @param  string $table
     * @param  string $uuid
     * @return boolean
     */
    public function delete(string $table, string $uuid): bool
    {
        $sql = "DELETE FROM $table WHERE uuid = UUID_TO_BIN(:uuid)";
        $params = [
            'uuid' => $uuid
        ];
        try {
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            return true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
            return false;
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