<?php

declare(strict_types=1);

namespace App\Repository;

final class Database
{
    private static ?self $instance = null;
    private \PDO $connection;

    private function __construct(array $configuration)
    {
        $driver = $configuration['driver'] ?? 'pgsql';
        $host = $configuration['host'] ?? 'localhost';
        $port = $configuration['port'] ?? 5432;
        $dbname = $configuration['dbname'] ?? 'notes_universitaire';
        $options = $configuration['options'] ?? [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->connection = new \PDO(
            "$driver:host=$host;port=$port;dbname=$dbname",
            $configuration['user'] ?? 'postgres',
            $configuration['password'] ?? '',
            $options
        );
    }

    public static function getInstance(array $configuration): self
    {
        if (self::$instance === null) {
            self::$instance = new self($configuration);
        }

        return self::$instance;
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }

    public static function closeConnection(): void
    {
        self::$instance = null;
    }
}
