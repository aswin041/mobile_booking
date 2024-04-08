<?php
session_start();
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    $shipping_address = isset($_POST['shippingAddress']) ? $_POST['shippingAddress'] : '';

    if ($user_id > 0 && !empty($shipping_address)) {
        // Fetch cart items with phone details from the database based on the user ID
        $sqlCart = "SELECT cart.product_id, phones.brand, phones.model, phones.price
                    FROM cart
                    JOIN phones ON cart.product_id = phones.id
                    WHERE cart.userID = ?";
        $stmtCart = mysqli_prepare($conn, $sqlCart);
        mysqli_stmt_bind_param($stmtCart, "i", $user_id);
        mysqli_stmt_execute($stmtCart);
        $resultCart = mysqli_stmt_get_result($stmtCart);

        // Prepare the INSERT statement for the booking table
        $sqlInsertBooking = "INSERT INTO booking (product_id, userID, model, brand, price, shipping_address, status)
                             VALUES (?, ?, ?, ?, ?, ?, 'Payment Successful')";
        $stmtInsertBooking = mysqli_prepare($conn, $sqlInsertBooking);
        mysqli_stmt_bind_param($stmtInsertBooking, "iissis", $product_id, $user_id, $model, $brand, $price, $shipping_address);

        if ($resultCart) {
            while ($rowCart = mysqli_fetch_assoc($resultCart)) {
                $product_id = $rowCart['product_id'];
                $model = $rowCart['model'];
                $brand = $rowCart['brand'];
                $price = $rowCart['price'];

                // Execute the INSERT statement for each product in the cart
                mysqli_stmt_execute($stmtInsertBooking);
            }

            // Clear the user's cart after booking
            $sqlClearCart = "DELETE FROM cart WHERE userID = ?";
            $stmtClearCart = mysqli_prepare($conn, $sqlClearCart);
            mysqli_stmt_bind_param($stmtClearCart, "i", $user_id);
            mysqli_stmt_execute($stmtClearCart);
            mysqli_stmt_close($stmtClearCart);
            
            echo '<script>window.location.href = "paymentuser.php";</script>';
        } else {
            echo "Error fetching cart items: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmtCart);
        mysqli_stmt_close($stmtInsertBooking);
    } else {
        echo "Invalid user ID or shipping address.";
    }
} else {
    echo "Invalid request method.";
}
?>
