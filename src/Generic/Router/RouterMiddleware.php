<?php
namespace Generic\Router;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;


class RouterMiddleware implements MiddlewareInterface
{  

    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Appel du controleur lié à la route ou renvoi d'une erreur 404
     * process
     *

     * @param  mixed $request
    * @param  mixed $handler
    *
    * @return ResponseInterface
    */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface 
    {
        //recupération de l'eventuel controleur
        $controller = $this->router->match($request);

        //Si il y a un controlleur => on appelle sa méthode process
        if (!is_null($controller)) {
            $response = $controller->process($request, $handler);
        } else {
        //s'il n'y a pas de controller => on renvoit une page 404  
            $response = new Response(404, [], '<h1>Erreur 404 : Page introuvable</h1>');
        } 
        return $response;
    }
}