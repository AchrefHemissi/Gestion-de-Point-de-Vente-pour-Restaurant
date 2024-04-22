<?php
include 'session_check.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Retrieve form data
$email = $_POST['email'];
$msg = $_POST['msg'];
$to = 'the gmail of the company';
$subject = "Feedback From: $email";


// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    // Set mailer to use SMTP
    $mail->isSMTP();

    //Gmail SMTP server settings
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'the gmail of the company'; // Your Gmail address
    $mail->Password = 'the password of the gmail';  // Your Gmail password
    $mail->Port = 587; // TCP port to connect to

    // Sender and recipient
    $mail->setFrom('the gmail of the company', 'the name of the company');
    $mail->addAddress($to);

    // Email content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $msg;


    $mail->send();
    $isSent = true;
} catch (Exception $e) {

    $isSent = false;
}


$color = $isSent ? "#ff6d00" : "red";
$message = $isSent ? "Email sent successfully. Thank you for your feedback! " : "Error sending email. Please try again.";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 50px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: <?php echo $color; ?>;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
    <link rel="shortcut icon" type="x-icon" href="images/logo.png" />
</head>

<body>
    <div class="container">
        <p><?php echo $message; ?></p>
        <p>This link will expire automatically after <span id="countdown">7</span> seconds.</p>

    </div>

    <script>
        var count = parseInt(document.getElementById('countdown').innerHTML);

        function countdown() {

            document.getElementById('countdown').innerHTML = count;
            count--;
            if (count < 0) {

                window.location.href = 'contact.php';
            } else {

                setTimeout(countdown, 1000);
            }
        }

        countdown();
    </script>
</body>

</html>