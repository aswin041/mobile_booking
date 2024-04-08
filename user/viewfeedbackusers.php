<?php
session_start();
include '../connection.php';
include 'userbase.php';
?>
<div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">USER FEEDBACKS</span></h2>
        </div>
<style>
    .feedback-container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background-color: #f8f9fa;
        margin-top: 30px;
    }

    .feedback-card {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .feedback-date {
        font-size: 14px;
        color: #6c757d;
    }

    .rating {
        color: #ffc107;
        font-size: 20px;
    }
</style>
</head>

<body>
    <div class="container feedback-container">


        <?php
        // Retrieve feedback and user information for all users
        $sql = "SELECT experiences.*, user.uName
                FROM experiences
                JOIN user ON experiences.userID = user.userID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="card feedback-card">
                    <h5 class="card-title">Product: <?php echo $row["model"]; ?></h5>
                    <p class="feedback-date">Rating: <span class="rating"><?php echo str_repeat("&#9733;", $row["rating"]); ?></span></p>
                    <p class="feedback-date">Purchased on: <?php echo $row["date_purchased"]; ?></p>
                    <p class="card-text">Feedback: <?php echo $row["feedback"]; ?></p>
                    <p class="feedback-date">Posted on: <?php echo $row["created_at"]; ?></p>
                    <p class="feedback-date">Posted by: <?php echo $row["uName"]; ?></p>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-muted'>No feedback found.</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
