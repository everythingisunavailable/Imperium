<?php
require_once 'model/User.php';
include '../config/config_settings.php';


// NOTE (FRENKI): KETO DUHEN HEQUR OSE KALUAR TE VIEW
function showLoginForm()
{
    include '../views/login.php';
}

function showRegisterForm()
{
    include '../views/register.php';
}

function showLogoutForm()
{
    include '../views/Login.php';
}

// Handle login (POST /login)
function loginUser(string $email, string $password)
{
    $errors = [];
        // Email validation
    $email = test_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }
    // Authenticate
    $user = new User();
    $foundUser = $user->getUserByEmail($email);
    if (empty($foundUser)) {
        $errors['email'] = 'User not found';
    }
    //testing
    else if (!password_verify($password, $foundUser['password'])) {
        $errors['password'] = 'Wrong password';
    }


    // Stop if errors
    if (!empty($errors)) {
        echo json_encode($errors);
        exit;
    }


    // Start session
    startSession();
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id'] = $foundUser['id'];
    $_SESSION['user_name'] = $foundUser['name'];

    echo json_encode(["success" => "Logged in successfully."]);
}


function registerUser($name, $surname, $email, $password, $password_again)
{
    $errors = [];
    // Name
    if (empty($name)) {
        $errors['name'] = "Name is required";
    } else {
        $name = test_input($name);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $errors['name'] = 'Name should contain only letters and spaces.';
        }
    }

    // Surname
    if (empty($surname)) {
        $errors['surname'] = "Surname is required";
    } else {
        $surname = test_input($surname);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
            $errors['surname'] = 'Surname should contain only letters and spaces.';
        }
    }

    // Email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } else {
        $email = test_input($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format.";
        }
    }

    // Password
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } else {
        if (strlen($password) < 8 ||
            !preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/', $password)
        ) {
            $errors['password'] = "Password must be at least 8 characters long and contain at least one letter, one number, and one special character.";
        }
    }

    // Repeat Password
    if (empty($password_again)) {
        $errors['repassword'] = "Repeated password is required";
    } else {
        if ($password !== $password_again) {
            $errors['password_again'] = "Passwords do not match.";
        }
    }

    // Check if user exists
    $user = new User();
    $userExists = $user->checkEmail($email);
    if ($userExists) {
        $errors['email'] = "User with this email already exists!";
    }

    // If errors exist, stop here
    if (!empty($errors)) {
        echo json_encode($errors);
        exit;
        die();
    }

    // Register user
    $isCreated = $user->register($name, $surname, $email, $password);

    if (!$isCreated) {
        echo json_encode(["error" => "Registration failed. Please try again."]);
    } else {
        echo json_encode(["success" => "Successfully registered!"]);
    }

    exit;

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
