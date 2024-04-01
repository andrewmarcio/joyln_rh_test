<?php

declare(strict_types=1);

namespace Domain\DatabaseConnection;

use PDO;

interface DatabaseConnectionInterface
{
    public function getConnection(): PDO;
}
