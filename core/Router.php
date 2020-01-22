<?php
namespace Core;


class Router
{

    /**
     * all routes of the site
     * @access private
     */
    private $routes = [];


    /**
     * define the possible routes of the site
     * @param array $routes
     */
    public function define($routes)
    {
        $this->routes = $routes;
    }


    /**
     * create a router and load routes file
     * @param strinf $file
     * @return object $router
     */
    public static function load ($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    /**
     * direct the url to relative controller
     * @param string $url
     * @throws \Exeption
     */
    public function direct($url)
    {
        if(array_key_exists($url, $this->routes)) {
            require $this->routes[$url];
        } else {
            die("No file found for this uri: $url");
            
        }
    }

}