<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Attempt to delete records from the referencing table (booking) first
    $deleteBookingQuery = "DELETE FROM booking WHERE product_id = '$id'";
    if (mysqli_query($conn, $deleteBookingQuery)) {
        // Now, delete the product from the phones table
        $deleteProductQuery = "DELETE FROM phones WHERE id = '$id'";
        if (mysqli_query($conn, $deleteProductQuery)) {
            echo '<script>alert("Product deleted successfully");</script>';
        } else {
            echo '<script>alert("Error deleting product");</script>';
        }
    } else {
        echo '<script>alert("Error deleting related records");</script>';
    }

    // Redirect back to viewproducts.php
    header("Location: viewproducts.php");
    exit();
} else {
    echo '<script>alert("Invalid request");</script>';
    header("Location: viewproducts.php");
    exit();
}

mysqli_close($conn);
?>
