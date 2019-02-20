<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../');
}
$t = file_get_contents($_FILES['receivers_file']['tmp_name']);
die(var_dump($t));

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
