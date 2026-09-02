<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Repository\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$pdo = Database::getConnection();
