<!DOCTYPE html>

<html lang="en">

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="jquery-3.6.0.min.js"></script>

    <style>
        body {
            color: #999;
            background: #f3f3f3;
            font-family: 'Roboto', sans-serif;
        }

        .form-control {
            border-color: #eee;
            min-height: 41px;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: #5cd3b4;
        }

        .form-control,
        .btn {
            border-radius: 3px;
        }

        .signup-form {
            width: 500px;
            margin: 0 auto;
            padding: 30px 0;
        }

        .signup-form h2 {
            color: #333;
            margin: 0 0 30px 0;
            display: inline-block;
            padding: 0 30px 10px 0;
            border-bottom: 3px solid #5cd3b4;
        }

        .signup-form form {
            color: #999;
            border-radius: 3px;
            margin-bottom: 15px;
            background: #fff;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
        }

        .signup-form label {
            font-weight: normal;
            font-size: 13px;
        }

        .signup-form input[type="checkbox"] {
            margin-top: 2px;
        }

        .signup-form .btn {
            font-size: 16px;
            font-weight: bold;
            background: #5cd3b4;
            border: none;
            margin-top: 20px;
            min-width: 140px;
        }

        .signup-form .btn:hover,
        .signup-form .btn:focus {
            background: #41cba9;
            outline: none !important;
        }

        .signup-form a {
            color: #5cd3b4;
            text-decoration: underline;
        }

        .signup-form a:hover {
            text-decoration: none;
        }

        .signup-form form a {
            color: #5cd3b4;
            text-decoration: none;
        }

        .signup-form form a:hover {
            text-decoration: underline;
        }
        .error {
            color: #FF0000;
            font-size: small;
            }
        div[class$="Error"] {
            color: #FF0000;
            font-size: small;
            }
        #userExist {
            color: #FF0000;
            font-size: small;
            }

        #emailExist {
            color: #FF0000;
            font-size: small;
            }

    </style>
</head>

