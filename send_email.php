<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

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
        $mail->setFrom('pramodmandlik2014@gmail.com', 'Contact Form');
        $mail->addAddress('pramodmandlik2014@gmail.com', 'Mandlik Pile Foundation'); // Add a recipient
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission: ' . $subject;
        $mail->Body    = "You have received a new message from your website contact form.<br><br>".
                         "Here are the details:<br>".
                         "<b>Name:</b> {$name}<br>".
                         "<b>Email:</b> {$email}<br>".
                         "<b>Subject:</b> {$subject}<br>".
                         "<b>Message:</b><br>{$message}";
        $mail->AltBody = "You have received a new message from your website contact form.\n\n".
                         "Here are the details:\n".
                         "Name: {$name}\n".
                         "Email: {$email}\n".
                         "Subject: {$subject}\n".
                         "Message:\n{$message}";

        $mail->send();
        
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success']);
        exit;

    } catch (Exception $e) {
        header('Content-Type: application/json');
        http_response_code(500); // Internal Server Error
        echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
        exit;
    }
} else {
    echo "Invalid request method.";
}
?>
