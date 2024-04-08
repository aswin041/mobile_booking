<?php
session_start();
require_once '../connection.php';

$product_id = isset($_POST['productId']) ? intval($_POST['productId']) : 0;
$user_id = isset($_POST['userId']) ? intval($_POST['userId']) : 0;

if ($product_id <= 0 || $user_id <= 0) {
    echo "Invalid product ID or user ID.";
    exit;
}

// Insert the product ID into the cart table
$sql = "INSERT INTO cart (userID, product_id) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "ii", $user_id, $product_id);  // "ii" stands for two integers

if (mysqli_stmt_execute($stmt)) {
    echo "Product added to cart successfully!";
} else {
    echo "Error adding product to cart: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
