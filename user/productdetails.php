<?php
session_start();
require_once '../connection.php';
require_once 'userbase.php';


// Validate and sanitize the product ID
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
if ($product_id <= 0) {
    echo "Invalid product ID.";
    exit;
}

// Fetch product details from the database using prepared statements
$sql = "SELECT * FROM phones WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Check if there is at least one row in the result set
if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo htmlspecialchars($product['brand']); ?> Details</title>
        <!-- Add your CSS and other head elements here -->
    </head>
    <body>
        <!-- Shop Detail Start -->
        <div class="container-fluid py-5">
            <div class="row px-xl-5">
                <div class="col-lg-5 pb-5">
                    <div id="product-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner border">
                            <!-- Loop through product images -->
                            <?php
                            $imageArray = explode(",", $product['cover_photo']);
                            foreach ($imageArray as $index => $image) {
                                $activeClass = $index == 0 ? 'active' : '';
                                ?>
                                <div class="carousel-item <?php echo $activeClass; ?>">
                                    <img class="w-100 h-100" src="<?php echo htmlspecialchars($image); ?>" alt="Product Image">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 pb-5">
                    <h5 class="font-weight-semi-bold"><?php echo htmlspecialchars($product['brand']); ?></h5>
                    <h3 class="font-weight-semi-bold"><?php echo htmlspecialchars($product['model']); ?></h3>
                    <h3 class="font-weight-semi-bold mb-4"><?php echo number_format($product['price'], 2); ?>/-</h3>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                          <button id="bookNowButton" class="btn btn-primary">Book Now</button>
                        </div>
                      
                        <button id="addToCartButton" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="tab-pane-1">
                <h4 class="mb-3">Product Description</h4>
                <p class="mb-4"><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
        </div>
        <!-- Shop Detail End -->

        <!-- Add your scripts and other body elements here -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            // Add an event listener to the "Book Now" button
            document.getElementById('bookNowButton').addEventListener('click', function() {
                // Redirect to the booking page with the product ID
                window.location.href = 'productbooking.php?product_id=<?php echo $product_id; ?>';
            });

            // Add an event listener to the "Add to Cart" button
            document.getElementById('addToCartButton').addEventListener('click', function() {
                // Get the product ID and user ID
                var productId = <?php echo $product_id; ?>;
                var userId = <?php echo $user_id; ?>;

                // Make an AJAX request to addToCart.php to insert the product ID and user ID into the cart
                $.ajax({
                    type: 'POST',
                    url: 'addToCart.php',
                    data: { productId: productId, userId: userId },
                    success: function(response) {
                        // Optionally, provide feedback to the user (e.g., show a success message)
                        alert(response);
                    },
                    error: function() {
                        alert('Error adding product to cart.');
                    }
                });
            });
        </script>
    </body>
    </html>

    <?php
} else {
    // Handle the case when no data is found
    echo "Product not found.";
}
?>
