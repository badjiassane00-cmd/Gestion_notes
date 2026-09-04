<?php

use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    $r->addRoute('GET', '/', 'copies.formulaire');
    $r->addRoute('GET', '/copies', 'copies.liste');
    $r->addRoute('GET', '/copies/create', 'copies.formulaire');
    $r->addRoute('GET', '/copies/nouvelle', 'copies.formulaire');
    $r->addRoute('POST', '/copies', 'copies.soumettre');
    $r->addRoute('GET', '/copies/{id:\d+}', 'copies.detail');
};
