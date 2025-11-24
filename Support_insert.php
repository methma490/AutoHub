<?php
include 'support-Config.php'; // database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //capture the email and question
    $email = mysqli_real_escape_string($sup, $_POST['semail']);
    $question = mysqli_real_escape_string($sup, $_POST['squestion']);
    
    // Insert email and question into the database
    $sql = "INSERT INTO support_details (email, question) VALUES ('$email', '$question')";
    
    // Execute query and check if successful
    if ($sup->query($sql) === TRUE) {
        echo "<script>
                alert('Message send successfully!');
                window.location.href = 'Support.html';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $sup->error;
    }
    
    // Close the connection
    $sup->close();
}
?>