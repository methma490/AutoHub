<?php
session_start(); 
ob_start();

// Include the database connection file
require 'loginconection.php'; 

// Check if the form was submitted (POST request)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the input values from the form
    $email = trim($_POST['uid']);
    $password = $_POST['upassword'];

    // Check if email and password are provided
    if (empty($email) || empty($password)) {
        echo "<script>
                alert('Email and password are required.');
                window.location.href = 'login.html';
            </script>";
        exit();
    }

    // Prepare the SQL query to fetch user by email
    $sql = "SELECT * FROM signup_details WHERE email = ?";
    $stmt = $signup->prepare($sql);

    // Check if SQL statement preparation was successful
    if ($stmt === false) {
        die("Error preparing statement: " . htmlspecialchars($signup->error));
    }

    // Bind the email parameter to the SQL query
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the email exists in the database
    if ($result->num_rows > 0) {
        // Fetch the user's row
        $user = $result->fetch_assoc();

        // Check if the password matches the one stored in the database
        if ($password === $user['password']) {
            // If the password is correct, set session for the logged-in user
            $_SESSION['user'] = $user['email'];

            // succesfull go home page
            echo "<script>
                alert('Login successful!');
                window.location.href = 'Home.html';
            </script>";
            exit();
        } else {
            // Incorrect password again login page
            echo "<script>
                alert('incorect password');
                window.location.href = 'login.html';
            </script>";
        }
    } else {
        // incorrect email
        echo "<script>
        alert('No account found for the entered email');
        window.location.href = 'login.html';
    </script>";
    }

    // Close statement and connection
    $stmt->close();
    $signup->close();
} else {
    
    echo "Please submit the form.";
}

ob_end_flush(); 
?>
