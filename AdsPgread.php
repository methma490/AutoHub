<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autohub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM vehicle_ads ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vehicle Ads</title>
    <link rel="stylesheet" href="CSS/AdsReadStyle.css">
</head>
<body> 
        <div class="nvbar">
        <a href="Home.html"> <img class="Hlogo" src="Images/websitelogo.png" alt="webpage logo"> </a> <!-- Logo linked to the home page -->
        <ul id="nvgbar">
            <li class="nvglist"> <a class="active" href="#"> Home </a> </li>
            <li class="nvglist"> <a href="AdsPg.html"> Ads </a> </li>
            <li class="nvglist"> <a href="Support.html"> Support </a> </li>
            <li class="nvglist"> <a href="AboutUS.html"> About us </a> </li>
            <li class="nvglist"> <a href="Contact.html"> Contact us </a> </li>
            <li class="nvglist"> <a href="login.html"> Login </a> </li>
        </ul>
        <a href="Profile.html"> <img class="Flogo" src="Images/profile logo.png" alt="profile logo"> </a>
        </div>
        <!--End of navigation bar-->
        
       
    <section class="ads-list">
        <h2>Available Ads</h2>
        
        
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='ad'>";
                echo "<h3>" . $row['brand'] . " (" . $row['vehicle_condition'] . ")</h3>";
                echo "<p><strong>Price:</strong> " . $row['price'] . " Rs</p>";
                echo "<p><strong>City:</strong> " . $row['city'] . "</p>";
                echo "<p><strong>Fuel Type:</strong> " . $row['fuel_type'] . "</p>";
                echo "<p><strong>Mileage:</strong> " . $row['mileage'] . " km</p>";
                echo "<p><strong>Engine Capacity:</strong> " . $row['engine_capacity'] . " cc</p>";
                echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
                
                // Display photos
                for ($i = 1; $i <= 5; $i++) {
                    $photoColumn = 'photo' . $i;
                    if (!empty($row[$photoColumn])) {
                        echo "<img src='" . $row[$photoColumn] . "' alt='Ad Photo' class='ad-photo'>";
                    }
                }

                echo "<p><strong>Contact:</strong> " . $row['phone'] . ", " . $row['email'] . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No ads available at the moment. Please post a new ad!</p>";
        }
        ?>
    </section>

    <!--footer section start-->
    <section class="footer"> 

<div class="box-container">

    <div class="box">
        <h3>About us</h3>
        <a href="AboutUS.html">About us</a>
        <a href="AboutUS.html">Our community</a>

    </div>
    <div class="box">
        <h3>Support</h3>
        <a href="Contact.html">24 hours contact center</a>
        <a href="Support.html">FAQs</a>
    </div>
    <div class="box">
        <h3>Terms and Conditions</h3>
        <a href="terms&condition.html">General</a>
        <a href="terms&condition.html">Copyright</a>
    </div>
    <div class="follow-us-container">
        <h3>Follow Us</h3> <br>
        <a href="#"><img src="Images/facebook icon.png" alt="Facebook" id="social-links"></a>
        <a href="#"><img src="Images/twitter icon.png" alt="Twitter" id="social-links"></a>
        <a href="#"><img src="Images/instragram icon.png" alt="Instagram" id="social-links"></a>
    </div>
</div>
<h1 class="credit"><span>@ 2022 All Rights Reseverd </span></h1>
</section>

</body>
</html>

<?php
$conn->close();
?>
