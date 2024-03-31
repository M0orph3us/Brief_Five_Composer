<?php

namespace app\models\repositories;

use app\class\Database;
use app\services\SQLRequest;
use Exception;
use PDOException;

final class OpeningRepository extends Database
{

    // contructor
    public function __construct()
    {
        parent::__construct();
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
            'morning_opening_hour' => $data['morning_opening_hour'],
            'morning_closing_hour' => $data['morning_closing_hour'],
            'evening_opening_hour' => $data['evening_opening_hour'],
            'evening_closing_hour' => $data['evening_closing_hour'],
            'opening_day' => $data['opening_day']
        ];
        try {
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            $_SESSION['isUpdatedOpeningDay'] = true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}