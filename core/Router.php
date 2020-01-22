<?php
namespace Core;


class Router
{

    private $routes = [];

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public function direct($uri)
    {
        if(array_key_exists($uri, $this->routes)) {
            require $this->routes[$uri];
        }
    }

}