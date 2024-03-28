<?php

namespace app\models\repositories;

use app\class\Database;
use app\models\Users;
use app\services\SQLRequest;
use Exception;
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
    use SQLRequest;

    /**
     * @param array<string, string> $data
     * @return Users
     */
    public function create(array $data): Users
    {
        $sql = "INSERT INTO users (firstname, lastname, mail, password) VALUE(:firstname, :lastname, :mail, :password)";
        try {

            $params = [
                'firstname' => $data['firstnameRegisterSanitize'],
                'lastname' => $data['lastnameRegisterSanitize'],
                'mail' => $data['mailRegisterSanitize'],
                'password' => $data['passwordHash']
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();

            $params['uuid'] = $this->getUuid('Users', 'mail', $data['mailRegisterSanitize']);
            $user = new Users($params);
            $firstname = $user->getFirstname();
            $_SESSION['isRegisted'] = $firstname;
            return $user;
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
        $sql = 'UPDATE users SET firstname = :firstname , lastname = :lastname, mail = :mail, password = :password WHERE uuid = UUID_TO_BIN(:uuid)';
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
            $_SESSION['isUpdated'] = true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}