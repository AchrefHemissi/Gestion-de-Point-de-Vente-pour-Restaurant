<?php
$to = $_POST['recipient'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$headers = 'From: meddhia310@gmail.com';

mail($to, $subject, $message, $headers);
?>