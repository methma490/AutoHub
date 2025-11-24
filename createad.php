<?php
// Database connection
$servername = "localhost";
$username = "root"; // username
$password = ""; //password
$dbname = "autohub"; // database name

// get connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare for file upload
$targetDir = "uploads/"; 
$photoPaths = [];
$allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];

//  up to 5 photos)
for ($i = 1; $i <= 5; $i++) {
    $photoInput = "photo" . $i;

    if (!empty($_FILES[$photoInput]['name'])) {
        $fileName = basename($_FILES[$photoInput]['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        //  file type
        if (in_array(strtolower($fileType), $allowedTypes)) {
            if (move_uploaded_file($_FILES[$photoInput]['tmp_name'], $targetFilePath)) {
                $photoPaths[$photoInput] = $targetFilePath; // Store the path 
            } else {
                echo "Sorry, there was an error uploading $photoInput.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }
}

//data from the form
$fuelType = $_POST['fuel-type'];
$transmission = $_POST['transmission'];
$payment = $_POST['payment'];
$city = $_POST['city'];
$vehicleType = $_POST['vehicle-type'];
$condition = $_POST['condition'];
$brand = $_POST['brand'];
$mileage = $_POST['mileage'];
$engineCapacity = $_POST['engine-capacity'];
$description = $_POST['description'];
$price = $_POST['price'];
$negotiable = isset($_POST['negotiable']) ? 1 : 0;
$phone = $_POST['phone'];
$email = $_POST['email'];

// Insert the data into the database
$sql = "INSERT INTO vehicle_ads (fuel_type, transmission, payment_id, city, vehicle_type, vehicle_condition, brand, mileage, engine_capacity, description, price, negotiable, phone, email, photo1, photo2, photo3, photo4, photo5)
VALUES ('$fuelType', '$transmission', '$payment', '$city', '$vehicleType', '$condition', '$brand', '$mileage', '$engineCapacity', '$description', '$price', '$negotiable', '$phone', '$email', 
'{$photoPaths['photo1']}', '{$photoPaths['photo2']}', '{$photoPaths['photo3']}', '{$photoPaths['photo4']}', '{$photoPaths['photo5']}')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
                alert('make pyment and psot ad');
                window.location.href = 'payment.html';
            </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
