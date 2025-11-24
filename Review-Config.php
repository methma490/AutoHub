<?php

$rew = new mysqli("localhost","root","","autohub"); //connect data base

// check coonection is success
if($rew->connect_error){

    die("connection Failed".$rew->connect_error);
}

?>