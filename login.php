<?php
session_start();
include 'connection.php';
include 'commonbase.php';
if(isset($_POST['btnsubmit'])){
    $email=$_POST['txtemail'];
    $pwd=$_POST['txtpassword'];
    $sql="select count(*) from tbllogin where username='$email'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    if($row[0]==0){
        echo '<script>alert("Email not registered")</script>';
    }
    else{
        $sql="select * from tbllogin where username='$email'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        if($row['password']==$pwd){
            if($row['status']=='1'){
                if($row['usertype']=='admin'){
                    echo '<script>location.href="admin/adminhome.php"</script>';
                }
                else if($row['usertype']=='user'){
                    $sql1="select * from user where uEmail='$email'";
                    $result1=mysqli_query($conn,$sql1);
                    $row1=mysqli_fetch_array($result1);
                    $_SESSION['id']=$row1[0];
                    $_SESSION['name']=$row1[1];
                    echo '<script>location.href="user/userhome.php"</script>';
                }
            }
            else{
                echo '<script>alert("Account inactive")</script>';
            }
        }
        else{
            echo '<script>alert("Incorrect password")</script>';
        }
    }
}
?>
<body>
<div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">LOGIN</span></h2>
        </div>
    <div class="row px-xl-5 justify-content-center">
            <div class="col-lg-7 mb-5 ">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate" method="post">
                        
                        <div class="control-group">
                            <input type="email" class="form-control" name="txtemail" id="email" placeholder="Please enter your email"
                                required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" name="txtpassword" id="password" placeholder="Please enter your password"
                                required="required" data-validation-required-message="Please enter your password" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <center>
                        <div>
                            <button class="btn btn-primary py-2 px-4 " name="btnsubmit" type="submit" id="sendMessageButton">
                                Login</button>
                        </div>
                       </center>
                    </form>
                </div>
            </div>
    </div>


</body>

</html>
