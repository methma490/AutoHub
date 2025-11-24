<?php
// Database connection
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "autohub"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch vehicle ads
$sql = "SELECT * FROM vehicle_ads";
$result = $conn->query($sql);

// Prepare ads array
$ads = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $ads[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return ads as JSON
header('Content-Type: application/json');
echo json_encode($ads);
?>
