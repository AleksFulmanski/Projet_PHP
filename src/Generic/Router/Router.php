<?php

namespace Generic\Router;

use Zend\Expressive\Router\Route;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Psr\Http\Message\ServerRequestInterface;


class Router
{
    /**
     * @var FastRouteRouter
     *
     */
    private $routerVendor;
    
    public function __construct()
    {
        $this->routerVendor = new FastRouteRouter();
    }
    /**
     * Ajoute une route dans le routeur
     * @param string $url
     * @param MiddlewareInterface $controller
     * @param string\null $name _ Nom unique de la route
     * 
     */

    public function addRoute(string $url, MiddlewareInterface $controller, ?string $name = null): void
    {
        //on crée un objet Route pour le passer au "vrai" router
        $route = new Route($url, $controller, null, $name);

        //on appelle la fonction du "vrai" router pour ajouter une route 
        $this->routerVendor->addRoute($route);

    }
    /**
     * Renvoit le controleur lié à l'url donnée
     * @param string $url
     * @return null\MiddlewareInterface
     */

    public function match(ServerRequestInterface $request): ?MiddlewareInterface
    {
        //recupération de l'URL (dans $request)
        //il faudra definir une route pour chaque page de notre site

        $result = $this->routerVendor->match($request);

        if ($result->isSuccess())
        {
            //j'ai une route
            $route = $result->getMatchedRoute()->getMiddleware();
        } else {
            //J'ai pas de route => page 404
            $route = null;
        } 
        
        return $route;
    }






}