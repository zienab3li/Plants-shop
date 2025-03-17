<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php'; // Change the path based on where you installed PHPMailer

function sendVerificationEmail($userEmail, $verificationToken) {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'zynaba785.com@gmail.com'; // Replace with your Gmail
        $mail->Password = 'xkku xerl ycrs guhh'; // Replace with App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender & Recipient
        $mail->setFrom('zynaba785.com@gmail.com', 'Plant Shop'); // Your website email
        $mail->addAddress($userEmail);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Email Address';
        $mail->Body = "Click the link below to verify your email:<br>
               <a href='http://localhost:8080/verify.php?token=$verificationToken'>Verify Email</a>";


        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
