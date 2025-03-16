<?php

//include database here


$query0 = $_GET['query0'] ?? '';
$query1 = $_GET['query1'] ?? '';
//add more vars if needed

if ($query0 == 'product' && !$query1) {
    //TODO : call control functions here
    
    echo 'all products to be displayed here'; //TODO : remove this
}
else if ($query0 == 'product' && $query1 == 'productId'){
    //NOTE : productId can be any product Id, probably a
    //TODO : call control functions here
    
    echo 'one specific product to be displayed'; //TODO : remove this
}
else {
    echo 'url is invalid';
}

?>