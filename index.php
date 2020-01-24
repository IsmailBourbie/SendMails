<?php

use Core\Router;
use Core\Request;

require 'vendor/autoload.php';


Router::load('routes.php')
    ->direct(Request::url());
