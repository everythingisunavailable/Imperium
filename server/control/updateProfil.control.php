<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] != 'POST') die();

$raw_data = file_get_contents("php://input");
$postData = json_decode($raw_data, true);
$headers = getallheaders();
$requestType = $headers['Request-Type'] ?? null;



if (!$requestType) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Missing Request-Type header']);
    exit;
}

include 'helper.control.php';
require '../model/User.php';
require '../../config/db.php';

$user = new User($conn);
$userId = $_SESSION['user_id'] ?? null;


if (!$userId) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

switch ($requestType) {
    case 'update_profile':
        updateProfile($user, $userId, $postData);
        break;

    case 'remove_item':
        removeItem($user, $userId, $postData);
        break;

    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Unknown request type']);
        break;
}


function updateProfile($user, $userId, array $postData)
{

    $name = trim($postData['username'] ?? '');
    $email = trim($postData['email'] ?? '');


    if (empty($name) && empty($email)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'At least one of name or email is required']);
        return;
    }


    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        return;
    }


    $userData = $user->getUserById($userId);
    if (!$userData) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'User not found']);
        return;
    }


    $newData = [];
    if (!empty($name)) {
        $newData['name'] = $name;
    }
    if (!empty($email)) {
        $newData['email'] = $email;
    }

    $success = $user->updateUser($userId, $newData);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to update profile or no changes detected']);
    }
}

function removeItem($user, $userId, $postData)
{
    $itemId = $postData['itemId'] ?? null;
    if (!$itemId) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Item ID is required']);
        return;
    }

    $success = $user->removeSavedItem($userId, $itemId);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Item removed successfully']);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
    }
}
$conn = null;
