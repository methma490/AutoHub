<?php

$cont = new mysqli("localhost","root","","autohub"); //connect data base

// check coonection is success
if($cont->connect_error)
{

    die("connection Failed".$cont->connect_error);
}

?>
