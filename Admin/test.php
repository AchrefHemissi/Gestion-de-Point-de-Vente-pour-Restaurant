<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to PHPMailer autoload file

// Retrieve form data
$to = $_POST['recipient'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    // Set mailer to use SMTP
    $mail->isSMTP();

    // Gmail SMTP server settings
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'YOUR_GMAIL_ADDRESS@gmail.com'; // Your Gmail address
    $mail->Password = 'YOUR_GMAIL_PASSWORD'; // Your Gmail password
    $mail->Port = 587; // TCP port to connect to

    // Sender and recipient
    $mail->setFrom('YOUR_GMAIL_ADDRESS@gmail.com', 'Your Name');
    $mail->addAddress($to);

    // Email content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send email
    $mail->send();
    echo 'Email sent successfully';
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>
