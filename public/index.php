<?php

require_once dirname(__DIR__) . '/config/dependance.php';

use App\Controller\CopieExamenController;
use App\Repository\Database;
use App\Repository\PdoCopieExamenRepository;
use App\Service\CalculNoteAvecRetardService;
use App\Service\SoumissionCopieService;

$pdo = Database::getInstance([])->getConnection();

$repository = new PdoCopieExamenRepository($pdo);
$service = new SoumissionCopieService(new CalculNoteAvecRetardService(), $repository);
$controller = new CopieExamenController($service, $repository);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$methode = $_SERVER['REQUEST_METHOD'];

if ($uri === '/copies' && $methode === 'GET') {
    $controller->afficherListe();
} elseif ($uri === '/copies' && $methode === 'POST') {
    $controller->soumettre($_POST);
} elseif (preg_match('#^/copies/(\d+)$#', $uri, $matches) && $methode === 'GET') {
    $controller->afficherDetail((int) $matches[1]);
} elseif ($uri === '/' || $uri === '/copies/nouvelle') {
    $controller->afficherFormulaire();
} else {
    http_response_code(404);
    require __DIR__ . '/../templates/erreur.php';
}