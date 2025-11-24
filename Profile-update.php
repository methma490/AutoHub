<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "autohub";

// Create connection
$pro = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($pro->connect_error) {
    die("Connection failed: " . $pro->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $nationalid = $_POST['nationalid'] ?? '';
    $addressline1 = $_POST['addressline1'] ?? '';
    $addressline2 = $_POST['addressline2'] ?? '';
    $city = $_POST['city'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $postalcode = $_POST['postalcode'] ?? '';

    // Prepared statement to update the record
    $stmt = $pro->prepare("UPDATE profile_details SET name=?, email=?, nationalid=?, addressline1=?, addressline2=?, city=?, phone=?, postalcode=? WHERE email=?");
    $stmt->bind_param("sssssssss", $name, $email, $nationalid, $addressline1, $addressline2, $city, $phone, $postalcode, $email);

    if ($stmt->execute()) {
        echo"<script>
                alert('Record updated successfully');
                window.location.href = 'Profile.html';
            </script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $pro->close();
}
?>
