<?php

use Generic\App;
use Generic\Router\Router;
use GuzzleHttp\Psr7\ServerRequest;
use Appli\Controller\HomeController;
use Generic\Router\RouterMiddleware;
use Generic\Middlewares\TrailingSlashMiddleware;


// chargement de l'autoloader
//dirname pour remonter dans le dossier et puis redescendre chercher le dossier vendor
require_once dirname(__DIR__) . '/vendor/autoload.php';

//création de la requete
$request = ServerRequest::fromGlobals();

//Ajout des routes dans le routeur

$router = new Router(); 
$router->addRoute('/home', new HomeController(), 'homepage');


//création de la response et il faut l'instancier
//quand on crée la classe App, on rappelle la méthode 
$app = new App([
    new TrailingSlashMiddleware(),
    new RouterMiddleware($router),
]);
$response = $app->handle($request);

//renvoi de la reponse au navigateur

\Http\Response\send($response); 
