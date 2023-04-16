<?php
session_start();
include "../config.php";

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type'])) {
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    $pass = test_input($_POST['password']);
    $user_type = test_input($_POST['user_type']);
    $email = test_input($_POST['email']);
    if(empty($email)){
        header("Location: ../login_page.php?error=Email is Required");
    } elseif(empty($password)){
        header("Location: ../login_page.php?error=Password is Required");  
    } elseif((empty($email)) && (empty($password))){
        header("Location: ../login_page.php?error=Failed to Input the Requirements");
    } else {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password ='$pass' AND role ='$user_type'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['user_type'] = $row['user_type'];
            
            if($role == 'admin') {
                header("Location: ../admin_page.php");
            } else {
                header("Location: ../header.php");
            }
        } else {
            header("Location: ../login.php?error=Incorrect Email, Password or Status Type");
        }
    }
} else {
    header("Location: ../login.php");
}
