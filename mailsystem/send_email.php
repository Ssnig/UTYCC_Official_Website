<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; // Ensure Composer's autoloader is included


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'send_email') {
    // Sanitize input
    $name  = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: login.html?message=error');
        exit();
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'aungmyatt080@gmail.com'; 
        $mail->Password   = 'esae pekh iukt fyhh'; // ✅ use Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('aungmyatt080@gmail.com', 'UTYCC');
        $mail->addAddress( $email, $name );
        $mail->addReplyTo($email, $name);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "New Student Sign-In: $name";
        $mail->Body    = "
            <h2>New Student Sign-In Notification</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Sign-In Time:</strong> " . date('Y-m-d H:i:s') . "</p>
        ";
        $mail->AltBody = "New Student Sign-In:\nName: $name\nEmail: $email\nPhone: $phone\nTime: " . date('Y-m-d H:i:s');

        // Debug (for testing only)

        $mail->send();

        // For production: redirect back
        // header('Location: login.html?message=success');
        // exit();

        echo "✅ Message sent successfully!";

    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);

        // For production
        // header('Location: login.html?message=error');
        // exit();

        echo "❌ Message could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location: login.html');
    exit();
}
