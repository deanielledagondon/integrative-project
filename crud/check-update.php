<?php 

if(isset($_GET['id'])){
    include "config.php";
    
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }

    $id = validate($_GET['id']);
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }else{
        header("Location: admin_users.php");
    }

}elseif(isset($_POST['update'])){include "../config.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$name = validate($_POST['name']);
	$email = validate($_POST['email']);
	$id = validate($_POST['id']);

	if (empty($name)) {
		header("Location: ../check-update.php?id=$id&error=Name is required");
	}else if (empty($email)) {
		header("Location: ../check-update.php?id=$id&error=Email is required");
	}else {

       $sql = "UPDATE users
               SET name='$name', email='$email'
               WHERE id=$id ";
       $result = mysqli_query($conn, $sql);
       if ($result) {
       	  header("Location: ../admin_users.php?success=Successfully Updated");
       }else {
          header("Location: ../check-update.php?id=$id&error=Unknown Error&$user_data");
       }
	}

}
else {
    header("Location: check-update.php");
}