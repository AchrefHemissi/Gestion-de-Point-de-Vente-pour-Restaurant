
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/phpmailer/src/Exception.php';
require '../phpmailer/phpmailer/src/PHPMailer.php';
require '../phpmailer/phpmailer/src/SMTP.php';

// Retrieve form data
$email = $_POST['email'];
$msg = $_POST['msg'];
$to = "gl.icious.team@gmail.com";
$subject = "Feedback From: $email";


// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    // Set mailer to use SMTP
    $mail->isSMTP();

    //Gmail SMTP server settings
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'the gmail of the company'; 
    $mail->Password = 'the password of the gmail'; 
    $mail->Port = 587; // TCP port to connect to

    // Sender and recipient
    $mail->setFrom('the gmail of the company', 'the name of the company');
    $mail->addAddress($to);

    // Email content
    $mail->isHTML(true); // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body = $msg;

    // Send email
    $mail->send();
    echo 'Email sent successfully ce lien expire automatiquement après 5 secondes.';
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}" + " ce lien expire automatiquement après 5 secondes.";
}
echo "<script>
setTimeout(function(){
    window.location.href = 'contact.php';
}, 5000);
</script>";
