<?php

namespace app\models\repositories;

use app\class\Database;
use app\services\SQLRequest;
use Exception;
use PDOException;

final class ReservationsRepository extends Database
{
    // params

    // contructor
    public function __construct()
    {
        parent::__construct();
    }

    // CRUD
    use SQLRequest;

    // SELECT DATE_FORMAT(created_at, '%d-%m-%Y') AS formatted_date FROM your_table;


    /**
     * @param  string $uuid_teams
     * @param  string $uuid_reservations
     * @return void
     */
    public function assignReservation(string $uuid_teams, string $uuid_reservations): bool
    {
        $sql = "INSERT INTO toassign (uuid_teams, uuid_reservations) VALUE (UUID_TO_BIN(:uuid_teams), UUID_TO_BIN(:uuid_reservations))";
        $params = [
            'uuid_teams' => $uuid_teams,
            'uuid_reservations' => $uuid_reservations
        ];
        try {
            $stmt = $this->getDB()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            return true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
            return false;
        }
    }

    /**
     * @param  array<string, mixed> $data
     * @return void
     */
    public function createReservation(array $data): bool
    {

        $sql = "INSERT INTO reservations (number_of_persons, baby_chair, reserved_on, uuid_users) VALUE (:number_of_persons, :baby_chair, :reserved_on, UUID_TO_BIN(:uuid_users))";
        $params = [
            'number_of_persons' => $data['numberOfPersons'],
            'baby_chair' => $data['babyChair'],
            'reserved_on' => $data['reservedOn'],
            'uuid_users' => $data['uuidUsers']
        ];
        try {
            $stmt = $this->getDB()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            return true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
            return false;
        }
    }
}