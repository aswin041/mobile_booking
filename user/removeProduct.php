<?php
session_start();
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    $product_id = isset($_POST['productId']) ? intval($_POST['productId']) : 0;

    if ($user_id > 0 && $product_id > 0) {
        $sql = "DELETE FROM cart WHERE userID = ? AND product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "Product removed from cart successfully!";
        } else {
            echo "Error removing product from cart: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Invalid user ID or product ID.";
    }
} else {
    echo "Invalid request method.";
}
?>
