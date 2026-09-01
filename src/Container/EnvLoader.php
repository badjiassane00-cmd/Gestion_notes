<?php

namespace App\Container;

class EnvLoader
{
    public static function load(string $path): array
    {
        $config = [];

        foreach (file($path) as $ligne) {
            $ligne = trim($ligne);

            if ($ligne === '' || str_starts_with($ligne, '#')) {
                continue;
            }

            [$cle, $valeur] = explode('=', $ligne, 2);
            $config[trim($cle)] = trim($valeur);
        }

        return $config;
    }
}
