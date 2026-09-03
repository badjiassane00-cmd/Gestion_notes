<?php

$chemin = dirname(__DIR__);

require_once $chemin . '/vendor/autoload.php';

\Dotenv\Dotenv::createImmutable($chemin)->safeLoad();

use App\Controller\CopieExamenController;
use App\Repository\Database;
use App\Repository\PdoCopieExamenRepository;
use App\Router\Router;
use App\Service\CalculNoteAvecRetardService;
use App\Service\SoumissionCopieService;

$configuration = require $chemin . '/config/database.php';

$pdo = Database::getInstance($configuration)->getConnection();

$repository = new PdoCopieExamenRepository($pdo);
$service = new SoumissionCopieService(new CalculNoteAvecRetardService(), $repository);
$controller = new CopieExamenController($service, $repository);

(new Router())->dispatcher($controller);
