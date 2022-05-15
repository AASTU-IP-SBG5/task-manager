<?php
$dbName = "task_manager";
$serverName = "localhost";
$userName = "root";
$password = "";
$connect = mysqli_connect($serverName, $userName, $password, $dbName);
if (!$connect){
    die("Failed to connect" . mysqli_connect_error());
}

?>