<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Container\Database;
use App\Container\EnvLoader;

$config = EnvLoader::load(__DIR__ . '/../.env');