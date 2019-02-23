<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../');
}
$t = json_decode(trim(file_get_contents($_FILES['receivers_file']['tmp_name'])));

$t =  json_encode($t);
$t = json_decode($t);
die(var_dump($t[0]));
die();
die(var_dump(json_encode($t)));

$inputs = [
  'sender' => "",
  'receivers' => "",
  'subject' => "",
  'body' => "",
  'attachment' => "",
  'images_dir' => "",
  'replaced_txt' => [
    'key' => "",
    'val' => ""
  ],
];
die(var_dump($inputs));
