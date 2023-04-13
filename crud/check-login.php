<?php
session_start();
include "../db_conn.php";

if(isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['role'])) {
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    $pass = test_input($_POST['pass']);
    $role = test_input($_POST['role']);
    $email = test_input($_POST['email']);
    if(empty($email)){
        header("Location: ../login_page.php?error=Email is Required");
    } elseif(empty($pass)){
        header("Location: ../login_page.php?error=Password is Required");  
    } elseif((empty($email)) && (empty($pass))){
        header("Location: ../login_page.php?error=Failed to Input the Requirements");
    } else {
        $sql = "SELECT * FROM users WHERE email = '$email' AND pass ='$pass' AND role ='$role'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            
            if($role == 'admin') {
                header("Location: ../admin_page.php");
            } else {
                header("Location: ../user_page.php");
            }
        } else {
            header("Location: ../login_page.php?error=Incorrect Email, Password or Role");
        }
    }
} else {
    header("Location: ../login_page.php");
}
