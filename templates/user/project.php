<?php

require("process.php");

 $project_error = array();

 if(isset($_POST['project_add_submit'])){
     add_project();
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