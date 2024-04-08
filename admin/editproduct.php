<?php
include '../connection.php';
include 'adminbase.php';

// Check if the product ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid product ID.";
    exit;
}

// Retrieve the product details from the database
$product_id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "SELECT * FROM phones WHERE id = '$product_id'";
$result = mysqli_query($conn, $sql);

// Check if the product exists
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Product not found.";
    exit;
}

// Fetch product details
$product = mysqli_fetch_assoc($result);

// Handle form submission for updating product details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model = mysqli_real_escape_string($conn, $_POST['model']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // File upload handling for cover photo
    $targetDirectory = "../uploads/";  // Change this to your desired directory
    $coverPhotoTarget = $targetDirectory . basename($_FILES["coverPhoto"]["name"]);

    // Upload cover photo
    if (move_uploaded_file($_FILES["coverPhoto"]["tmp_name"], $coverPhotoTarget)) {
        // Update the product details in the database, including cover_photo
        $update_sql = "UPDATE phones SET brand='$brand', model='$model', price='$price', description='$description', cover_photo='$coverPhotoTarget' WHERE id='$product_id'";

        if (mysqli_query($conn, $update_sql)) {
            echo '<script>alert("Product details updated successfully")</script>';
            // Redirect to the viewproducts page
            echo '<script>window.location.href = "viewproducts.php";</script>';
            exit();
        } else {
            echo '<script>alert("Error updating product details")</script>';
        }
    } else {
        echo '<script>alert("Sorry, there was an error uploading your cover photo")</script>';
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Product</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Product</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $product['brand']; ?>" required>
            </div>
            <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" id="model" name="model" value="<?php echo $product['model']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="coverPhoto">Cover Photo:</label>
                <input type="file" class="form-control-file" id="coverPhoto" name="coverPhoto">
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
