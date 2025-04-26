<?php
require_once '../vendor/autoload.php';
require_once '../config/google.config.php';

$client = new Google_Client();
$client->setClientId(GOOGLE_CLIENT_ID);
$client->setClientSecret(GOOGLE_CLIENT_SECRET);
$client->setRedirectUri('http://localhost/imperium/server/callback.php');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Get profile info
    $oauth = new Google_Service_Oauth2($client);
    $profile = $oauth->userinfo->get();

    // Example: Save user info in session
    session_start();
    $_SESSION['email'] = $profile->email;
    $_SESSION['user_name'] = $profile->name;
    $_SESSION['user_id'] = $profile->id;

    // Redirect to a protected page
    header('Location: ../public/profile');
    exit;
};

?>
