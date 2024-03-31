<?php

$name = $_POST['name'];
$email = $_POST['email'];
$msg=$_POST["msg"];
$to="meddhia310@gmail.com";
$subject="Feedback";
$headers="From: $email";

if(mail($to,$subject,$msg,$headers))
{
    echo "Thanks for contacting us";
}
else
{
    echo "Mail not sent";
}

