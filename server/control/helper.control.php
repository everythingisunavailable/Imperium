<?php
function showHome(){
    require_once 'view/home.view.php';
    display_home();
}
function showLoginForm(){
    require_once 'view/login.view.php';
    display_login();
}
function showForgotPassword(){
    require_once 'view/forgotPassword.view.php';
    display_forgot();
}
function showChangePassword(){
    //NOTE (FRENKI) : check for sessions
    require_once 'view/changePassword.view.php';
    display_change_password();   
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
