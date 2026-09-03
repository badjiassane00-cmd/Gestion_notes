<?php

namespace App\Router;

use App\Controller\CopieExamenController;
use FastRoute\Dispatcher;

use function FastRoute\simpleDispatcher;

class Router
{
    public function dispatcher(CopieExamenController $controller): void
    {
        $dispatcher = simpleDispatcher(require dirname(__DIR__, 2) . '/config/routes.php');

        $uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $methode = $_SERVER['REQUEST_METHOD'];

        $routeInfo = $dispatcher->dispatch($methode, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                $erreurs = ["Page introuvable."];
                require dirname(__DIR__, 2) . '/templates/erreur.php';
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                $erreurs = ["Méthode HTTP non autorisée pour cette route."];
                require dirname(__DIR__, 2) . '/templates/erreur.php';
                break;

            case Dispatcher::FOUND:
                [, $action, $vars] = $routeInfo;

                match ($action) {
                    'copies.liste' => $controller->afficherListe(),
                    'copies.formulaire' => $controller->afficherFormulaire(),
                    'copies.soumettre' => $controller->soumettre($_POST),
                    'copies.detail' => $controller->afficherDetail((int) $vars['id']),
                };
                break;
        }
    }
}
