<?php

require 'connection.php';


    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
     
        $email = mysql_escape_string($_GET['email']); 
        $hash = mysql_escape_string($_GET['hash']); 
                      
        $search = mysql_query("SELECT email, hash, status FROM usersregistration WHERE email='".$email."' AND hash='".$hash."' AND status='0'") or die(mysql_error());
        $match  = mysql_num_rows($search);
                      
        if($match > 0){
            mysql_query("UPDATE usersregistration SET status='1' WHERE email='".$email."' AND hash='".$hash."' AND status='0'") or die(mysql_error());
            // echo '<div class="statusmsg">Your account has been activated, you can now login</div>';
        }
        else{
            echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
        }
                      
    }
    else{
        echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
    }
?>