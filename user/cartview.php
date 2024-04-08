<?php
session_start();
require_once '../connection.php';
require_once 'userbase.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cart View</title>
    <!-- Add your CSS and other head elements here -->
    <link rel="stylesheet" href="path/to/your/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Shopping Cart</h2>

    <?php
    // Check if the user is logged in
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        // Fetch cart items with phone details from the database based on the user ID
        $sqlCart = "SELECT cart.product_id, phones.brand, phones.model, phones.price, phones.cover_photo
                    FROM cart
                    JOIN phones ON cart.product_id = phones.id
                    WHERE cart.userID = ?";
        $stmtCart = mysqli_prepare($conn, $sqlCart);
        mysqli_stmt_bind_param($stmtCart, "i", $user_id);
        mysqli_stmt_execute($stmtCart);
        $resultCart = mysqli_stmt_get_result($stmtCart);

        if ($resultCart && mysqli_num_rows($resultCart) > 0) {
            $totalProducts = mysqli_num_rows($resultCart);
            echo "<p>Total Products in Cart: $totalProducts</p>";

            $totalPrice = 0; // Initialize total price variable

            while ($row = mysqli_fetch_assoc($resultCart)) {
                ?>
                <!-- Displaying individual products in the cart -->
                <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?php echo $row['cover_photo']; ?>" class="card-img" alt="<?php echo $row['brand']; ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['brand'] . ' ' . $row['model']); ?></h5>
                                <p class="card-text">Price: <?php echo number_format($row['price'], 2); ?>/-</p>
                                <button class="btn btn-danger remove-product" data-product-id="<?php echo $row['product_id']; ?>">Remove from Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php

                // Accumulate the product price to calculate the total price
                $totalPrice += $row['price'];
            }

            // Display the total price of all products in the cart
            echo "<p>Total Price: " . number_format($totalPrice, 2) . "/-</p>";
        } else {
            echo "<p>Your shopping cart is empty.</p>";
        }

        mysqli_stmt_close($stmtCart);
    } else {
        echo "<p>User not logged in. Please log in to view your shopping cart.</p>";
    }
    ?>
</div>

<?php
// Display the shipping address form only if the cart is not empty
if (isset($resultCart) && mysqli_num_rows($resultCart) > 0) {
    ?>
    <div class="container mt-5">
        <h2>Shipping Address</h2>
        <form id="shippingForm" action="bookAllcart.php" method="post">
            <!-- Add your shipping address form fields here -->
            <div class="form-group">
                <label for="shippingAddress">Shipping Address:</label>
                <textarea class="form-control" id="shippingAddress" name="shippingAddress" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Shipping Address</button>
        </form>
    </div>
    <?php
}
?>

<script>
    // Add an event listener to the "Remove from Cart" buttons
    $('.remove-product').on('click', function () {
        var productIdToRemove = $(this).data('product-id');

        // Make an AJAX request to removeProduct.php to remove the product from the cart
        $.ajax({
            type: 'POST',
            url: 'removeProduct.php',
            data: {productId: productIdToRemove},
            success: function (response) {
                // Reload the page to update the cart view
                location.reload();
            },
            error: function () {
                alert('Error removing product from cart.');
            }
        });
    });
</script>

</body>
</html>
