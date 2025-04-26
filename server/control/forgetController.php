<?php
$hostname = 'localhost';
$username = 'root';
$pwd = '';
$db_name = 'forgotpasswordtest';

$mysqli = new mysqli($hostname, $username, $pwd, $db_name);
if ($mysqli -> connect_errno) die("Failed to connect to MySQL: " . $mysqli -> connect_error);

if (isset($_POST["email"])) {
    $receiver = $_POST["email"];
    
    if (!doesEmailExist($mysqli, $receiver)) die("Email not found");

    $code = random_int(100000, 999999);
    if (!generateToken($mysqli, $receiver, $code)) die("Reset code failed to generate");

    if (!sendMail($receiver, $code)) die("Failed to send recovery email");

    //Start session for confirming verifcation code and password
    session_start();
    $_SESSION["forgotSessionEmail"] = $receiver;
    $_SESSION["forgotSessionEmailExpiry"] = time() + 60 * 10;

    //Redirect to code verification
    header("Location:./../view/codeVerification.php");
} else {
    echo "Your'e not supposed to be here >:(";
}

function doesEmailExist($mysqli, $email) {
    $query = 'SELECT * FROM user WHERE email = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return !empty($result->fetch_all(MYSQLI_ASSOC));
}

function generateToken($mysqli, $email, $code) {
    $expiry = date("Y-m-d H-i-s", time() + 60 * 5); //current time plus 5 minutes

    $query = 'UPDATE user SET resetCode = ?, resetCodeExpiry = ? WHERE email = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sss', $code, $expiry, $email);
    $stmt->execute();

    return $mysqli->affected_rows;
}

function sendMail($receiver, $code) {
    $subject = "Password Reset Code";
    $body = "Your password reset code is ".$code.". This code will expire in 5 minutes.";
    $sender = "noreply@example.com";

    $emailConfirmed = mail($receiver, $subject, $body, $sender);
    return $emailConfirmed;
}