<?php 
$emailTo = "allollal@mail.ru"; 
$subject = "I hope this works!";
$body = "test simple email";
$headers = "From: allollal@mail.ru";

if(mail($emailTo, $subject, $body, $headers)){
    echo "Your message was sent, we\'ll get back to you ASAP!";
} else {
    echo "Your message was not sent successfully.";
}
header("Location: ../../login.php");
?>