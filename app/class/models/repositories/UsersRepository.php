<?php

namespace app\class\models\repositories;

use app\class\Database;
use app\class\models\Users;
use Exception;
use PDO;
use PDOException;

final class UsersRepository
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
     * @param array<string, string> $data
     * @return Users
     */
    public function create(array $data): Users
    {
        $sql = "INSERT INTO users (firstname, lastname, mail, password) VALUE(:firstname, :lastname, :mail, :password)";
        try {

            $params = [
                'firstname' => $data['firstnameSanitize'],
                'lastname' => $data['lastnameSanitize'],
                'mail' => $data['mailSanitize'],
                'password' => $data['passwordHash']
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();

            $params['uuid'] = $this->getUuid($data['mailSanitize']);
            $user = new Users($params);
            return $user;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @param string $uuid
     * @return Users
     */
    public function readOne(string $uuid): Users
    {
        $sql = 'SELECT * FROM users WHERE uuid = UUID_TO_BIN(:uuid)';
        $params = [
            'uuid' => $uuid
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->setFetchMode(PDO::FETCH_CLASS, Users::class);
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
        $sql = "SELECT * FROM users";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, Users::class);
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
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :mail, password = :password WHERE uuid = UUID_TO_BIN(:uuid)';
        $params = [
            'uuid' => $uuid,
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'mail' => $data['mail'],
            'password' => $data['password']

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
        $sql = 'DELETE FROM users WHERE uuid = UUID_TO_BIN(:uuid)';
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
        $sql = 'SELECT BIN_TO_UUID(uuid) AS uuid FROM users WHERE mail = :mail';
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
