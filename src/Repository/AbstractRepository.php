<?php

namespace App\Repository;

use PDO;
use PDOStatement;

abstract class AbstractRepository
{
    protected function query(string $sql, bool $single = true): mixed
    {
        $statement = Database::getConnection()->query($sql);
        return $single ? $statement->fetch(PDO::FETCH_OBJ) : $statement->fetchAll(PDO::FETCH_OBJ);
    }

    private function prepare(string $sql, array $datas): PDOStatement
    {
        $statement = Database::getConnection()->prepare($sql);
        $statement->execute($datas);
        return $statement;
    }

    protected function executeQuery(string $sql, array $datas, bool $single = true): mixed
    {
        $statement = $this->prepare($sql, $datas);
        return $single ? $statement->fetch(PDO::FETCH_OBJ) : $statement->fetchAll(PDO::FETCH_OBJ);
    }

    protected function executeUpdate(string $sql, array $datas): int|string
    {
        $statement = $this->prepare($sql, $datas);
        return (str_starts_with(strtoupper(trim($sql)), 'INSERT')) ? Database::getConnection()->lastInsertId() : $statement->rowCount();
    }

    protected function getAllData(string $tableName): array
    {
        $sql = "SELECT * FROM $tableName";
        return $this->query($sql, false);
    }
}
