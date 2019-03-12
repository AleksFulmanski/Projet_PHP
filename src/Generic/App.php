<?php

namespace Generic;


use GuzzleHttp\Psr7\Response;
use Appli\Controller\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Generic\Middlewares\TrailingSlashMiddleware;

class App implements RequestHandlerInterface
{
	private $compteurMiddleware; 

	public function __construct()
	{
		//on initialise le compteur à 0
		$this->$compteurMiddleware = 0;
	}


public function handle(ServerRequestInterface $request): ResponseInterface 
	{
//on recupere le middleware à appeler		
$middleware = $this->middlewares[$this->compteurMiddleware];

//incrémentation du compteur
$this->compteurMiddleware++;

//on appelle le middleware
$response = $middleware->process($request, $this);

return $response;

	}
}

