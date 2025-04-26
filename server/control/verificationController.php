<?php
session_start();
if (!isset($_SESSION["forgotSessionEmailExpiry"])) die("You have not started a password recovery session, unable to continue.");
if ($_SESSION["forgotSessionEmailExpiry"] <= time()) {
    session_unset();
    session_destroy();
    die("Your password recovery session has expired.");
}

$hostname = 'localhost';
$username = 'root';
$pwd = '';
$db_name = 'forgotpasswordtest';

$mysqli = new mysqli($hostname, $username, $pwd, $db_name);
if ($mysqli -> connect_errno) die("Failed to connect to MySQL: " . $mysqli -> connect_error);

if (isset($_POST["code"])) {
    $code = $_POST["code"];
    $email = $_SESSION["forgotSessionEmail"];

    $resetData = retrieveResetCodeFromDatabase($mysqli, $email);
    if (empty($resetData)) die("Failed to retrieve data from the server");

    if (!isCodeValid($mysqli, $resetData[0]['resetCodeExpiry'])) die("Code had expired. Request a new verification code to continue.");

    if (!doesCodeMatch($mysqli, $code, $resetData[0]['resetCode'])) die("Code you entered does not match the one sent in email.");

    header("Location:./../view/newPassword.php");
} else {
    echo "Your'e not supposed to be here >:(";
}

function retrieveResetCodeFromDatabase($mysqli, $email) {
    $query = 'SELECT resetCode, resetCodeExpiry FROM user WHERE email = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function isCodeValid($mysqli, $resetCodeExpiry) {
    return strtotime($resetCodeExpiry) <= date("Y-m-d H-i-s", time());
}

function doesCodeMatch($mysqli, $code, $resetCode) {
    return $code == $resetCode;
}