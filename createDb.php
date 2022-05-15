<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$connect = mysqli_connect($serverName, $userName, $password);
if (!$connect){
    die("Failed to connect" . mysqli_connect_error());
}

$query = "CREATE DATABASE task_manager";

if (!mysqli_query($connect, $query)){
    echo "Failed to create database ".mysqli_error($connect);
}
?>