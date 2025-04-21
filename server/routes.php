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
    
    include './view/login.php';
}
else if ($query0 == 'logout' && !$query1) {
    
    echo 'logout page';
}
else if (!$query0 && !$query1 && empty($data)) {
    
    echo 'home page';
}
else if ($query0 == 'product' && !$query1) {
    
    echo 'all products page';
}
else if ($query0 == 'product' && $query1) {
    
    echo 'one specific product to be displayed';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  !empty($data)) {
    if (isset($headers['Request-Type'])) {
        if ($headers['Request-Type'] == 'login') {
            loginUser($data['email'], $data['password']);
        }
        else if ($headers['Request-Type'] == 'login') {
            //register function here
        }
    }
    else{
        echo json_encode (["error" => 'there is no header in the request']); // TODO : MAKE STANDART KEYS TO HANDLE ERRORS BETTER
    }
}
else {
    echo 'url is invalid';
}
