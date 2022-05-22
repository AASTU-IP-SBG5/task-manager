<!DOCTYPE html>

<html lang="en">
<title>Login</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body {
        color: #999;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
    }

    .form-control {
        box-shadow: none;
        border-color: #ddd;
    }

    .form-control:focus {
        border-color: #4aba70;
    }

    .login-form {
        width: 350px;
        margin: 0 auto;
        padding: 30px 0;
    }

    .login-form form {
        color: #434343;
        border-radius: 1px;
        margin-bottom: 15px;
        background: #fff;
        border: 1px solid #f3f3f3;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }

    .login-form h4 {
        text-align: center;
        font-size: 22px;
        margin-bottom: 20px;
    }

    .login-form .avatar {
        color: #fff;
        margin: 0 auto 30px;
        text-align: center;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        z-index: 9;
        /* background: #4aba70; */
        background: #5cd3b4;

        padding: 15px;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }

    .login-form .avatar i {
        font-size: 62px;
    }

    .login-form .form-group {
        margin-bottom: 20px;
    }

    .login-form .form-control,
    .login-form .btn {
        min-height: 40px;
        border-radius: 2px;
        transition: all 0.5s;
    }

    .login-form .close {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .login-form .btn {
        background: #5cd3b4;

        border: none;
        line-height: normal;
    }

    .login-form .btn:hover,
    .login-form .btn:focus {
        background: #41cba9;

    }

    .login-form .checkbox-inline {
        float: left;
    }

    .login-form input[type="checkbox"] {
        margin-top: 2px;
    }

    .login-form .forgot-link {
        float: right;
    }

    .login-form .small {
        font-size: 13px;
    }

    .login-form a {
        color: #4aba70;
    }

    .incorrect{
        color: #FF0000;
        font-size: small;
    }
</style>

<body>
    <div class="login-form">
        <form action="" method="post">
            <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
            <h4 class="modal-title">Login to Your Account</h4>
            
        <?php

            require 'connection.php';

            if (isset($_POST['submit'])) {
                $username=$_POST['username'];
                $password=md5($_POST['password']);

                $user=mysqli_query($connect, "SELECT * FROM users 
                    WHERE username='$username' and password='$password'");

                if (mysqli_num_rows($user)>0) {
                    $active = mysqli_fetch_assoc(mysqli_query($connect, "SELECT password FROM users WHERE status = '1' AND username = '" . $username . "'"));
                    if($active){
                        echo "registered";
                        header ("Location:../templates/projects/personal_homepage.html");
                    }
                    else{
                        echo "<div class='incorrect'>Please activate your account </div>";
                    }
                }
                else{
        ?>

        <div class="incorrect"> Incorrect username or password. Please try again.</div>
        
        <?php
            }
        } 
        ?>

            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username..." class="form-control" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password..." class="form-control" required>
            </div>
            <div class="form-group small clearfix">
                <label class="checkbox-inline"><input type="checkbox"> Remember me</label>
                <a href="#" class="forgot-link">Forgot Password?</a>
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" id="submit" name="submit" value="Login">              
            <!-- <a href="templates/projects/personal_homepage.html" class="btn btn-primary btn-block btn-lg">Submit</a> -->
        </form>
        <div class="text-center small">Don't have an account? <a href="signup.php">Sign Up</a> </div>
    </div>
</body>
</html>