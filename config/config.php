<?php

use Generic\Database\Connection;
use Generic\Renderer\TwigRenderer;
return [
    "root-dir" => dirname(__DIR__),
    "database_name" => "bdd_mysql_command",
    "database_user" => "php-user-bdd",
    "database_pass" => "LKIAlnNhz0g6nipu",

    //debug car il trouve pas $path on lui indique ce qu'il doit faire
    TwigRenderer::class => function($container) {
        return new TwigRenderer($container->get('root-dir') . '/templates');
    },

    Connection::class => function($container) {
        return new Connection(
            $container->get('database_name'), 
            $container->get('database_user'), 
            $container->get('database_pass')
        );
    }

];