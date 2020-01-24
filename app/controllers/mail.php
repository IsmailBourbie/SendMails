<?php

use App\Classes\File;
use App\Classes\Files\AttachmentFile;
use App\Classes\Files\HtmlFile;
use App\Classes\Files\ImageFile;
use App\Classes\Files\JsonFile;
use App\Classes\Time;
use Core\Request;
use App\Models\Mail;

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  // header('Location: /sendMails');
}
$inputs = Request::post();

$s = $inputs['sender'];
$r = $inputs['receivers'];
$b = $inputs['body'];
$a = $inputs['attachements'];
$i = $inputs['body']['configuration']['images'];
$config = [
  'host' => "smtp.gmail.com",
  'username' => "jami3atyapp@gmail.com",
  'password' => "bourbieyounes",
  'SMTPSecure' => "ssl",
  'port' => 465,
];

// $mail = new Mail($r, $b, $s, $a, $i);
// $mail->setup_images($i);
// $time = new Time();
$i = 'test/images/tc.png';
$file = new ImageFile($i);
die(var_dump($file->isValid()));
// $time->start();
// $mail->setup_config($config);
// $tracing = $mail->sendAll();
// $time->finish();

$response = [
  'status' => 200,
  'spentTime' => $time->spent_time(),
  'tracing' => $tracing,
];

require 'app/views/json.php';
