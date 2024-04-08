<?php
include 'connection.php';
include 'commonbase.php';
if (isset($_POST['btnsubmit'])) {
    $name = $_POST['txtName'];
    $contact = $_POST['txtContact'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    $checkEmailQuery = "SELECT COUNT(*) FROM tbllogin WHERE status='1' AND username='$email'";
    $checkPhoneQuery = "SELECT COUNT(*) FROM tbllogin WHERE status='1' AND phn='$contact'";

    $emailResult = mysqli_query($conn, $checkEmailQuery);
    $emailRow = mysqli_fetch_array($emailResult);

    $phoneResult = mysqli_query($conn, $checkPhoneQuery);
    $phoneRow = mysqli_fetch_array($phoneResult);

    if ($emailRow[0] > 0) {
        echo '<script>alert("Email already exists. Cannot create account")</script>';
    } elseif ($phoneRow[0] > 0) {
        echo '<script>alert("Phone number already exists. Cannot create account")</script>';
    } else {
        $insertUserQuery = "INSERT INTO user (uName, uContact, uEmail) VALUES ('$name', '$contact', '$email')";
        $insertUserResult = mysqli_query($conn, $insertUserQuery);

        if ($insertUserResult) {
            $insertLoginQuery = "INSERT INTO tbllogin (username, password, usertype, status, phn) VALUES ('$email', '$password', 'user', '1', '$contact')";
            $insertLoginResult = mysqli_query($conn, $insertLoginQuery);

            if ($insertLoginResult) {
                echo '<script>alert("Registration successful. Login to continue")</script>';
            } else {
                echo '<script>alert("Sorry, some error occurred")</script>';
            }
        } else {
            echo '<script>alert("Sorry, some error occurred")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Simple Registration Form</title>
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Registration</span></h2>
    </div>
    <div class="row px-xl-5 justify-content-center">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="sentMessage" id="contactForm" novalidate="novalidate" onsubmit="return validatePassword();">
                    <div class="control-group">
                        <input type="text" class="form-control" name="txtName" id="name" placeholder="Please enter your name"
                            required="required" data-validation-required-message="name" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="number" class="form-control" name="txtContact" id="number" placeholder="Please enter your number"
                            required="required" data-validation-required-message="number" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" name="txtEmail" id="email" placeholder="Please enter your email"
                            required="required" data-validation-required-message="email" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="password" class="form-control" name="txtPassword" id="password" placeholder="Please enter your password"
                            required="required" data-validation-required-message="Please enter your password" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group">
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Please re-enter your password"
                            required="required" data-validation-required-message="confirmpassowrd" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <center>
                        <div>
                            <button class="btn btn-primary py-2 px-4 " name="btnsubmit" type="submit" id="sendMessageButton">
                                Register
                            </button>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

