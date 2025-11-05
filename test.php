<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
$mail = new PHPMailer(true);
$mail->SMTPDebug = 3;
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Set the SMTP server to send through
    $mail->SMTPAuth   = true;
    $mail->Username   = 'pramodmandlik2014@gmail.com'; // SMTP username
    $mail->Password   = 'tfmq llxh yufp hrrz';           // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->SMTPAutoTLS = false; 
    $mail->SMTPOptions = [
	    'ssl' => [
		    'verify_peer' => false,
		    'verify_peer_name' => false,
		    'allow_self_signed' => true
	    ],
	    'socket' => [
		    'bindto' => '0.0.0.0:0', // This forces IPv4 binding
	    ],
    ];
    //Recipients
    $mail->setFrom('pramodmandlik2014@gmail.com', 'Mailer');
    $mail->addAddress('pramodmandlik2014@gmail.com', 'Pramod Mandlik'); // Add a recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body    = 'This is a test email sent using <b>PHPMailer</b>.';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

