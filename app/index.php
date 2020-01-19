<?php

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../');
}

$inputs = Request::post();

$s = $inputs['sender'];
$r = $inputs['receivers'];
$b = $inputs['body'];

$config = [
  'host' => "smtp.gmail.com",
  'username' => "jami3atyapp@gmail.com",
  'password' => "bourbieyounes",
  'SMTPSecure' => "ssl",
  'port' => 465,
];

$mail = new Mail($r, $b, $s);
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
echo json_encode($response);
