<?php

namespace App\Container;


abstract class Database
{
    private static ?\PDO $pdo = null;

    private static function getInstance(array $config): \PDO
    {
        if (self::$pdo === null) {
            $dsn = "pgsql:host={$config['DB_HOST']};port={$config['DB_PORT']};dbname={$config['DB_NAME']}";

            try {
                self::$pdo = new \PDO($dsn, $config['DB_USER'], $config['DB_PASSWORD']);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                error_log("Connexion PostgreSQL échouée : " . $e->getMessage());
                throw $e;
            }
        }

        return self::$pdo;
    }

    public static function query(array $config, string $sql, bool $single = true): mixed
    {
        $query = self::getInstance($config)->query($sql);
        return $single ? $query->fetch(\PDO::FETCH_OBJ) : $query->fetchAll(\PDO::FETCH_OBJ);
    }

    private static function prepare(array $config, string $sql, array $datas): \PDOStatement
    {
        $prepare = self::getInstance($config)->prepare($sql);
        $prepare->execute($datas);
        return $prepare;
    }

    public static function executeQuery(array $config, string $sql, array $datas, bool $single = true): mixed
    {
        $statement = self::prepare($config, $sql, $datas);
        return $single ? $statement->fetch(\PDO::FETCH_OBJ) : $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function executeUpdate(array $config, string $sql, array $datas): int|string
    {
        $statement = self::prepare($config, $sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? self::getInstance($config)->lastInsertId() : $statement->rowCount();
    }

    public static function getAllData(array $config, string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return self::query($config, $sql, false);
    }
}