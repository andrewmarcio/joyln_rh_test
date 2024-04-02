<?php

namespace Infra\Persistence;

use Domain\DatabaseConnection\DatabaseConnectionInterface;
use PDO;

class DatabaseConnection implements DatabaseConnectionInterface
{

    private function createConnection(): PDO
    {   
        $dsn = sprintf(
            "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
            env('DB_HOST'),
            env('DB_PORT'),
            env('DB_NAME'),
        );
        $user = env('DB_USER');
        $password = env('DB_PASSWORD');
        try {
            $connection = new PDO($dsn, $user, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function getConnection(): PDO
    {
        return $this->createConnection();
    }
}
