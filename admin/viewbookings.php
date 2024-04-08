<?php
require_once '../connection.php';
require_once 'adminbase.php';

$sql = "SELECT b.id, b.product_id, b.userID, b.booking_date, b.status, p.model, p.cover_photo, u.uName,b.shipping_address
        FROM booking b
        JOIN phones p ON b.product_id = p.id
        JOIN user u ON b.userID = u.userID
        ORDER BY b.booking_date DESC";  // You may adjust the ORDER BY clause as needed

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin View User Bookings</title>

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

        .image-cell img {
            width: 150px;
            height: 150px;
        }
    </style>
</head>

<body>

    <!-- Page content -->
    <div class="container mt-5">
        <h2>Admin View User Bookings</h2>

        <!-- Display user bookings in a table -->
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Shipping Address</th>
                    <th>Image</th>
                    <th>Booking Status</th>
                    <th>Booked On</th>
                    <!-- <th>Delivery Status</th> -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['uName']}</td>";
                    echo "<td>{$row['model']}</td>";
                    echo "<td>{$row['shipping_address']}</td>";
                    echo "<td class='image-cell'><img src='{$row['cover_photo']}' alt='{$row['model']}'></td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>{$row['booking_date']}</td>";
                    // echo "<td>Item dispatched</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add your scripts and other body elements here -->

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
