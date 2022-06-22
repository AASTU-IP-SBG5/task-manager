<?php

include("function.php");

?>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

   <link rel="stylesheet" href="assets/css/admin_login.css">
   <title>Admin Login</title>
</head>

<body>
   <div class="sidenav">
      <div class="login-main-text">
         <h2>Admin<br> Login Page</h2>
         <p>Login to access Admin Panel.</p>
      </div>
   </div>
   <div class="main">
      <div class="col-md-6 col-sm-12">
         <div class="login-form">
            <form method="POST" action="admin_login.php">
               <?php echo display_error(); ?>
               <div class="form-group">
                  <label>User Name</label>
                  <input type="text" class="form-control" placeholder="User Name" name="adminname">
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="adminpassword">
               </div>
               <button type="submit" class="btn btn-black" name="adminLog">Login</button>
               
               <!-- <a href="admin_login.php" class="btn btn-black" name="adminLog">Login</a> -->
            </form>
         </div>
      </div>
   </div>
</body>
</html>