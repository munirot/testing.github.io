<?php

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$mail_header = "From: " . $name . "<" . $email . ">\r\n";
$recipients = "thonmonyroth@gmail.com";

// $comment = $name . " " . $email . " wrote the following:" . "\n\n" . $_Post['comment'];

mail($recipients, $subject, $message, $mail_header)
or die("Error!");

echo "Mail sent. Thank you" . $name . ", we will contact you shortly.";
?>