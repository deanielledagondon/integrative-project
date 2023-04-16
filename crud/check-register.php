<?php
session_start();
include "../config.php";

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type']) && isset($_POST['status'])) {

    // Define validation function - gikuha rani sa W3SCHOOLS
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validations sa Text Fields
    $name = validate($_POST['name']);
    if (empty($name)) {
        header("Location: ../register.php?error=Name is required");
        exit();
    }

    $email = validate($_POST['email']);
    if (empty($email)) {
        header("Location: ../register.php?error=Email is required");
        exit();
    }

    $pass = validate($_POST['password']);
    if (empty($password)) {
        header("Location: ../register.php?error=Password is required");
        exit();
    }

    $user_type = validate($_POST['user_type']);
    if (empty($user_type)) {
        header("Location: ../register.php?error=User type is required");
        exit();
    }

    $status = validate($_POST['status']);
    if (empty($status)) {
        header("Location: ../register.php?error=Status is required");
        exit();
    }

    // Connect to database and escape inputs
    $conn = mysqli_connect("localhost", "root", "", "shop_db");

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);
    $user_type = mysqli_real_escape_string($conn, $user_type);
    $status = mysqli_real_escape_string($conn, $status);

    // E Insert ang  data sa database / basic query
    $sql = "INSERT INTO users (name, email, password, user_type, status) VALUES ('$name','$email', '$pass', '$user_type', '$status')";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $user_id = mysqli_insert_id($conn);
        $_SESSION['id'] = $user_id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['status'] = $status;

        if($role == 'admin') {
            header("Location: ../admin_page.php");
        } else {
            header("Location: ../header.php");
        }
    } else {
        header("Location: ../login.php?error=Failed to Register User");
    }
} else {
    header("Location: ../login.php");
}

?> 