<?php
function showLoginForm(){
    require_once 'view/login.view.php';
    display_login();
}
function showForgotPassword(){
    require_once 'view/forgotPassword.view.php';
    display_forgot();
}
function logoutUser()
{
    destroySession();
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
