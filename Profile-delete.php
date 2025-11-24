<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email from the POST request
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // Validate the email
    if (!empty($email)) {
        
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "autohub"; 

        // Create a connection to the MySQL database
        $pro = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection is successful
        if ($pro->connect_error) {
            die("Connection failed: " . $pro->connect_error);
        }

        // Prepare the SQL statement to delete the user with the given email
        $sql = "DELETE FROM profile_details WHERE email = ?";
        $stmt = $pro->prepare($sql);

        // Bind the email parameter to the SQL statement
        $stmt->bind_param("s", $email);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // Check if any row was deleted
            if ($stmt->affected_rows > 0) {
                echo "Profile deleted successfully.";
            } else {
                echo "No profile found with that email.";
            }
        } else {
            // If there's an error in the execution
            echo "Error deleting profile: " . $pro->error;
        }

        // Close the statement and the connection
        $stmt->close();
        $pro->close();
    } else {
        // If the email is empty
        echo "Email is required.";
    }
} else {
    // If the request method is not POST, show an error
    echo "Invalid request method.";
}
?>
