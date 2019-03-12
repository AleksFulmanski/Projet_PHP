<?php

use Generic\App;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;

// chargement de l'autoloader
//dirname pour remonter dans le dossier et puis redescendre chercher le dossier vendor
require_once dirname(__DIR__) . '/vendor/autoload.php';

//création de la requete
$request = ServerRequest::fromGlobals();

//création de la response et il faut l'instancier
//quand on crée la classe App, on rappelle la méthode 
$app = new App();
$response = $app->handle($request);

//renvoi de la reponse au navigateur

\Http\Response\send($response); 
