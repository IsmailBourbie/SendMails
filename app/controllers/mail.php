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
$senderInput = $inputs['sender'];
$recipientsInput = $inputs['receivers'];
$contentInput = $inputs['body'];
$attachmentsInput = $inputs['attachments'];
$config = [
  'host' => "smtp.gmail.com",
  'username' => "jami3atyapp@gmail.com",
  'password' => "bourbieyounes",
  'SMTPSecure' => "ssl",
  'port' => 465,
];
// die(var_dump($inputs));
$mail = new Mail(
  $senderInput,
  $recipientsInput,
  $contentInput,
  $attachmentsInput
);
$time = new Time();
$time->start();
$mail->setup_config($config);
$tracing = $mail->sendAll();
$time->finish();

$response = [
  'status' => 200,
  'spentTime' => $time->spent_time(),
  'tracing' => $tracing,
];

require 'app/views/json.php';
