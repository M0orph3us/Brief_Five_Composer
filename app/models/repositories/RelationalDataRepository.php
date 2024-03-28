<?php

namespace app\models\repositories;

use app\class\Database;
use app\models\Reservations;
use app\services\SQLRequest;
use Exception;
use PDO;
use PDOException;

final class RelationalDataRepository
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
     * @param  string $uuid_users
     * @return Reservations
     */
    public function getReservationByUser(string $uuid_users): Reservations
    {
        $sql =
            "SELECT
                number_of_persons,
                baby_chair,
                reserved_on
            FROM 
                reservations R
            JOIN users U ON 
                R.uuid_users = U.uuid
            WHERE 
                U.uuid = :uuid_users";
        $params = [
            'uuid_users' => $uuid_users
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_CLASS, Reservations::class);
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @return array | false
     */
    public function getAllReservationsWithTeams(): array | false
    {
        $sql =
            "SELECT
                DATE_FORMAT(r.reserved_on, '%d/%m/%Y') AS formated_date,
                r.number_of_persons,
                r.baby_chair,
                u.firstname AS user_firstname,
                u.lastname AS user_lastname,
                u.mail,
                t.firstname AS team_firstname,
                t.lastname AS team_lastname
            FROM
                reservations r
            JOIN toAssign ta ON
                r.uuid = ta.uuid_reservations
            JOIN teams t ON
                ta.uuid_teams = t.uuid
            LEFT JOIN users u ON
                r.uuid_users = u.uuid
            ORDER BY
                r.reserved_on ASC";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }

    /**
     * @return array | false
     */
    public function getAllResevationsWhitoutTeams(): array | false
    {
        $sql =
            "SELECT
                r.uuid,
                DATE_FORMAT(r.reserved_on, '%d/%m/%Y') AS formated_date,
                r.number_of_persons,
                r.baby_chair,
                u.firstname,
                u.lastname,
                u.mail
            FROM
                reservations r
            LEFT JOIN toAssign ta ON
                r.uuid = ta.uuid_reservations
            LEFT JOIN users u ON
                r.uuid_users = u.uuid
            WHERE
                ta.uuid_teams IS NULL
            ORDER BY
                r.reserved_on ASC";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $result;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}