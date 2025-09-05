<?php

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function generateRandomPassword($length = 6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $password = substr(str_shuffle($chars), 0, $length);

    return $password;

}

// Function to generate random user ID

function generateRandomID($prefix = '2025-', $length = 6) {

    $numbers = "0123456789";

    $randomNumbers = substr(str_shuffle($numbers), 0, $length);

    return $prefix . $randomNumbers;

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'send_email') {

    // Sanitize input

    $name  = htmlspecialchars(trim($_POST['name']));

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $phone = htmlspecialchars(trim($_POST['phone']));

    $userId = generateRandomID();

    $password = generateRandomPassword();

    // Validate email

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        header('Location: login.html?message=error');

        exit();

    }


    $mail = new PHPMailer(true);


    try {

        // SMTP settings

        $mail->isSMTP();

        $mail->Host       = 'smtp.privateemail.com';

        $mail->SMTPAuth   = true;

        $mail->Username   = 'info@utycc.site';

        $mail->Password   = 'info';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        $mail->Port       = 465;


        // Recipients

        $mail->setFrom('info@utycc.site', 'UTYCC');

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

            <p><strong>Student ID:</strong> $userId</p>

             <p><strong>Password:</strong> $password</p>

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