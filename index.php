<?php

use Core\Router;
use Core\Request;

require 'vendor/autoload.php';
require "core/Router.php";
$routes  = [
    "" => "controllers/index.php",
    "send" => "Controllers/send.php",
    "configurations" => "controllers/configurations.php"
];
$router = new Router;
$router->define($routes);

$router->direct(Request::url());