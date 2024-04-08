<?php
include '../connection.php';

// Check if the form is submitted
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
        // Insert data into the database, considering cover_photo as the only image
        $sql = "INSERT INTO phones (brand, model, price, description, cover_photo) VALUES ('$brand', '$model', '$price', '$description', '$coverPhotoTarget')";

        if (mysqli_query($conn, $sql)) {
            // Display success alert
            echo '<script>alert("Data successfully added")</script>';
            // Redirect to viewproducts page
            header("Location: viewproducts.php");
            exit(); // Make sure to exit after redirecting
        } else {
            echo '<script>alert("Sorry, some error occurred while adding data")</script>';
        }
    } else {
        echo '<script>alert("Sorry, there was an error uploading your cover photo")</script>';
    }
}

// Close the database connection
mysqli_close($conn);
?>
