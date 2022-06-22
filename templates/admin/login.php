<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
      <link rel="stylesheet" href="/styles/admin/admin_login.css">
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
            <div class="login-form loginform">
               <form action = "controllers/Users.ctrl.php" method = "post">
                  <div class="form-group">
                     <input type="hidden" name="formtype" value="login">
                  </div>
                  <div class="form-group">
                     <label>User Name</label>
                     <input type="text" name="uid" placeholder="Username" class = "form-control">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name="pwd" placeholder="Password" class = "form-control">
                  </div>
                  <button class='btn btn-primary' type="submit" name="submit">Log In</button> 
               </form>
               <br/>

               <?php
                  include_once 'includes/errorhandler.inc.php'
                ?>
            </div>
         </div>
      </div>
      
   </body>
</html>
