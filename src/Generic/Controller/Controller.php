<?php
namespace Generic\Controller;

use GuzzleHttp\Psr7\Response;
use Generic\Renderer\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

/**
 * Classe mère des controleurs PSR15 : fournit des méthodes utilitaires
 * clase abstraite : ne peut pas etre instanciée
 *
 */

abstract class Controller implements MiddlewareInterface
{

    /**
     * TwigRenderer
     */
    private $twig;

    public function __construct(TwigRenderer $twig)
    {
        $this->twig = $twig;
    }


    
    /**
     * fonction returne l'HTML fourni dans une réponse (Résponse)
     * @param string html
     * @return ResponseInterface
     */

    protected function render(string $view, array $variables = []) : ResponseInterface
    {
        return new Response(200, [], $this->twig->render($view, $variables));
    }
}
