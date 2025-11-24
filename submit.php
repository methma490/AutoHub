<?php

// Database credentials
$servername = "localhost";
$username = "root";  // Adjust with your MySQL username
$password = "";  // Adjust with your MySQL password
$dbname = "autohub";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Debug: Print the $_POST array to check if data is coming through
print_r($_POST);

// Check if POST variables are set and not empty
if (!empty($_POST['id']) && !empty($_POST['issue'])) {
    $user_id = $_POST['id'];
    $Messa_ge = $_POST['issue'];
    $action = $_POST['action'];

    // Check if the user ID exists in the database
    $check_sql = "SELECT * FROM ask_question WHERE user_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    // If user ID exists
    if ($result->num_rows > 0) {
        if ($action == "Update") {
            // Update an existing record
            $sql = "UPDATE ask_question SET Messa_ge = ? WHERE user_id = ?";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing the query: " . $conn->error);
            }

            $stmt->bind_param("ss", $issue_description, $user_id);

            if ($stmt->execute()) {
                echo "Record updated successfully";
            } else {
                echo "Error executing the query: " . $stmt->error;
            }
            $stmt->close();
        
        } elseif ($action == "Delete") {
            // Delete a record
            $sql = "DELETE FROM ask_question WHERE user_id = ?";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing the query: " . $conn->error);
            }

            $stmt->bind_param("s", $user_id);

            if ($stmt->execute()) {
                echo "Record deleted successfully";
            } else {
                echo "Error executing the query: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        // If the user ID doesn't exist, only allow Insert action
        if ($action == "Submit") {
            // Insert a new record
            $sql = "INSERT INTO ask_question (user_id, Messa_ge) VALUES (?, ?)";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing the query: " . $conn->error);
            }

            $stmt->bind_param("ss", $user_id, $Messa_ge);
            
            if ($stmt->execute()) {
                echo "New record created successfully";
            } else {
                echo "Error executing the query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: Cannot Update or Delete. The entered user ID does not exist.";
        }
    }

    // Close check statement
    $check_stmt->close();
} else {
    echo "Error: Missing form data. Please ensure all fields are filled.";
}

$conn->close();
?>