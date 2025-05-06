<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') die();

include 'helper.control.php';
require_once '../model/User.php';

$raw_data = file_get_contents("php://input");
$data = json_decode($raw_data, true);

requestCode($data['email']);

function requestCode($email) {
    $user = new User();
    $foundUser = $user->getUserByEmail($email);
    if (empty($foundUser)) {
        echo json_encode(['error' => 'Email not found.']);
        die();
    }

    $code = random_int(100000, 999999);
    $tokenGenerated = $user->generateRecoveryToken($email, $code);
    if (!$tokenGenerated) {
        echo json_encode(['error' => 'Failed to generate recovery token.']);
        die();
    }

    if (sendMail($email, $code)) {
        require_once '../../config/session.php';
        startSession();
        $_SESSION['recoveryEmail'] = $email;

        echo json_encode(['success' => 'Recovery email send successfully.']);
    } else {
        echo json_encode(['error' => 'Failed to send mail.']);
    }
}

function sendMail($receiver, $code) {
    //Xampp version
    $subject = 'Password Reset Code';
    $body = 'Your password reset code is '.$code.'. This code will expire in 5 minutes.';
    $sender = 'noreply@Imperium.com';

    $emailConfirmed = mail($receiver, $subject, $body, $sender);
    return $emailConfirmed;

    //PHP Mailer Version
    /*
    require 'vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'localhost';
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'notifications.imperium@gmail.com';
    $mail->Password = 'wxgsuywslymywyce';
    $mail->Port = 587;

    $mail->isHTML(true);
    $mail->setFrom('no-reply@Imperium.com', 'Imperium');
    $mail->addAddress($receiver);
    $mail->Subject = 'Password Reset Code';
    $mail->Body = 'Your password reset code is '.$code.'. This code will expire in 5 minutes.';

    return $mail->send();
    */
}