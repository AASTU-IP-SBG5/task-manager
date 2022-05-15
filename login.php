<!DOCTYPE html>

<html>
    <head>
        <meta charset= "utf-8">
        <title>login page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                font-family: arial;
                background-color: #f3f3f3;
            }
            .container {
                margin: 5% 25%;
                padding: 1vw 5vw;  
                border-radius: 10%;
                width: 30%;
                background-color: #ffffff;
                color: #8585ad;
                font-size: 15px;
            }
            h2 {
                color: #000066;
            }
            .input_box {
                border-color: #eee;
                min-height: 35px;
                border-radius: 4px;
                box-shadow: none !important;
            }
            .box{
                padding: 5px;
            }
            input[type=submit] {
                width: 110px;
                height: 35px;
                margin: 0 70px;
                background: linear-gradient(to right, #202060,  #6666cc);
                border-radius: 30px;
                border: 0;
                color: #fff;
                cursor: pointer;
            }
            /* .name {
                color: cyan;
                font-weight: bold;
            } */
            /* input[type="text"], input[type="password"] {
                width: 70%;
            }
            input[type="submit"] {
                border-radius: 25px;
                color: #00008B;
            }
            .remember {
                color: white;
            }
            a {
                color: white;
                float: right;
            } */
            
            .member{
                color: #00b3b3;
                margin: 0 30vw;
            }
            .incorrect{
                color: #FF0000;
                font-size: small;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h2>Login Page</h2>

        <?php

    require 'connection.php';

    if (isset($_POST['submit'])) {
        $username=$_POST['username'];
        $password=md5($_POST['password']);
    
        $user=mysqli_query($connect, "SELECT * FROM users 
            WHERE username='$username' and password='$password'");
    
        if (mysqli_num_rows($user)>0) {
                echo "registered";
                header ("Location:../templates/projects/personal_homepage.html");
        }
        else{
            ?>
            <div class="incorrect"> Incorrect username or password. Please try again.</div>
    <?php
        }
    } 
?>

            <form method="POST" autocomplete="on" action="login.php">
                <div class = "box"> 
                    <label for="userName" class="name">Username</label>
                    <br>
                    <input type="text" id="username" class = "input_box" name="username" required/>   
                 </div>  
                <div>    
                    <label for="password" class="name">Password</label>   
                    <br>
                    <input type="password" id="password" class = "input_box" name="password" 
                    pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$" 
                    title="Please include at least one number, one uppercase and lowercase letter" required/>
                </div>
                <div class = "box">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="text" class="remember">Remember me</label> 
                </div>
                <div class = "box">
                    <input type="submit" id="submit" name="submit" value="Login Here">
<               </div>
            </form>

            </div>
            <div class="member">Don't have an account?  <a href="register.php"> Sign Up</a></div>
               
        
       
    </body>
</html>