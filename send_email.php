<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill out all fields and provide a valid email address.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com';  // TODO: Set the SMTP server to send through
        $mail->SMTPAuth   = true;
        $mail->Username   = 'user@example.com';  // TODO: SMTP username
        $mail->Password   = 'secret';          // TODO: SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail_port = 587;

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('aditya.jagtap@indionetworks.com', 'Aditya Jagtap'); // Add a recipient

        // Content
        $mail->isHTML(false);
        $mail->Subject = "New contact from $name: $subject";
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        header("Location: thank-you.html");
    } catch (Exception $e) {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message. Mailer Error: ". $mail->ErrorInfo;
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