<body>

    <?php

    
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
   
        $emailErr = $usernameErr = $pwd1Err = $pwd2Err = " ";
        $email = $username = $pwd1 = $pwd2 = " ";
        $hash=md5( rand(0, 1000));

         if ($_SERVER["REQUEST_METHOD"] == "POST") {
             
            $email = input_test($_POST["email"]);
             if (empty($email)) {
                 $emailErr = "Email is required"; 
             }
             else {
                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                     $emailErr = "Invalid email format"; 
                   }
             }

             $username = input_test($_POST["username"]);
             if (empty($username)) {
                 $usernameErr = "Username is required"; 
             }
            
             $pwd1 = input_test($_POST["pwd1"]);
             if (empty($pwd1)) {
                 $pwd1Err = "Password is required"; 
             }
             else {
                 if (!preg_match("#.*^(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $pwd1))
                     $pwd1Err = "Password should be atleast 8 characters in length and should include at least one number, one uppercase and lowercase letter"; 
        
             }
        
             $pwd2 = input_test($_POST["pwd2"]);
             if (empty($pwd2)) {
                 $pwd2Err = "Confirm your password"; 
             }
             else {
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

               if(($emailErr == " ") && ($usernameErr == " ") && ($pwd1Err == " ") && ($pwd2Err == " "))
               {
                require 'connection.php';

                require 'PHPMailerAutoload.php';

                require 'PHPMailer.php';
                require 'SMTP.php';
                require 'Exception.php';

                
               
            //    define("sendmail_from","kidistsamuel21@gmail.com");
               function sendmailx($from,$to,$subj,$msg,$att)
               {
               $mail = new PHPMailer;
               //Tell PHPMailer to use SMTP
               $mail->isSMTP();
               //Enable SMTP debugging
               // 0 = off (for production use)
               // 1 = client messages
               // 2 = client and server messages
            //    $mail->SMTPDebug = 0;
               //Ask for HTML-friendly debug output
               $mail->Debugoutput = 'html';
               //Set the hostname of the mail server
               $mail->Host = "smtp.gmail.com";
              $mail->SMTPSecure = 'tls';
               //Set the SMTP port number - likely to be 25, 465 or 587
               $mail->Port = 587;
               //Whether to use SMTP authentication
               $mail->SMTPAuth = true;
               //Username to use for SMTP authentication
               $mail->Username = "kidistsamuel21@gmail.com";
               //Password to use for SMTP authentication
               $mail->Password = '21292129';
               //Set who the message is to be sent from
               $mail->setFrom($from, 'TASK MANAGER');
               //Set an alternative reply-to address
               $mail->addReplyTo($from, 'TASK MANAGER');
               //Set who the message is to be sent to
               $mail->addAddress($to, '');
               //Set the subject line
               $mail->Subject = $subj;
               //Read an HTML message body from an external file, convert referenced images to embedded,
               //convert HTML into a basic plain-text alternative body
               $mail->AddAddress('$to', '');
                               $mail->IsHTML(true);
                               $mail->Body= $msg;
                              
               //Replace the plain text body with one created manually
               $mail->AltBody = 'This is a plain-text message body';
               //Attach an image file
               //$mail->addAttachment('images/phpmailer_mini.png');
               
               //send the message, check for errors
               if (!$mail->send()) {
                   return "Mailer Error: " . $mail->ErrorInfo;
               } else {
                   return "Message sent!";
               }
               }
               
                $pwd1 = md5($pwd1);
               
                $register = "INSERT INTO users (email, username, password, hash) VALUES ('$email', '$username','$pwd1','$hash')";
                $query_result = mysqli_query($connect, $register);
                if($query_result) {
                   
                   $link = '<a href = "verify.php?email='.$email.'&hash='.$hash.'">Verify</a>';
               
                   
                   $rtn=sendmailx("kidistsamuel21@gmail.com",$email,"Please Confirm your Email","Click On This Link to Verify Email ".$link,"");
                              
                   if($rtn=="Message sent!")
                   {
                      echo "<script> 
                                alert('Please Confirm you email,  we have sent you the confirmation link through your email');
                            </script>";
                        
                   }
                //    else
                //    {
                //        echo "your Registration done we will send the confirmation soon, Emailing Problem";
                //    }
                    
                   
                }
               
            }
             
     ?>

    <div class="signup-form">
        <form class="form-horizontal" name="register" id="register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
            <div class="col-xs-8 col-xs-offset-4">
                <h2>Sign Up</h2>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Username</label>
                <div class="userNameError"> <?php echo $usernameErr; ?> </div>
                <div class="error"></div>
                <div id="userExist"></div>
                <div class="col-xs-8">
                    <input class="form-control" autofocus="" id="username" maxlength="150" name="username"
                         type="text" onInput="checkUsername()" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Email Address</label>
                <div class="emailError"> <?php echo $emailErr; ?> </div>
                <div class="error"></div>
                <div id="emailExist"></div>
                <div class="col-xs-8">
                    <input class="form-control" id="email" maxlength="254" name="email" type="text" onInput="checkEmail()" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Password</label>
                <div class="pwd1Error"> <?php echo $pwd1Err; ?> </div>
                <div class="error"></div>
                <div class="col-xs-8">
                    <input class="form-control" autocomplete="new-password" id="pwd1" name="pwd1" type="password" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Confirm Password</label>
                <div class="pwd2Error"> <?php echo $pwd2Err; ?> </div>
                <div class="error"></div>
                <div class="col-xs-8">
                    <input class="form-control" autocomplete="new-password" id="pwd2" name="pwd2" type="password" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-8 col-xs-offset-4">
                    <p><label class="checkbox-inline"><input type="checkbox" required="required"> I accept the <a
                                href="#">Terms of Use</a> &amp; <a href="#">Privacy Policy</a>.</label></p>
                    <input type="submit" id="submit" name="submit" class="btn btn-primary btn-lg" value="Sign Up">
                </div>
            </div>
        </form>
        <div class="text-center">Already have an account? <a href="login.php">Login here</a></div>
    </div>

    <script>
        const validEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        const validPwd = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
        let id = (id) => document.getElementById(id);
        let classes = (classes) => document.getElementsByClassName(classes);
        
        let username = id("username"),
            email = id("email"),
            pwd1 = id("pwd1"),
            pwd2 = id("pwd2"),
            register = id("register"),
            errorMsg = classes("error");

        register.addEventListener('submit', (e) => {
            // e.preventDefault();

            validation(username, 0, "Username is required");
            validation(email, 1, "Email is required");
            validation(pwd1, 2, "Password is required");
            validation(pwd2, 3, "Confirm your password");

            if(!validEmail.test(email.value)) {
                e.preventDefault();
                errorMsg[1].innerHTML="Input valid email";
            }
            if(!validPwd.test(pwd1.value)) {
                e.preventDefault();
                errorMsg[2].innerHTML="Password should be atleast 8 characters in length and should include at least one number, one uppercase and lowercase letter";
            }
            if(pwd1.value!=pwd2.value) {
                e.preventDefault();
                errorMsg[3].innerHTML="Passwords do not match";
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
