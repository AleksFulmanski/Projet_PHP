<?php

use Generic\App;
use DI\ContainerBuilder;
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

//Création du conteneur
$builder = new DI\ContainerBuilder();
$builder->addDefinitions($rootDir . '/config/config.php');
$container = $builder->build();

//création de la requete
$request = ServerRequest::fromGlobals();

// Initialiser Twig
// Finalement Twig va être initialisé dans config.php

//$twig = new TwigRenderer($rootDir . '/templates');

//Ajout des routes dans le routeur
//inserer les $twig dans les controllers () c'est la fonction construct donc dans la mrer controller
//il faut créer une fonction construct

$router = $container->get(Router::class);
$router->addRoute('/', $container->get(HomeController::class), 'homepageSlash');
$router->addRoute('/home', $container->get(HomeController::class), 'homepage');
$router->addRoute('/contact', $container->get(ContactController::class), 'contact');
$router->addRoute('/about', $container->get(AboutController::class), 'about');




//création de la response et il faut l'instancier
//quand on crée la classe App, on rappelle la méthode
$app = new App([
    $container->get(TrailingSlashMiddleware::class),
    $container->get(RouterMiddleware::class)
]);
$response = $app->handle($request);

//renvoi de la reponse au navigateur

\Http\Response\send($response);
