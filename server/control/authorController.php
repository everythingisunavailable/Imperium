<?php
require_once '../model/user.php';
include '../config/constants.php';

function showLoginForm()
{
    include '../app/views/login.php';
}

// Handle login (POST /login)






function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
