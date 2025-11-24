<?php

// Database credentials
$servername = "localhost";
$username = "root";  
$password = "";  
$dbname = "autohub";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

print_r($_POST);

// Check POST variables 
if (!empty($_POST['id']) && !empty($_POST['issue'])) {
    $user_id = $_POST['id'];
    $issue_description = $_POST['issue'];
    $action = $_POST['action'];

    // Check  the user ID exist in  database
    $check_sql = "SELECT * FROM verification_issues WHERE user_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $user_id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    // user ID exists
    if ($result->num_rows > 0) {
        if ($action == "Update") {
            // Update  record
            $sql = "UPDATE verification_issues SET issue_description = ? WHERE user_id = ?";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing the query: " . $conn->error);
            }

            $stmt->bind_param("ss", $issue_description, $user_id);

            if ($stmt->execute()) {
                echo "<script>
                alert('issue updated successfully');
                window.location.href = 'issues.html';
            </script>";
            } else {
                echo "Error executing the query: " . $stmt->error;
            }
            $stmt->close();
        
        } elseif ($action == "Delete") {
            // Delete a record
            $sql = "DELETE FROM verification_issues WHERE user_id = ?";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing the query: " . $conn->error);
            }

            $stmt->bind_param("s", $user_id);

            if ($stmt->execute()) {
                
                echo "<script>
                alert('issue deleted successfully');
                window.location.href = 'issues.html';
            </script>";
            } else {
                echo "Error executing the query: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        
        if ($action == "Submit") {
            // Insert a new record
            $sql = "INSERT INTO verification_issues (user_id, issue_description) VALUES (?, ?)";

            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing the query: " . $conn->error);
            }

            $stmt->bind_param("ss", $user_id, $issue_description);
            
            if ($stmt->execute()) {
                echo "<script>
                alert('New record created successfully');
                window.location.href = 'issues.html';
            </script>";
            } else {
                echo "Error executing the query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "<script>
            alert('Error: Cannot Update or Delete. The entered user ID does not exist.');
            window.location.href = 'issues.html';
        </script>";
        }
    }

    // Close check statement
    $check_stmt->close();
} else {
    echo "Error: Missing form data. Please ensure all fields are filled.";
}

$conn->close();
?>
