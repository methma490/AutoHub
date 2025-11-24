<?php
include 'Review-Config.php'; // database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the form was submitted via POST method.
    // Sanitize and capture the email and question
    $email = mysqli_real_escape_string($rew, $_POST['remail']);
    $name = mysqli_real_escape_string($rew, $_POST['rname']);
    $review = mysqli_real_escape_string($rew, $_POST['review']);
    
     // Prepare the SQL INSERT statement to add the new review into the database
    $sql = "INSERT INTO review_details (email, name, review) VALUES ('$email', '$name', '$review')";
    
    // Execute query and check if successful
    if ($rew->query($sql) === TRUE) {
        echo "<script>
                alert('Review saved successfully!');
                window.location.href = 'Review.php';
            </script>"; 
    } else {
        echo "Error: " . $sql . "<br>" . $rew->error;
    }
    
    // Close the connection
    $rew->close();
}
?>