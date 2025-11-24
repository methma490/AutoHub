<?php
include 'Review-Config.php'; // Database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {  // Check if the form was submitted using the POST method.
    // Get the email (identifier) and the updated review
    $email = mysqli_real_escape_string($rew, $_POST['email']);
    $review = mysqli_real_escape_string($rew, $_POST['review']);

    // Prepare the SQL UPDATE statement to modify the existing review in the database
    $sql = "UPDATE review_details SET review='$review' WHERE email='$email'";

     // Execute the query and check if it was successful
    if ($rew->query($sql) === TRUE) {
        echo "<script>
                alert('Review updated successfully!');
                window.location.href = 'Review.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $rew->error;
    }

    $rew->close();
}
?>
