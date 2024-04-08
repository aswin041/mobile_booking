<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in, you might have your own authentication logic
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Include your database connection and any necessary files
require_once '../connection.php';
require_once 'userbase.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Bookings</title>

    <!-- Add your CSS and other head elements here -->
    <link rel="stylesheet" href="path/to/your/custom.css">
    <style>
        /* Add any additional CSS styling here */
        table {
            width: 100%;
            height: auto;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .cancel-btn {
            background-color: #dc3545;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Page content -->
<div class="container mt-5">
    <h2>Your Bookings</h2>

    <!-- Display user bookings in a table -->
    <table>
        <thead>
        <tr>
            <th>Booking ID</th>
            <th>Product</th>
            <th>Image</th>
            <th>Price</th>
            <th>Status</th>
            <!-- <th>Delivery Status</th> -->
            <th>Booked On</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Fetch user bookings from the database
        $user_id = $_SESSION['id'];
        $sql = "SELECT booking.*, phones.cover_photo FROM booking 
                INNER JOIN phones ON booking.product_id = phones.id
                WHERE userID = ? ORDER BY booking_date DESC";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if there are bookings
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['brand']} {$row['model']}</td>";
                echo "<td><img src='{$row['cover_photo']}' alt='{$row['brand']}' style='width: 150px; height: 150px;'></td>";
                echo "<td>{$row['price']}</td>";
                echo "<td>{$row['status']}</td>";
                // echo "<td>Arriving</td>";
                echo "<td>{$row['booking_date']}</td>";

                $cancelLink = 'cancel_booking.php?b_id=' . $row['id'];
                $buttonClass = $row['status'] === 'Cancelled' ? 'disabled' : '';
                
                echo "<td><a href='{$cancelLink}' class='cancel-btn {$buttonClass}'>Cancel</a></td>";

                echo "</tr>";
            }
        } else {
            // No bookings found
            echo "<tr><td colspan='8'>No bookings found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Add your scripts and other body elements here -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
<?php
// Close the database connection
mysqli_close($conn);
?>
