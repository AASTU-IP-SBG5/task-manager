<?php
 require 'connection.php';

   if(!empty($_POST["username"])){
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $query = "SELECT * FROM users WHERE username='" . $username. "'";
        $result = mysqli_query($connect, $query);
        $count = mysqli_num_rows($result);
        if($count>0){
            echo "<div id='userExist' style='color:red'>Username already exists</div>";
            echo "<script>$('#submit').prop('disabled',true);</script>";
        }
        else{
            echo "<script>$('#submit').prop('disabled',false);</script>";
        }
   }  
   
   if(!empty($_POST["email"])){
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $query = "SELECT * FROM users WHERE email='" . $email. "'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
    if($count>0){
        echo "<div style='color:red'>Email already exists</div>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }
    else{
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
} 
?>