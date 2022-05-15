<!DOCTYPE html>
<html>
    <head>
   
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
        <script src="jquery-3.6.0.min.js"></script>
       <style>
            body {
                font-family: arial;
                background-color: #f3f3f3;
            }

            .container {
                margin: 2% 25%;
                padding: 1vw 5vw;  
                border-radius: 10%;
                width: 30%;
                background-color: #ffffff;
                color: #8585ad;
                font-size: 14px;
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

            div[class$="Error"] {
                color: #FF0000;
                font-size: small;
            }
            .error {
                color: #FF0000;
                font-size: small;
            }
            .userExist {
                color: #FF0000;
                font-size: small;
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
            #submit[disabled]
            {
                background: linear-gradient(to right, #262673, #e0e0eb);
            }

            .already{
                color: #00b3b3;
                margin: 0 35vw;
            }

        </style>

    </head>
    <body>
     <?php
   
     $firstNameErr = $fatherNameErr = $emailErr = $usernameErr = $pwd1Err = $pwd2Err = " ";
          $firstName = $fatherName = $email = $username = $pwd1 = $pwd2 = " ";
         
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if (empty($_POST["firstName"])) {
                  $firstNameErr = "First name is required"; 
              }
              else {
                  $firstName = input_test($_POST["firstName"]);
                  if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
                      $firstNameErr = "Only letters allowed"; 
                    }
              }
         
              if (empty($_POST["fatherName"])) {
                  $fatherNameErr = "Father name is required"; 
              }
              else {
                  $fatherName = input_test($_POST["fatherName"]);
                  if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
                      $firstNameErr = "Only letters allowed"; 
                    }
              }
         
              if (empty($_POST["email"])) {
                  $emailErr = "Email is required"; 
              }
              else {
                  $email = input_test($_POST["email"]);
                  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $emailErr = "Invalid email format"; 
                    }
              }
         
              if (empty($_POST["username"])) {
                  $usernameErr = "Username is required"; 
              }
              else {
                  $username = input_test($_POST["username"]);
              }
         
              if (empty($_POST["pwd1"])) {
                  $pwd1Err = "Password is required"; 
              }
              else {
                  $pwd1 = input_test($_POST["pwd1"]);
                  if (!preg_match("#.*^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $pwd1))
                      $pwd1Err = "Password should be atleast 8 characters in length and should include at least one number, one uppercase and lowercase letter"; 
         
              }
         
              if (empty($_POST["pwd2"])) {
                  $pwd2Err = "Confirm your password"; 
              }
              else {
                  $pwd2 = input_test($_POST["pwd2"]);
                  if($pwd1!==$pwd2)
                      $pwd2Err = "Passwords do not match"; 
              }
             }

             function input_test($input) {
                $input = trim($input);
                $input = stripslashes($input);
                $input = htmlspecialchars($input);
                return $input;
              }

                if(($firstNameErr == " ") && ($fatherNameErr ==" ") && ($emailErr == " ") && ($usernameErr == " ") && ($pwd1Err == " ") && ($pwd2Err == " "))
                {
                    require 'connection.php';
                    if (isset($_POST['submit'])) {
                    $pwd1 = md5($pwd1);

                    $register = "INSERT INTO users (firstName, fatherName, email, username, password) VALUES ('$firstName', '$fatherName', '$email', '$username','$pwd1')";
                    $query_result = mysqli_query($connect, $register);
                    if($query_result) {
                        header ("Location:login.php");
                    }
                    else
                    {
                        echo "not inserted".mysqli_error($connect);
                    }
                }
                
                }
              
      ?>
       <div class="container">
        <h2>Sign up</h2>
        <form name="register" id="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
            <div class = "box">
                <div class="firstNameError"><?php echo $firstNameErr; ?> </div>
                <div class="error"> </div>
               <label for="firstName"> First Name: </label>
               <br>
               <input type="text" name="firstName" id="firstName" class = "input_box">  
            </div>

            <div class = "box">
                <div class="lastNameError"> <?php echo $fatherNameErr; ?> </div>
                <div class="error"></div>
                <label for="fatherName"> Father Name:</label> 
                <br>
                <input type="text" name="fatherName" id="fatherName" class = "input_box">
            </div>

            <div class = "box">
                <div class="emailError"> <?php echo $emailErr; ?> </div>
                <div class="error"></div>
                <div id="emailExist"></div>
                <label for="email">Email: </label>
                <br>
                <input type="text" name="email" id="email" class = "input_box" onInput="checkEmail()">
            </div>
            
            <div class = "box">
                <div class="userNameError"> <?php echo $usernameErr; ?> </div>
                <div class="error"></div>
                <div id="userExist"></div>
                <label for="username">Username:</label>
                <br>
                <input type="text" name="username" id="username" class = "input_box" onInput="checkUsername()">
            </div>

            <div class = "box">
                <div class="pwd1Error"> <?php echo $pwd1Err; ?> </div>
                <div class="error"></div>
                <label for="pwd1">Password:</label>
                <br>
                <input type="password" name="pwd1" id="pwd1" class = "input_box">
            </div>
            <div class = "box">
                <div class="pwd2Error"> <?php echo $pwd2Err; ?> </div>
                <div class="error"></div>
                <label for="pwd2">Confirm Password:</label>
                <br>
                <input type="password" name="pwd2" id="pwd2" class = "input_box">
            </div>
            <div class="box">
                <input type="submit" id="submit" name="submit" value="Sign Up">
            </div>
        </form>  
    
    </div>
    <div class = "already">Already have an account? <a href="login.php">Login</a></div>

    <script>
        const validName = /^[a-zA-Z ]*$/;
        // const validEmail = /^w+([.-]?w+)*@w+([.-]?w+)*(.w{2,3})+$/;
        // const validEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        const validEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        const validPwd = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
        let id = (id) => document.getElementById(id);
        let classes = (classes) => document.getElementsByClassName(classes);
        
        let firstName = id("firstName"), 
            fatherName = id("fatherName"),
            email = id("email"),
            username = id("username"),
            pwd1 = id("pwd1"),
            pwd2 = id("pwd2"),
            register = id("register"),
            errorMsg = classes("error");

        register.addEventListener('submit', (e) => {
            // e.preventDefault();

            validation(firstName, 0, "First name is required");
            validation(fatherName, 1, "Father name is required");
            validation(email, 2, "Email is required");
            validation(username, 3, "Username is required");
            validation(pwd1, 4, "Password is required");
            validation(pwd2, 5, "Confirm your password");

            if(!validName.test(firstName.value)){
                e.preventDefault();
                errorMsg[0].innerHTML="Only letters allowed";
            }
            if(!validName.test(fatherName.value)) {
                e.preventDefault();
                errorMsg[1].innerHTML="Only letters allowed";
            }
            if(!validEmail.test(email.value)) {
                e.preventDefault();
                errorMsg[2].innerHTML="Input valid email";
            }
            if(!validPwd.test(pwd1.value)) {
                e.preventDefault();
                errorMsg[4].innerHTML="Password should be atleast 8 characters in length and should include at least one number, one uppercase and lowercase letter";
            }
            if(pwd1.value!=pwd2.value) {
                e.preventDefault();
                errorMsg[5].innerHTML="Passwords do not match";
            }

        });

        let validation = (id, serial, msg) => {
            if (id.value.trim() === "") {
                errorMsg[serial].innerHTML = msg;
            }
            else {
                errorMsg[serial].innerHTML = "";
            }
        }
    </script>

    <script>
        function checkUsername()
        {
            jQuery.ajax({
                url: 'check.php',
                data: 'username='+$('#username').val(),
                type: 'POST',
                success: function(data){
                    $('#userExist').html(data);
                },
                error: function(){} 
            });
        }

        function checkEmail()
        {
            jQuery.ajax({
                url: 'check.php',
                data: 'email='+$('#email').val(),
                type: 'POST',
                success: function(data){
                    $('#emailExist').html(data);
                },
                error: function(){} 
            });
        }

    </script>

    

</body>

</html>