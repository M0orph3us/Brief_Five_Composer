<?php

namespace app\models\repositories;

use app\class\Database;
use app\services\SQLRequest;

final class UsersRepository extends Database
{
    // params


    // contructor
    public function __construct()
    {
        parent::__construct();
    }

    // CRUD
    use SQLRequest;


    // /**
    //  * @param string $uuid
    //  * @param array<string, string> $data
    //  * @return void
    //  */
    // public function update(string $uuid, array $data): bool
    // {
    //     $sql = 'UPDATE users SET firstname = :firstname , lastname = :lastname, mail = :mail, password = :password WHERE uuid = UUID_TO_BIN(:uuid)';
    //     $params = [
    //         'uuid' => $uuid,
    //         'firstname' => $data['firstname'],
    //         'lastname' => $data['lastname'],
    //         'mail' => $data['mail'],
    //         'password' => $data['password']

    //     ];
    //     try {
    //         $stmt = $this->getDB()->prepare($sql);
    //         $stmt->execute($params);
    //         $stmt->closeCursor();
    //         return true;
    //     } catch (PDOException $error) {
    //         throw new Exception('Error: ' . $error->getMessage());
    //         return false;
    //     }
    // }
}