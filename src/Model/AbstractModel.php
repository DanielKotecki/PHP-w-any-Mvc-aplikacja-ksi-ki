<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

class AbstractModel
{
    protected PDO $connection;
    public function __construct(array $configuration)
    {

        //Zwalidować przesłany config
        //ustawić połączenie z bazą danych
        $this->create_connection($configuration);
    }
    private function create_connection(array $configuration)
    {
        $dsn = "mysql:dbname={$configuration['db_name']};host={$configuration['host']}";
        $this->connection = new PDO($dsn, $configuration['user'], $configuration['password'],   [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}
