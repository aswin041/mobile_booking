<?php
// payment.php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnSubmit'])) {
    // Validate and sanitize form data (you may need to enhance this based on your requirements)
    $cardHolder = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $cardNumber = isset($_POST['cer']) ? intval($_POST['cer']) : 0;
    $cvv = isset($_POST['cvv']) ? intval($_POST['cvv']) : 0;

    // Assume $conn is your database connection
    require_once '../connection.php';

    // Check if the product_id parameter is set in the session (you need to set it in your booking.php page)
    session_start();
    if (!isset($_SESSION['product_id'])) {
        echo "Invalid request. Product ID is missing.";
        exit;
    }

    // Sanitize and validate the product ID
    $product_id = intval($_SESSION['product_id']);
    if ($product_id <= 0) {
        echo "Invalid product ID.";
        exit;
    }

    // Update booking status to 'confirmed' in the 'booking' table
    $updateSql = "UPDATE booking SET status = 'confirmed' WHERE id = ?";
    $updateStmt = mysqli_prepare($conn, $updateSql);
    mysqli_stmt_bind_param($updateStmt, "i", $product_id);
    $updateResult = mysqli_stmt_execute($updateStmt);

    // Check if the update was successful
    if ($updateResult) {
        echo "Payment successful! Your booking status has been updated to confirmed.";
    } else {
        echo "Payment successful, but failed to update booking status.";
    }

    // Close the database connection
    mysqli_close($conn);

    // Redirect to the bookings page
    echo '<script>window.location.href = "userviewbooking.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Other CSS FILES -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;300;400;700;900&display=swap" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/tooplate-little-fashion.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .content {
            margin-top: 50px;
            text-align: center;
        }

        h1 {
            font-size: 60px;
            color: black;
        }

        .payment-icons {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-floating {
            margin-bottom: 15px;
        }

        .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="content">
    <h1>Payment</h1>
    <form action="" method="post">
        <div class="payment-icons">
            <!-- Add your payment icons here -->
            <i class="fab fa-cc-mastercard" style="color: #2e1f51;"></i>
            <i class="fab fa-cc-visa"></i>
        </div>

        <div class="form-floating">
            <input type="text" name="name" id="Eventname" class="form-control" placeholder="Card Holder" required>
            <label for="Eventname">Card Holder</label>
        </div>

        <div class="form-floating">
            <input type="number" name="cer" pattern="[0-9]{12}" class="form-control" placeholder="Card Number" required>
            <label for="Description">Card Number</label>
        </div>

        <div class="form-floating">
            <input type="number" name="cvv" pattern="[0-9]{3}" class="form-control" placeholder="CVV" required>
            <label for="Amount">CVV</label>
        </div>

        <button type="submit" name="btnSubmit" class="btn btn-custom form-control mt-4 mb-3">
            Pay Now
        </button>
    </form>
</div>

<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/Headroom.js"></script>
<script src="js/jQuery.headroom.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/custom.js"></script>

<script>
    // Dummy form submission logic
    document.querySelector('form').addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Booking successful!');
        window.location.href = "userviewbookings.php";
    });
</script>

</body>
</html>
