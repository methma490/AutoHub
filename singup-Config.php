<?php


$signup = new mysqli("localhost","root","","autohub"); //connect data base


// check coonection is success
if($signup->connect_error){

    die("connection Failed".$signup->connect_error);

}



?>