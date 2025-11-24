
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'singup-Config.php'; // connect database connection file 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the form input and store variabals
    $email = trim($_POST['email']);
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    

    // Prepare SQL to fetch the user with the provided email
    $sql = "SELECT * FROM signup_details WHERE email = ?";
    $stmt = $signup->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . htmlspecialchars($signup->error));
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user with the provided email exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $stored_password = $user['password'];

        // Check if the old password matches
        if ($old_password === $stored_password) {
            // If valid, update the password
            $update_sql = "UPDATE signup_details SET password = ? WHERE email = ?";
            $stmt_update = $signup->prepare($update_sql);
            if ($stmt_update === false) {
                die("Error preparing update statement: " . htmlspecialchars($signup->error));
            }

            $stmt_update->bind_param("ss", $new_password, $email);

            if ($stmt_update->execute()) {
                
                // password update succsessfull 
                echo "<script>
                        alert('Password updated successfully!');
                        window.location.href = 'Home.html';
                      </script>";  
            } else {
                echo "Error updating password: " . $stmt_update->error;
            }

            $stmt_update->close();

        } else {
           
            // password does not exits,the allert box open 
            echo "<script>

                alert('Error: Old password is incorrect.');
                window.location.href = 'change_password.html';
            
                </script>";
        }

    } else {
        
        // email does not exits,the allert box open 
        echo "<script>

        alert('Error: User with this email does not exist.');
        window.location.href = 'change_password.html';
    
        </script>";
    }

    $stmt->close();
    $signup->close(); // Close the database connection

}
?>
