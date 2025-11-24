<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autohub";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create 'uploads' directory if it doesn't exist
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    $full_name = $_POST['full-name'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone_number = $_POST['phone-number'] ?? null;
    $postal_code = $_POST['postal-code'] ?? null;
    $district = $_POST['district'] ?? null;
    $city = $_POST['city'] ?? null;
    $terms_accepted = isset($_POST['terms']) ? 1 : 0;

    // File uploads and sanitization
    $front_side = str_replace(' ', '_', $_FILES['front-side']['name'] ?? null);
    $rear_side = str_replace(' ', '_', $_FILES['rear-side']['name'] ?? null);

    if ($full_name && $email && $phone_number && $postal_code && $front_side && $rear_side && $district && $city) {
        // Check for file uploads and move them to the 'uploads' directory
        if ($front_side && $rear_side) {
            move_uploaded_file($_FILES['front-side']['tmp_name'], "uploads/" . $front_side);
            move_uploaded_file($_FILES['rear-side']['tmp_name'], "uploads/" . $rear_side);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO seller_verification (full_name, email, phone_number, postal_code, front_side, rear_side, district, city, terms_accepted) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssssi", $full_name, $email, $phone_number, $postal_code, $front_side, $rear_side, $district, $city, $terms_accepted);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>
                alert('New record created successfully');
                window.location.href = 'home.html';
            </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
    } else {
        
        echo "<script>
                alert('Please fill all the required fields.');
                window.location.href = 'varification.html';
            </script>";
    }

    $conn->close();
}
?>
