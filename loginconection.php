<?php
// Database connection
$signup = new mysqli("localhost", "root", "", "autohub");

// Check if connection is successful
if ($signup->connect_error) {
    die("Connection failed: " . $signup->connect_error);
}
?>
