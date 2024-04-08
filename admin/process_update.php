<?php
include("../connection.php");

if (isset($_POST['btnUpdate'])) {
    $productId = $_POST['id'];
    $brandName = mysqli_real_escape_string($conn, $_POST['brand']);
    $productName = mysqli_real_escape_string($conn, $_POST['model']);
    $specifications = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];

    // Check if a new image is provided
    if ($_FILES["image"]["size"] > 0) {
        // Handle image upload
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        // Check if the file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            exit;
        }

        // Upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $targetFile;

            // Update product details with the new image path
            $updateSql = "UPDATE phones SET brand='$brandName', model='$productName', description='$specifications', price='$price', image='$imagePath' WHERE id=$productId";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        // Update product details without changing the image
        $updateSql = "UPDATE phones SET brand='$brandName', model='$productName', description='$specifications', price='$price' WHERE id=$productId";
    }

    // Execute the update query
    if (mysqli_query($conn, $updateSql)) {
        echo "Product details updated successfully.";
        // Redirect to the admin_products.php page or perform other actions
        header("Location: viewproducts.php");
        exit;
    } else {
        echo "Error updating product details: " . mysqli_error($conn);
        echo "Query: " . $updateSql; // Display the query for debugging
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>
