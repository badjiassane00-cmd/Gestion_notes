<?php

namespace App\Container;

class Container
{
    private array $definitions = [];
    private array $instances = [];

    public function set(string $id, \Closure $fabrique): void
    {
        $this->definitions[$id] = $fabrique;
    }

    public function get(string $id): mixed
    {
        if (array_key_exists($id, $this->instances)) {
            return $this->instances[$id];
        }

        if (!array_key_exists($id, $this->definitions)) {
            throw new \RuntimeException(sprintf("Aucune définition enregistrée pour '%s'.", $id));
        }

        $fabrique = $this->definitions[$id];
        $instance = $fabrique($this);

        $this->instances[$id] = $instance;

        return $instance;
    }
}
