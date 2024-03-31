<?php

namespace app\models\repositories;

use app\class\Database;
use app\services\SQLRequest;
use Exception;
use PDOException;

final class AvailableTablesRepository extends Database
{
    // params

    // contructor
    public function __construct()
    {
        parent::__construct();
    }

    // CRUD
    use SQLRequest;

    /**
     * @param int $number
     * @return void
     */
    public function update(int $number): void
    {
        $sql = 'UPDATE available_tables SET quantity_tables = :quantity_tables';
        $params = [
            'quantity_tables' => $number
        ];
        try {
            $stmt = $this->getDB()->prepare($sql);
            $stmt->execute($params);
            $stmt->closeCursor();
            $_SESSION['isUpdatedQuantityTables'] = true;
        } catch (PDOException $error) {
            throw new Exception('Error: ' . $error->getMessage());
        }
    }
}
