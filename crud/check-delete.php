<?php  

if(isset($_GET['id'])){
   include "../config.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$id = validate($_GET['id']);

	$sql = "DELETE FROM users
	        WHERE id=$id";
   $result = mysqli_query($conn, $sql);
   if ($result) {
   	  header("Location: ../admin_page.php?success=Successfully Deleted");
   }else {
      header("Location: ../admin_page.php?error=Unknown Error&$user_data");
   }

}else {
	header("Location: ../admin_page.php");
}