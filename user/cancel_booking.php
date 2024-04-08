<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../connection.php");

if (isset($_GET['b_id'])) {
    $bookingId = $_GET['b_id'];

    // Check if the booking belongs to the logged-in user (optional but recommended)
    session_start();
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];

        // Use prepared statements to prevent SQL injection
        $checkBookingSql = "SELECT * FROM booking WHERE id = ? AND userID = ?";
        $stmt = mysqli_prepare($conn, $checkBookingSql);
        mysqli_stmt_bind_param($stmt, "ii", $bookingId, $userId);
        mysqli_stmt_execute($stmt);
        $checkBookingResult = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($checkBookingResult) > 0) {
            // Booking belongs to the logged-in user; proceed with cancellation
            $updateSql = "UPDATE booking SET status = 'Cancelled' WHERE id = ?";
            $stmt = mysqli_prepare($conn, $updateSql);
            mysqli_stmt_bind_param($stmt, "i", $bookingId);
            $updateResult = mysqli_stmt_execute($stmt);

            if ($updateResult) {
                // Alert message and redirect to the View Bookings page
                echo "<script>alert('Order Cancelled Successfully');</script>";
                echo "<script>window.location.href = 'userviewbookings.php';</script>";
                exit;
            } else {
                echo "<h2>Error</h2>";
                echo "<p>Error cancelling booking: " . mysqli_error($conn) . "</p>";
            }
        } else {
            echo "<h2>Error</h2>";
            echo "<p>You are not authorized to cancel this booking.</p>";
        }
    } else {
        echo "<h2>Error</h2>";
        echo "<p>User not logged in.</p>";
    }
} else {
    echo "<h2>Error</h2>";
    echo "<p>Booking ID not provided.</p>";
}
?>
