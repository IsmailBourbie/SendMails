<?php

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../');
}

$inputs = Request::post();
die(var_dump($inputs));

var_dump($_POST);
