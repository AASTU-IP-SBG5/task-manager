<?php
 require 'connection.php';

 $query = "CREATE TABLE if not EXISTS users (
   id int(11) PRIMARY KEY AUTO_INCREMENT, 
    email varchar(40) NOT NULL, 
    username varchar(40) NOT NULL, 
    password varchar(255) NOT NULL,
    hash varchar(255) NOT NULL DEFAULT '0',
    status int(11) NOT NULL DEFAULT '0' 
    )";
 mysqli_query($connect, $query);
 if(!mysqli_query($connect, $query)){
    die ("Failed to create table".mysqli_error($connect));
}
else {
   echo "successfully created"; 
}
?>