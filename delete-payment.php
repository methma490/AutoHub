<?php
session_start(); 

require 'payment-config.php'; 

// Check if the last payment ID exists in the session
if (isset($_SESSION['last_id'])) {
    $last_id = $_SESSION['last_id'];

    // SQL query to delete the payment record
    $sql = "DELETE FROM payment_details WHERE id = ?";

    $stmt = $payment->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . htmlspecialchars($payment->error));
    }

    // Bind the ID to the SQL query
    $stmt->bind_param("i", $last_id);

    // Execute the delete query
    if ($stmt->execute()) {
        // Clear the session data after deletion
        unset($_SESSION['last_id']);
        unset($_SESSION['last_amount']);

        echo 
        "<script>
        alert('Payment details deleted successfully!'); 
        window.location.href = 'payment.succesfull.php';
        </script>";
    } else {
        echo "Error deleting payment: " . htmlspecialchars($stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $payment->close();
} else {
    echo 
    "<script>
    alert('No payment found to delete.');
    window.location.href = 'payment.succesfull.php';
    </script>";
}
?>
