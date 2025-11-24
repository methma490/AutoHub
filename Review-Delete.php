<?php
include 'Review-Config.php'; // Database configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the request method is POST (form submission).
    // Get the email (identifier) for the review to delete
    $email = mysqli_real_escape_string($rew, $_POST['email']);

    // Delete the review corresponding to the email
    $sql = "DELETE FROM review_details WHERE email='$email'";

    if ($rew->query($sql) === TRUE) { // Execute the query and check if it was successful.
        echo "<script>
                alert('Review deleted successfully!');
                window.location.href = 'Review.php';
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $rew->error; // Output the SQL error message for debugging purposes.
    }

    $rew->close();
}
?>
