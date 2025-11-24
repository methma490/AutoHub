<?php
include 'Contact-config.php'; // database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and capture the email and question
    $fullname = mysqli_real_escape_string($cont, $_POST['fullname']);
    $email = mysqli_real_escape_string($cont, $_POST['email']);
    $contactNumber = mysqli_real_escape_string($cont, $_POST['contactnumber']);
    $message = mysqli_real_escape_string($cont, $_POST['message']);
    
    // Insert email and question into the database
    $sql = "INSERT INTO contact_details (fullname,email,contactnumber,message) VALUES ('$fullname','$email','$contactNumber','$message')";
    
    // Execute query and check if successful
    if ($cont->query($sql) === TRUE) {
        echo "<script>
                alert('Texts saved successfully!');
                window.location.href = 'Contact.html';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $cont->error;
    }
    
    // Close the connection
    $cont->close();
}
?>