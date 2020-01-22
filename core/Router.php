<?php
namespace Core;


class Router
{

    private $routes = [];

    public function define($routes)
    {
        $this->routes = $routes;
    }


    public static function load ($file)
    {
        $router = new static;
        require $file;
        return $router;
    }
    public function direct($uri)
    {
        if(array_key_exists($uri, $this->routes)) {
            require $this->routes[$uri];
        }
    }

}