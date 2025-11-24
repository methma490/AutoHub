<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


require 'singup-Config.php'; // connect in to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if the keys exist in the POST array
    if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

     
      //  inserting data into the database
        $sql = "INSERT INTO signup_details (name, email, password) VALUES (?, ?, ?)";
        $stmt = $signup->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . htmlspecialchars($signup->error));
        }

        // Hash the password for security
        //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
          
            echo "<script> 

            alert('Registration successful!'); 
            window.location.href = 'login.html'
          
            </script>";
            
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Error: Required fields are missing.";
    }

    $signup->close(); // close the connection

} 



/* else {
    echo "Invalid request method.";
}*/



?>
