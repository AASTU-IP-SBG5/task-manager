<?php
 require 'connection.php';

 $query = "CREATE TABLE if not EXISTS users (
   id int(11) PRIMARY KEY AUTO_INCREMENT,
    firstName varchar(40) NOT NULL, 
    fatherName varchar(40) NOT NULL, 
    email varchar(40) NOT NULL, 
    username varchar(40) NOT NULL, 
    password varchar(255) NOT NULL
    )";
 mysqli_query($connect, $query);
 if(!mysqli_query($connect, $query)){
    die ("Failed to create table".mysqli_error($connect));
}
else {
   echo "successfully created"; 
}
?>