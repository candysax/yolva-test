<?php

namespace Yolva\Test\Base;

use PDO;

class DB
{
    public static $instance;

    private PDO $connection;

    private \PDOStatement $statement;

    public function __construct()
    {
        $config = require base_path('config.php');

        $this->connection = new PDO(
            "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']}",
            'admin',
            'password',
            [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    }

    public static function query(string $sql, array $params = []): static
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        static::$instance->statement = static::$instance->connection->prepare($sql);
        static::$instance->statement->execute($params);

        return static::$instance;
    }

    public function fetch(): array
    {
        $record = $this->statement->fetch();

        return ($record !== false) ? $record : [];
    }

    public function fetchAll(): array
    {
        return $this->statement->fetchAll();
    }
}
