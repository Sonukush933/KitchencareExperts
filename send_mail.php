<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Change based on your email provider
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Your email
        $mail->Password = 'your-email-password'; // Use App Password if using Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender & Recipient
        $mail->setFrom($_POST['email'], $_POST['name']);
        $mail->addAddress('krishnag20001@gmail.com'); // Change to your receiving email

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Service Request from " . $_POST['name'];
        $mail->Body = "
        <h2>New Service Request</h2>
        <p><strong>Name:</strong> {$_POST['name']}</p>
        <p><strong>Email:</strong> {$_POST['email']}</p>
        <p><strong>Phone:</strong> {$_POST['phone']}</p>
        <p><strong>Service:</strong> {$_POST['service']}</p>
        <p><strong>Address:</strong> {$_POST['address']}</p>
        <p><strong>Zip Code:</strong> {$_POST['zipcode']}</p>
        <p><strong>Subject:</strong> {$_POST['subject']}</p>
        <p><strong>Message:</strong><br> {$_POST['message']}</p>";

        $mail->send();
        echo "Success";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
