<?php

$chemin = dirname(__DIR__);

require_once $chemin . '/vendor/autoload.php';

\Dotenv\Dotenv::createImmutable($chemin)->safeLoad();

use App\Container\Container;
use App\Controller\CopieExamenController;
use App\Repository\CopieExamenRepositoryInterface;
use App\Repository\PdoCopieExamenRepository;
use App\Router\Router;
use App\Service\CalculNoteAvecRetardService;
use App\Service\CalculNoteInterface;
use App\Service\SoumissionCopieService;

$container = new Container();

$container->set(\PDO::class, function () use ($chemin) {
    $configuration = require $chemin . '/config/database.php';

    $driver = $configuration['driver'] ?? 'pgsql';
    $host = $configuration['host'] ?? 'localhost';
    $port = $configuration['port'] ?? 5432;
    $dbname = $configuration['dbname'] ?? 'notes_universitaire';
    $options = $configuration['options'] ?? [];

    return new \PDO(
        "$driver:host=$host;port=$port;dbname=$dbname",
        $configuration['user'] ?? 'postgres',
        $configuration['password'] ?? '',
        $options
    );
});

$container->set(CopieExamenRepositoryInterface::class, function (Container $container) {
    return new PdoCopieExamenRepository($container->get(\PDO::class));
});

$container->set(CalculNoteInterface::class, function () {
    return new CalculNoteAvecRetardService();
});

$container->set(SoumissionCopieService::class, function (Container $container) {
    return new SoumissionCopieService(
        $container->get(CalculNoteInterface::class),
        $container->get(CopieExamenRepositoryInterface::class)
    );
});

$container->set(CopieExamenController::class, function (Container $container) {
    return new CopieExamenController(
        $container->get(SoumissionCopieService::class),
        $container->get(CopieExamenRepositoryInterface::class)
    );
});

$container->set(Router::class, function () {
    return new Router();
});

$container->get(Router::class)->dispatcher($container->get(CopieExamenController::class));
