<?php

namespace Generic\Renderer;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderer
{
    private $twig;

    public function __construct(string $path)
    {

        $loader = new FilesystemLoader($path);
        $this->twig = new Environment($loader, [
        'cache' => false
        ]);
    }

/**
 * Rendre une vue Twig (fichier avec extension ".twig" dans une chaine de caracteres
 * @param string view $view _ fichier Twig
 * @param array $variables - les variables que je veux envoyer à Twig
 * @return string _ la page html
 *
 *
 */
    public function render(string $view, array $variables = []) : string
    {
        return $this->twig->render($view, $variables);
    }
}
