<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') die();

require_once '../../config/session.php';
startSession();
if (!isset($_SESSION['recoveryEmail'])) {
    echo json_encode(['error' => 'You have not started a password recovery session, unable to continue.']);
    die();
}

include 'helper.control.php';
require_once '../model/User.php';

$raw_data = file_get_contents("php://input");
$data = json_decode($raw_data, true);

verifyCode($data['code']);

function verifyCode($code) {
    $email = $_SESSION['recoveryEmail'];

    $user = new User();
    $foundUser = $user->getUserByEmail($email);
    if (empty($foundUser)) {
        echo json_encode(['error' => 'Failed to retrieve user data for this email.']);
        die();
    } else if ($foundUser[0]['resetCode'] == null) {
        echo json_encode(['error' => 'Database has no record of a recovery code for this email.']);
        die();
    }

    if (!doesCodeMatch($code, $foundUser[0]['resetCode'])) {
        echo json_encode(['error' => 'Code entered does not match the recovery code.']);
        die();
    }

    if (isCodeValid($foundUser[0]['resetCodeExpiry'])) {
        echo json_encode(['error' => 'Recovery code has expired, please request a new one.']);
        //Remove session since code expired
        session_unset();
        session_destroy();
        die();
    }

    $codeApproved = $user->approveResetCode($email);
    if ($codeApproved) {
        echo json_encode(['success' => 'Recovery code verified successfully.']);
    } else {
        echo json_encode(['error' => 'Failed to approve code in database.']);
    }
}

function doesCodeMatch($code, $resetCode) {
    return $code == $resetCode;
}

function isCodeValid($resetCodeExpiry) {
    return strtotime($resetCodeExpiry) <= time();
}