<?php
session_start();

// Check if the product_id parameter is set in the URL
if (!isset($_GET['product_id'])) {
    echo "Invalid request. Product ID is missing.";
    exit;
}

// Sanitize and validate the product ID
$product_id = intval($_GET['product_id']);
if ($product_id <= 0) {
    echo "Invalid product ID.";
    exit;
}

// Database connection
require_once '../connection.php';
require_once 'userbase.php';

// Fetch product details from the database using prepared statements
$sql = "SELECT * FROM phones WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if there is at least one row in the result set
if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_array($result, MYSQLI_ASSOC);

    // Extract product details for booking
    $brand = $product['brand'];
    $model = $product['model'];
    $price = $product['price'];
    $coverPhoto = $product['cover_photo']; // Added line to fetch cover photo

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate and sanitize the shipping address
        $shippingAddress = isset($_POST['shipping_address']) ? htmlspecialchars(trim($_POST['shipping_address'])) : '';

        // Retrieve user_id from session (you need to adjust this based on your authentication logic)
        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];

            // Insert booking details into the 'booking' table
            $insertSql = "INSERT INTO booking (product_id, userID, brand, model, price, shipping_address, booking_date, status) VALUES (?, ?, ?, ?, ?, ?, NOW(), 'Payment successful')";
            $insertStmt = mysqli_prepare($conn, $insertSql);

            // Corrected binding parameters
            mysqli_stmt_bind_param($insertStmt, "iissds", $product_id, $user_id, $brand, $model, $price, $shippingAddress);

            $insertResult = mysqli_stmt_execute($insertStmt);

            if ($insertResult) {
                // Booking successful
                echo '<script>window.location.href = "paymentuser.php";</script>';
            } else {
                // Handle the case where the booking failed
                echo "Booking failed. Please try again.";
            }
        } else {
            // Handle the case where user_id is not set in the session
            echo "User not authenticated.";
        }
    }

} else {
    // Handle the case when no product data is found
    echo "Product not found.";
}

// Close the database connection
mysqli_close($conn);
?>
<body>

<!-- Booking Page Content -->
<div class="container mt-5">
    <h2>Booking Details</h2>
    <p>You are booking <?php echo $model; ?></p>
    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
        <!-- Display the product image fetched from the database -->
        <img class="img-fluid w-30" src="<?php echo $coverPhoto; ?>" alt="<?php echo $brand; ?>">
    </div>
    <!-- Shipping Address Form -->
    <form method="post">
        <div class="form-group">
            <input type="text" id="shipping_address" placeholder="Shipping Address" name="shipping_address" class="form-control" required>
        </div>
        <button type="submit" id="bookNowButton" class="btn btn-primary">Confirm Booking</button>
    </form>
</div>

<!-- Bootstrap JS (optional, but may be needed for some Bootstrap features) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Add your other scripts and body elements here -->

</body>
</html>
