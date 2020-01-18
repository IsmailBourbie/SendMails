<?php

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header('Location: ../');
}

$inputs = Request::post();

$r = $inputs['receivers']['data'];
$b = $inputs['body'];

$config = [
  'host' => "smtp.gmail.com",
  'username' => "jami3atyapp@gmail.com",
  'password' => "bourbieyounes",
  'SMTPSecure' => "ssl",
  'port' => 465,
];

$mail = new Mail($r, $b, $config);
$mail->setup_config($config);
$tracing = $mail->send_mails();
echo json_encode($tracing);
