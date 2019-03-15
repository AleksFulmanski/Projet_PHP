<?php

namespace Generic;

use GuzzleHttp\Psr7\Response;
use Appli\Controller\HomeController;
use Generic\Middlewares\TrailingSlashMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;

class App implements RequestHandlerInterface
{
    
    
    private $compteurMiddleware;
    private $middlewares;

    public function __construct(array $middlewares)
    {
        //On initialise le compteur de middleware à 0
        $this->compteurMiddleware = 0;

        $this->middlewares = $middlewares;
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
