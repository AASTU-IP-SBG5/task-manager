<?php

require("process.php");

 $project_error = array();

 if(isset($_POST['project_add_submit'])){
     add_project();
 }
 if(isset($_POST['task_submit'])){
     add_task();
 }
//  add project to database
 function add_project(){
    global $db,$project_error;

    $project_name = e($_POST['project_name']);
    $project_description = e($_POST['project_description']);
    $project_deadline = $_POST['deadline_date'];
    $project_created = date("Y-m-d");
    $project_updated = date("Y-m-d");
    $project_user_id = $_SESSION['user']['id'];
    $project_task_count = 0;
    // echo $project_deadline;
    // $project_created = 
    if (empty($_POST['project_name'])) {
        array_push($project_error, "enter a project name");
        
    }
    if(empty($_POST['deadline_date'])){
        array_push($project_error, "enter a project deadline");
    }

    if(count($project_error) == 0){
        $sql = "INSERT INTO project (project_name,pro_description,updated,created,task_count,deadline,user_id) VALUES ('$project_name','$project_description', '$project_updated', '$project_created', '$project_task_count', '$project_deadline', '$project_user_id')";
        mysqli_query($db, $sql);
        header('location: user_home.php');
    }

 }


 function add_task(){
    global $db,$project_error;

    $task_name = e($_POST['task_name']);
    $task_description = e($_POST['task_description']);
    $task_deadline = $_POST['task_deadline_date'];
    $task_created = date("Y-m-d");
    $task_updated = date("Y-m-d");
    // $query = 
    $task_project_id = $_SESSION['user']['id'];

    foreach($_SESSION['project'] as $x => $x_value) {
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
  
    if (empty($_POST['project_name'])) {
        array_push($project_error, "enter a project name");
        
    }
    if(empty($_POST['deadline_date'])){
        array_push($project_error, "enter a project deadline");
    }

    if(count($project_error) == 0){

        $sql = "INSERT INTO project (task_name,task_description,task_deadline,task_created,task_updated,project_id) VALUES ('$task_name','$task_description', '$task_deadline','$task_created', '$task_updated', '$task_project_id ')";
        mysqli_query($db, $sql);
        header('location: user_home.php');
    }

 }

 function display_project_error()
 {
    global $project_error;

	if (count($project_error) > 0){
		echo '<div class="error">';
			foreach ($project_error as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}




?>