<?php
session_start();
include '../connection.php';
include 'userbase.php';

// Fetch data from the 'phones' table
$sql = "SELECT * FROM phones"; // Remove the LIMIT clause
$result = mysqli_query($conn, $sql);

// Check if there is at least one row in the result set
if ($result && mysqli_num_rows($result) > 0) {
?>

<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Mobiles</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <!-- Update the image source based on the database -->
                    <img class="img-fluid w-100" src="<?php echo $row['cover_photo']; ?>" alt="<?php echo $row['brand']; ?>">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <!-- Display brand and other details based on the database -->
                    <h6 class="text-truncate mb-3"><?php echo $row['brand']; ?></h6>
                    <h6 class="text-truncate mb-3"><?php echo $row['model']; ?></h6>
                    <div class="d-flex justify-content-center">
                        <!-- Display price and discount based on the database -->
                        <h6><?php echo $row['price']; ?>/-</h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center bg-light border ">
                    <a href="productdetails.php?product_id=<?php echo $row['id']; ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                    <!-- <a href="addToCart.php" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> -->
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
} else {
    // Handle the case when no data is found
    echo "No mobiles found in the database.";
}
?>
