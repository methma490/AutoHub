<?php
header('Content-Type: application/json'); // Ensure the response type is JSON

// Database connection
$host = 'localhost';
$db = 'autohub';
$user = 'root';
$pass = '';

$pro = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($pro->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $pro->connect_error]));
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $nationalid = $_POST['nationalid'] ?? '';
    $addressline1 = $_POST['addressline1'] ?? '';
    $addressline2 = $_POST['addressline2'] ?? '';
    $city = $_POST['city'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $postalcode = $_POST['postalcode'] ?? '';

    // Prepared statement to insert data into the table
    $stmt = $pro->prepare("INSERT INTO profile_details (name, email, nationalid, addressline1, addressline2, city, phone, postalcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $nationalid, $addressline1, $addressline2, $city, $phone, $postalcode);

    if ($stmt->execute()) {
        // Return the inserted data as JSON response
        $response = [
            'name' => $name,
            'email' => $email,
            'nationalid' => $nationalid,
            'addressline1' => $addressline1,
            'addressline2' => $addressline2,
            'city' => $city,
            'phone' => $phone,
            'postalcode' => $postalcode
        ];
        echo json_encode($response);
    } else {
        // Return an error message if insert fails
        echo json_encode(['error' => $stmt->error]);
    }
    // Close the statement
    $stmt->close();
}

// Close the database connection
$pro->close();
?>
