<?php

use Generic\App;
use Generic\Router\Router;
use Generic\Renderer\TwigRenderer;
use GuzzleHttp\Psr7\ServerRequest;
use Appli\Controller\HomeController;
use Generic\Router\RouterMiddleware;
use Appli\Controller\AboutController;
use Appli\Controller\ContactController;
use Generic\Middlewares\TrailingSlashMiddleware;



$rootDir = dirname(__DIR__); 

// chargement de l'autoloader
//dirname pour remonter dans le dossier et puis redescendre chercher le dossier vendor
require_once $rootDir . '/vendor/autoload.php';

//création de la requete
$request = ServerRequest::fromGlobals();

// Initialiser Twig

$twig = new TwigRenderer($rootDir . '/templates');

//Ajout des routes dans le routeur
//inserer les $twig dans les controllers () c'est la fonction construct donc dans la mrer controller 
//il faut créer une fonction construct

$router = new Router(); 
$router->addRoute('/', new HomeController($twig), 'homepage');
$router->addRoute('/home', new HomeController($twig), 'homepage');
$router->addRoute('/contact', new ContactController($twig), 'contact');
$router->addRoute('/about', new AboutController($twig), 'about');



//création de la response et il faut l'instancier
//quand on crée la classe App, on rappelle la méthode 
$app = new App([
    new TrailingSlashMiddleware(),
    new RouterMiddleware($router),
]);
$response = $app->handle($request);

//renvoi de la reponse au navigateur

\Http\Response\send($response); 
