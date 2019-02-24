<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../');
}
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
$t = [
  'post' => $_POST,
  'files' => $_FILES
];
echo json_encode($t);
