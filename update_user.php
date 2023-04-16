<?php include 'crud/check-update.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veridis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    <div class = "container d-flex justify-content-center align-items-center"
    style = "min-height: 100vh"> 
    <form class = "border shadow p-3 rounded"
    action = "crud/check-update.php"
    method = "post"
    style = "width: 500px">
        <h1 class =text-center p-3> UPDATE</h1>
        <?php if(isset($_GET['error'])) {?>  
        <div class="alert alert-danger" role="alert">
            <?=$_GET['error']?>
        </div>
          <?php } ?>
          <div class="mb-3">
            <label for="name" 
            class="form-label">Name</label>
            <input type="text" 
            class="form-control" 
            id="name" name = "name"
			value = "<?=$row['name']?>">

        <div class="mb-3">
            <label for="email" 
            class="form-label">Email address</label>
            <input type="email" 
            class="form-control" 
            id="email" name = "email"
			value = "<?=$row['email']?>">

        </div>
        <div class="mb-3">
            <label for="pass" 
            class="form-label">Password</label>
            <input type="password" 
            class="form-control" 
            id="pass" name = "pass"
			value = "<?=$row['password']?>">

			<input type="text" 
		          name="id"
		          value="<?=$row['id']?>"
		          hidden >
       
        <br>
        <button type= "submit" name = "update" class="btn btn-primary">Update</button>
		
</form>
    </div>

  </body>
</html>