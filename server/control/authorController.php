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


//NOTE (FRENKI) : KJO DUHET NDRYSHUAR SI LOGINI NE MENYRE QE TE PRANOJE SI PARAMETRA TE DHENAT DHE JO TI MARRE NGA $_SERVER()
function registerUser()
{
    $name = $surname = $email = $password = $repassword = "";
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {

        // Name
        if (empty($_POST["name"])) {
            $errors['name'] = "Name is required";
        } else {
            $name = test_input($_POST['name']);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $errors['name'] = 'Name should contain only letters and spaces.';
            }
        }

        // Surname
        if (empty($_POST["surname"])) {
            $errors['surname'] = "Surname is required";
        } else {
            $surname = test_input($_POST['surname']);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $surname)) {
                $errors['surname'] = 'Surname should contain only letters and spaces.';
            }
        }

        // Email
        if (empty($_POST["email"])) {
            $errors['email'] = "Email is required";
        } else {
            $email = test_input($_POST['email']);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email format.";
            }
        }

        // Password
        if (empty($_POST["password"])) {
            $errors['password'] = "Password is required";
        } else {
            $password = $_POST['password'];
            if (
                strlen($password) < 8 ||
                !preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/', $password)
            ) {
                $errors['password'] = "Password must be at least 8 characters long and contain at least one letter, one number, and one special character.";
            }
        }

        // Repeat Password
        if (empty($_POST["repeat-password"])) {
            $errors['repassword'] = "Repeat password is required";
        } else {
            $repassword = $_POST['repeat-password'];
            if ($password !== $repassword) {
                $errors['repassword'] = "Passwords do not match.";
            }
        }

        // If errors exist, stop here
        if (!empty($errors)) {
            echo json_encode($errors);
            exit;
        }

        // Check if user exists
        $user = new User();
        $userExists = $user->checkEmail($email);

        if ($userExists) {
            echo json_encode(["email" => "User with this email already exists."]);
            exit;
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
