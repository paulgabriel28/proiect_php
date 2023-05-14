<?php
ob_start();
require __DIR__ . '/../src/bootstrap.php';
require_login();
$to = 'acidtvsamp@gmail.com';
$subject = 'This is a test email';
$message = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>

<body>

    <h1>This is HTML mail</h1>

</body>

</html>';


$headers = [
    'MIME-Version' => '1.0',
    'Content-type' => 'text/html; charset=utf8',
    'From' => 'no-reply@paulgabriel.ro',
    'Reply-To' => 'no-reply@paulgabriel.ro',
    'X-Mailer' => 'PHP/' . phpversion()
];


if (mail($to, $subject, $message, $headers)) {
    echo 'email was sent.';
} else {
    echo 'An error occurred.';
}
ob_end_flush();