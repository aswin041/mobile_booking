
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white; /* Set the table background color to white */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .ta {
            text-decoration: none;
            color: blue;
            padding: 8px 16px;
            border: 1px solid #007BFF;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            transition: background-color 0.3s;
        }

        .ta:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <div class="data">
        <?php
        session_start();
        include '../connection.php';
        include 'adminbase.php';
        $sql = "select * from user where uEmail in (select username from tbllogin where status='1')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo '<table>
            <tr> 

                <th>ID</th>
                <th>NAME</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
               
                <th>Action</th>
            </tr>';    
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr> 
                        <td>' . $row['userID'] . '</td>
                        <td>' . $row['uName'] . '</td>
                        <td>' . $row['uContact'] . '</td>
                        <td>' . $row['uEmail'] . '</td>
                       
                        <td><a class="ta" href="deleteuser.php?id=' . $row['uEmail'] . '">Delete</td>
                      </tr>';
            }
            
            }
            echo '</table>';
        ?>
    </div>
</center>

</table>

</body>
</html>
