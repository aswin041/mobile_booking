<?php
include '../connection.php';
include 'adminbase.php';

// Fetch products from the database
$sql = "SELECT * FROM phones";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>View Products</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">View Products</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Cover Photo</th>
                    <th colspan="4" >Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['brand']}</td>";
                    echo "<td>{$row['model']}</td>";
                    echo "<td>{$row['price']}</td>";
                    echo "<td>{$row['description']}</td>";
                    echo "<td><img src='{$row['cover_photo']}' alt='Cover Photo' style='max-width: 100px;'></td>";
                    echo "<td>
                            <a href='editproduct.php?id={$row['id']}' class='btn btn-primary'>Edit</a>
                          </td>";
                    echo "<td>
                            <a href='deleteproduct.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
