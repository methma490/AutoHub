<?php

$pro = new mysqli("localhost","root","","autohub"); //connect data base

// check coonection is success
if($pro->connect_error){

    die("connection Failed".$pro->connect_error);
}
else{
    echo"right";
}
?>