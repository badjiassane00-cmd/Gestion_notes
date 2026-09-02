<?php


$chemin = dirname(__DIR__);

require_once $chemin . '/vendor/autoload.php';

\Dotenv\Dotenv::createImmutable($chemin)->safeLoad();