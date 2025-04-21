<?php

//include database here 
require_once 'control/authorController.php';

# POST METHOD DATA
$raw_data = file_get_contents("php://input");
$data = json_decode($raw_data, true);
$headers = getallheaders();


# GET METHOD DATA
$query0 = $_GET['query0'] ?? '';
$query1 = $_GET['query1'] ?? '';
//add more vars if needed

if ($query0 == 'login' && !$query1) {
    startSession();
    if(isset($_SESSION['user_id'])){
        echo '<h1>Welcome <span style ="color: blue">'. $_SESSION['user_name'] . '</span> with id ' . $_SESSION['user_id'] . '</h1>';
    }
    else{
        include './view/login.php';
    }
}
else if (!$query0 && !$query1 && !isset($headers['Request-Type'])) {
    echo 'home page';
}
else if($query0 == 'profile' && !$query1){
    startSession();
    if (isset($_SESSION['user_id'])){
        echo '<h1>Welcome <span style ="color: blue">'. $_SESSION['user_name'] . '</span> with id ' . $_SESSION['user_id'] . '</h1>';
    }
    else{
        echo 'not logged in / sessino not started';
    }
}
else if ($query0 == 'product' && !$query1) {

    echo 'all products page';
}
else if ($query0 == 'product' && $query1) {
    
    echo 'one specific product to be displayed';
}
    //NOTE(FRENKI) : functions that have to do with POST return to front end json data...others return strings
else if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($headers['Request-Type'])) {
    if (isset($headers['Request-Type'])) {
        if ($headers['Request-Type'] == 'login') {
            loginUser($data['email'], $data['password']);
        }
        else if ($headers['Request-Type'] == 'signup') {
            registerUser($data['name'], $data['surname'], $data['email'], $data['password'], $data['password_again']);
        }
        // if($headers['Request-Type'] == 'logout'){
        //     destroySession();
        // }
    }
    else{
        echo json_encode (["error" => 'there is no header in the request']); // TODO : MAKE STANDART KEYS TO HANDLE ERRORS BETTER
    }
}
else {
    echo 'url is invalid';
}