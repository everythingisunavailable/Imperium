<?php

$email = $_POST["email"];

//krijojm token
$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);
//e bejm q t zgjasi gjys ore
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);
//lidhim databaz
$mysqli = require __DIR__ . "/database.php";
// //ruajm tokenin n databaz beni run kte gjen per databazen
// ALTER TABLE user
//   ADD `reset_token_hash` VARCHAR(64) NULL DEFAULT NULL,
//   ADD `reset_token_expires_at` DATETIME NULL DEFAULT NULL,
//   ADD UNIQUE (`reset_token_hash`);
$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://example.com/reset-password.php?token=$token">here</a> 
    to reset your password.

    END;

    try {

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}

echo "Message sent, please check your inbox.";