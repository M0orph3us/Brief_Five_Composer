<?php

namespace app\models\repositories;

use app\class\Database;
use app\services\SQLRequest;
use Exception;
use PDOException;


final class TeamsRepository
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
     * @return void
     */
    public function create(array $data): void
    {
        $sql = "INSERT INTO teams (firstname, lastname, mail, password) VALUE(:firstname, :lastname, :mail, :password)";
        try {

            $params = [
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'mail' => $data['mail'],
                'password' => $data['password']
            ];

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            $_SESSION['isCreatedTeam'] = true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @param  string $uuid
     * @param  array<string, string>  $data
     * @return void
     */
    public function update(string $uuid, array $data): void
    {
        $sql = 'UPDATE teams SET firstname = :firstname, lastname = :lastname, mail = :mail, password = :password WHERE uuid = UUID_TO_BIN(:uuid)';
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
            $_SESSION['isUpdatedTeam'] = true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}