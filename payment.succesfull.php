<?php
session_start();  // Start the session

// Fetch the payment amount from the session
if (isset($_SESSION['last_amount'])) {
    $last_amount = $_SESSION['last_amount'];
    unset($_SESSION['last_amount']);  // Clear session after using it
} else {
    $last_amount = "Unknown";  // If no payment amount is found
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> AutoHub - Vehicles in Srilanka</title>
        <link rel="icon" href="Images/Title logo.png" sizes="32x32" type="image/png"> <!-- Standard favicon for web browsers -->
        <link rel="stylesheet" href="CSS/payment.css">
        <script src="JS/payment.js"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    </head>
    <body>
        
        <!--------------------------------------------navigation bar start--------------------------------------------------->
        <div class="nvbar">
        <a href="Home.html"> <img class="Hlogo" src="Images/websitelogo.png" alt="webpage logo"> </a>
        <ul id="nvgbar">
            <li class="nvglist"> <a href="Home.html"> Home </a> </li>
            <li class="nvglist"> <a class="active" href="#"> Ads </a> </li>
            <li class="nvglist"> <a href="Support.html"> Support </a> </li>
            <li class="nvglist"> <a href="AboutUS.html"> About us </a> </li>
            <li class="nvglist"> <a href="Contact.html"> Contact us </a> </li>
            <li class="nvglist"> <a href="login.php"> Login </a> </li>
        </ul>
        <a href="Profile.html"> <img class="Flogo" src="Images/profile logo.png" alt="profile logo"> </a>
        </div>
        <!--------------------------------------------navigation bar End--------------------------------------------------->

        <!------------------------------ Payment Successful Section ------------------------------------->        
        <div class="content" id="invoice">
            <div class="payment-success-box">
                <div class="icon">
                    <img src="Images/U-done1.webp" alt="Success Icon">
                </div>
                <h1>Payment Successful</h1>
                <p>Your payment for posting your ad has been successfully processed!</p>
                
                <div class="transaction-details">
                    <h3>Transaction Details</h3>
                    <pre>
                        Amount             : $<?php echo $last_amount; ?> 
                        Transaction Number : 76641478925
                        Payment Method     : VISA Card
                        Date & Time        : <?php echo date('d M Y, H:i'); ?>
                    </pre>
                </div>
                <script>
                    function deletePayment() {
                        if (confirm("Are you sure you want to delete this payment?")) {
                            window.location.href = "delete-payment.php";  
                        }
                    }
                </script>

                <div class="buttons_PS">
                    <button class="done-btn" onclick="done_btn()">Done</button>
                    <button class="download-btn" onclick="download_btn()">Download Receipt</button>
                    <button class="done-btn" onclick="deletePayment()">Delete Payment</button>
                </div>
            </div>
        </div>

        <!--------------------------------------------footer section start--------------------------------------------------->
        <section class="footer"> 

            <div class="box-container">

                <<div class="box">
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
            <!--------------------------------------------footer section End--------------------------------------------------->

    </body>
</html>