<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'apikey';                 // SMTP username
$mail->Password = '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';                 //SMTPpassword
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('probnisamp@gmail.com', 'Mailer');
$mail->addAddress('pilipovicnikola68@gmail.com');     // Add a recipient
$mail->addAddress('nikola@addshoppers.com');               // Name is optional

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}