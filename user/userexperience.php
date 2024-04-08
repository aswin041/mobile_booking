<?php
session_start();
include '../connection.php';
include 'userbase.php';

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model = $_POST['txtmodel'];
    $date = $_POST['txtdate'];
    $feedback = $_POST['txtexp'];
    $rating = $_POST['rating'];

    // Validate input fields
    if (empty($model) || empty($date) || empty($feedback) || empty($rating)) {
        echo '<script>alert("Please fill in all fields.");</script>';
    } else {
        // Insert data into the experiences table, including user_id and rating
        $sql = "INSERT INTO experiences (userID, model, date_purchased, feedback, rating, created_at)
                VALUES ('$user_id', '$model', '$date', '$feedback', '$rating', NOW())";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Feedback shared successfully");</script>';
            echo '<script>window.location.href = "viewfeedbackusers.php";</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>

    <style>
        .rating {
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 30px;
            color: #ffc107;
            cursor: pointer;
        }

        .rating label:hover,
        .rating input:checked ~ label {
            color: #ffcc00;
        }

        .rating input:checked ~ label:hover,
        .rating input:checked ~ label ~ label {
            color: red;
        }
    </style>
</head>
<body>
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Feedback</span></h2>
    </div>
    <div class="row px-xl-5 justify-content-center">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form name="sentMessage" id="contactForm" novalidate="novalidate" method="post" onsubmit="return validateForm()">

                    <div class="control-group">
                        <input type="text" class="form-control" name="txtmodel" id="email" placeholder="Please enter phone model" required="required" data-validation-required-message="Please enter the phone model" />
                        <p class="help-block text-danger"></p>
                    </div>

                    <label style="margin-left:400px">Date of purchased</label>
                    <div class="control-group">
                        <input type="date" class="form-control" name="txtdate" id="email" required="required" data-validation-required-message="Please enter the date of purchase" max="<?php echo date('Y-m-d'); ?>" />
                        <p class="help-block text-danger"></p>
                    </div>

                    <div class="control-group">
                        <textarea class="form-control" name="txtexp" id="email" placeholder="Share your feedback" required="required" data-validation-required-message="Please enter your feedback"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>

                    <!-- Add the rating options with styles -->
                    <div class="control-group">
                        <label for="rating">Rating:</label>
                        <div class="rating">
                            <?php
                            for ($i = 5; $i >= 1; $i--) {
                                echo "<input type='radio' name='rating' value='$i' id='rating$i'>";
                                echo "<label for='rating$i'>&#9733;</label>";
                            }
                            ?>
                        </div>
                    </div>

                    <center>
                        <div>
                            <button class="btn btn-primary py-2 px-4" name="btnsubmit" type="submit" id="sendMessageButton">
                                Share
                            </button>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <!-- Your existing JS scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function validateForm() {
            var model = document.forms["sentMessage"]["txtmodel"].value;
            var date = document.forms["sentMessage"]["txtdate"].value;
            var feedback = document.forms["sentMessage"]["txtexp"].value;
            var rating = document.forms["sentMessage"]["rating"].value;

            if (model === "" || date === "" || feedback === "" || rating === "") {
                alert("Please fill in all fields.");
                return false;
            }
        }
    </script>
</body>
</html>
