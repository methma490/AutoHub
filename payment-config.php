<?php


$payment = new mysqli("localhost","root","","autohub"); //connect data base


// check coonection is success
if($payment->connect_error){

    die("connection Failed".$payment->connect_error);

}


?>