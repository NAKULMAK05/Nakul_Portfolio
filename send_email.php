<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer (if using Composer)

// If manually including PHPMailer, use:
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
// require 'PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    if (!$email) {
        echo "Invalid email address!";
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server (e.g., Gmail, Outlook, etc.)
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com'; // Your email
        $mail->Password = 'your-email-password'; // App password (for security)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Settings
        $mail->setFrom($email, $name);
        $mail->addAddress('your-email@gmail.com'); // Your receiving email
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = "<h3>Name: $name</h3><h3>Email: $email</h3><p>$message</p>";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request!";
}
?>
