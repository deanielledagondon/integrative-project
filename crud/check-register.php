<?php
session_start();
include "../db_conn.php";

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['role'])) {

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
        header("Location: ../register_page.php?error=Name is required");
        exit();
    }

    $email = validate($_POST['email']);
    if (empty($email)) {
        header("Location: ../register_page.php?error=Email is required");
        exit();
    }

    $pass = validate($_POST['pass']);
    if (empty($pass)) {
        header("Location: ../register_page.php?error=Password is required");
        exit();
    }

    $role = validate($_POST['role']);
    if (empty($role)) {
        header("Location: ../register_page.php?error=Role is required");
        exit();
    }

    // Connect to database and escape inputs
    $conn = mysqli_connect("localhost", "root", "", "integrative-users");

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $pass = mysqli_real_escape_string($conn, $pass);
    $role = mysqli_real_escape_string($conn, $role);

    // E Insert ang  data sa database / basic query
    $sql = "INSERT INTO users (name, email, pass, role) VALUES ('$name','$email', '$pass', '$role')";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $user_id = mysqli_insert_id($conn);
        $_SESSION['id'] = $user_id;
        $_SESSION['name'] = $role;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;

        if($role == 'admin') {
            header("Location: ../admin_page.php");
        } else {
            header("Location: ../user_page.php");
        }
    } else {
        header("Location: ../login_page.php?error=Failed to Register User");
    }
} else {
    header("Location: ../login_page.php");
}

?> 