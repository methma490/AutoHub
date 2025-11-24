<?php
session_start();  // Start the session

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'payment-config.php'; // connect in to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['cardName'], $_POST['cardNum'], $_POST['expmonth'], $_POST['expYear'], $_POST['cvv'], $_POST['amount'])) {

        // Assign form data to variables
        $fullName = trim($_POST['name']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $city = trim($_POST['city']);
        $state = trim($_POST['state']);
        $zip = trim($_POST['zip']);
        $cardName = trim($_POST['cardName']);
        $cardNum = trim($_POST['cardNum']);
        $expMonth = trim($_POST['expmonth']);
        $expYear = trim($_POST['expYear']);
        $cvv = trim($_POST['cvv']);
        $amount = trim($_POST['amount']);

        // SQL query to insert data into 'payment_details' table
        $sql = "INSERT INTO payment_details (Name, Email, Adrs, city, State, Zip, Cname, Cnumber, ExpM, ExpY, cvv, amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $payment->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . htmlspecialchars($payment->error));
        }

        // Bind the parameters (s = string, i = integer)
        $stmt->bind_param("sssssisisiis", $fullName, $email, $address, $city, $state, $zip, $cardName, $cardNum, $expMonth, $expYear, $cvv, $amount);

        // Execute the query
        if ($stmt->execute()) {
            // Fetch the last inserted payment record's amount using the last inserted ID
            $last_id = $stmt->insert_id;  // Get the last inserted ID
            $result = $payment->query("SELECT amount FROM payment_details WHERE id = $last_id");
            $_SESSION['last_id'] = $last_id;

            if ($result) {
                $row = $result->fetch_assoc();
                $last_amount = $row['amount'];
                
                // Store the amount in session
                $_SESSION['last_amount'] = $last_amount; 

                echo "<script>
                        window.location.href = 'payment.succesfull.php'
                    </script>" ;
            }
        } else {
            echo "Error: " . htmlspecialchars($stmt->error);
        }

        // Close the statement and connection
        $stmt->close();
        $payment->close();

    } else {
        echo "Error: Required fields are missing.";
    }
}
?>
