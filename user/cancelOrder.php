<?php
// Include your database connection
require_once '../connection.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the bookingId parameter is set
    if (isset($_POST['bookingId'])) {
        $bookingId = $_POST['bookingId'];

        // Update the status in the database to "Cancelled"
        $updateSql = "UPDATE booking SET status = 'Cancelled' WHERE id = ?";
        $stmt = mysqli_prepare($conn, $updateSql);
        mysqli_stmt_bind_param($stmt, "i", $bookingId);

        // Execute the update query
        if (mysqli_stmt_execute($stmt)) {
            echo "Order cancelled successfully.";
        } else {
            echo "Error cancelling order.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid parameters.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
mysqli_close($conn);
?>
