<?php
$to = "adijagtap1112@gmail.com";
$subject = "Test Email from PHP";
$message = "This is a simple email sent using the PHP mail() function.";
$headers = "From: webmaster@example.com" . "\r\n" .
           "Reply-To: webmaster@example.com" . "\r\n" .
           "X-Mailer: PHP/" . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo "Email successfully sent to $to!";
} else {
    echo "Email sending failed.";
}
?>
