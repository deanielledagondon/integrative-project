<?php
include "config.php";

if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "UPDATE `users` SET `status` = 'activated' WHERE `id` = $user_id";
    mysqli_query($conn, $sql);
    header("Location: admin_users.php");
    exit();
}
?>