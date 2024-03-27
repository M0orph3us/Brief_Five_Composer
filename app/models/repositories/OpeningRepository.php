<?php

namespace app\models\repositories;

use app\class\Database;
use app\services\SQLRequest;
use Exception;
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
    use SQLRequest;

    /**
     * @param string $uuid
     * @param array<string, string> $data
     * @return void
     */
    public function update(array $data): void
    {
        $sql = 'UPDATE opening SET  morning_opening_hour = :morning_opening_hour, morning_closing_hour = :morning_closing_hour, evening_opening_hour = :evening_opening_hour, evening_closing_hour = :evening_closing_hour WHERE opening_day = :opening_day';
        $params = [
            'opening_day' => $data['opening_day']
        ];
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}