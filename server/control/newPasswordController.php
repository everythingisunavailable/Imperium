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

if (isset($_POST["newPassword"]) && isset($_POST["confirmPassword"])) {
    $newPass = $_POST["newPassword"];
    $confirmPass = $_POST["confirmPassword"];
    $email = $_SESSION["forgotSessionEmail"];

    if (!validateNewPassword($newPass, $confirmPass)) die("Password validation failed.");

    if (!savePassword($mysqli, $email, $newPass)) die("Failed to save password in the database.");

    session_unset();
    session_destroy();

    header("Location:./../view/login.php");
} else {
    echo "Your'e not supposed to be here >:(";
}

function validateNewPassword($newPass, $confirmPass) {
    if ($newPass != $confirmPass) {
        echo "Confirm password does not match the new password";
        return false;
    }

    //Usual password vaildation same as in login

    return true;
}

function savePassword($mysqli, $email, $pass) {
    $query = 'UPDATE user SET password = ? WHERE email = ?';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('ss', $pass, $email);
    $stmt->execute();

    return $mysqli->affected_rows;
}