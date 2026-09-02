<?php

namespace App\Repository;


abstract class AbstractRepository
{
       protected \PDO $pdo;

    protected function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    protected function query(string $sql, bool $single = true): mixed
    {
        $statement = $this->pdo->query($sql);
        return $single ? $statement->fetch(\PDO::FETCH_OBJ) : $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    private function prepare(string $sql, array $datas): \PDOStatement
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($datas);
        return $statement;
    }

    protected function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = $this->prepare($sql, $datas);
        return $single ? $statement->fetch(\PDO::FETCH_OBJ) : $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    protected function executeUpdate(string $sql, array $datas): int|string
    {
        $statement = $this->prepare($sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? $this->pdo->lastInsertId() : $statement->rowCount();
    }

    protected function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return $this->query($sql, false);
    }
     protected function beginTransaction(): bool
    {
        return $this->pdo->beginTransaction();
    }

    protected function commit(): bool
    {
        return $this->pdo->commit();
    }

    protected function rollBack(): bool
    {
        return $this->pdo->rollBack();
    }

    protected function inTransaction(): bool
    {
        return $this->pdo->inTransaction();
    }
}
