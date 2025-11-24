<?php

$sup = new mysqli("localhost","root","","autohub"); //connect data base

// check coonection is success
if($sup->connect_error){

    die("connection Failed".$sup->connect_error);
}

?>