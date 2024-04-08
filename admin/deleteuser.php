<?php
include '../connection.php';
$id=$_REQUEST['id'];

$qr="update tbllogin set status='0' where username='$id'";

$r=mysqli_query($conn,$qr);

if($r){

    echo "<script>alert('Deleted Successfully')</script>";
    echo "<script>location.href='viewusers.php'</script>";

}else{

    
    echo "<script>alert('Sorry')</script>";
    echo "<script>location.href='viewusers.php'</script>";


}


?>