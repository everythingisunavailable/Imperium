<?php

//include database here

$query0 = $_GET['query0'] ?? '';
$query1 = $_GET['query1'] ?? '';
//add more vars if needed

if ($query0 == 'login' && !$query1) {
    //TODO : call control functions here
    include './views/login.php';
} else if ($query0 == 'register' && !$query1) {
    //TODO : call control functions here
    echo 'register page'; //TODO : remove this
} else if ($query0 == 'logout' && !$query1) {
    //TODO : call control functions here
    echo 'logout page'; //TODO : remove this
} else if ($query0 == 'home' && !$query1) {
    //TODO : call control functions here
    echo 'home page'; //TODO : remove this
} else

if ($query0 == 'product' && !$query1) {
    //TODO : call control functions here

} else if ($query0 == 'product' && $query1) {
    //NOTE : productId can be any product Id, probably a
    //TODO : call control functions here


    echo 'one specific product to be displayed'; //TODO : remove this
} else if (empty($query0) && empty($query1)) {

    echo '';
} else {
    echo 'url is invalid';
}
