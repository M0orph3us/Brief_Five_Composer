<?php

namespace app\models\repositories;

use app\class\Database;
use app\models\Opening;
use Exception;
use PDO;
use PDOException;

final class OpeningRepository
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

    /**
     * @param array<string, mixed> $data
     * @return Opening
     */
    public function create(array $data): Opening
    {
        $sql = "INSERT INTO opening (opening_day, opening_hour) VALUE(:opening_day, :opening_hour)";
        try {

            $params = [
                'opening_hour' => $data['opening_hour'],
                'opening_hour' => $data['opening_hour']
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();

            // $getUuid = $this->getUuid($data['mail']);
            // $params =  [
            //     'uuid' => $getUuid
            // ];
            $opening = new Opening($params);
            return $opening;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @param string $uuid
     * @return Opening
     */
    public function readOne(string $uuid): Opening
    {
        $sql = 'SELECT * FROM opening WHERE uuid = UUID_TO_BIN(:uuid)';
        $params = [
            'uuid' => $uuid
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->setFetchMode(PDO::FETCH_CLASS, Opening::class);
            $result = $stmt->fetch();
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @return array
     */
    public function readAll(): array
    {
        $sql = "SELECT * FROM opening";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, Opening::class);
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
    /**
     * @param string $uuid
     * @param array<string, string> $data
     * @return void
     */
    public function update(string $uuid, array $data): void
    {
        $sql = 'UPDATE opening SET opening_day = :opening_day, opening_hour = :opening_hour WHERE uuid = UUID_TO_BIN(:uuid)';
        $params = [
            'uuid' => $uuid,
            'opening_day' => $data['opening_day'],
            'opening_hour' => $data['opening_hour']
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
     * @param string $uuid
     * @return void
     */
    public function delete(string $uuid): void
    {
        $sql = 'DELETE FROM opening WHERE uuid = UUID_TO_BIN(:uuid)';
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
     * @param string $mail
     * @return string
     */

    public function getUuid(string $mail): string
    {
        $sql = 'SELECT BIN_TO_UUID(uuid) AS uuid FROM opening WHERE mail = :mail';
        $params = [
            'mail' => $mail
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
