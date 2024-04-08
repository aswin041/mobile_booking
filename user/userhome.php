<?php
session_start();
include '../connection.php';
include 'userbase.php';

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];
    $name = $_SESSION['name'];

    // Display user information
    // echo '<hr><h1 style="margin: 10px; color: black; text-align: center; text-transform: capitalize;">Welcome ' . $name . '</h1>';
} else {
    // If not logged in, you can display a message or redirect to the login page
    echo '<hr><p style="margin: 10px; color: black; text-align: center;">Not logged in</p><hr>';
}
?>
<style>
    .we{
        margin-top: 260px;
        text-transform: capitalize;
    }
</style>

<div class="we">
      <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Welcome <?php echo $name; ?></span></h2>
    </div> 
</div>
 