<?php

session_start();

$db = mysqli_connect('localhost', 'root', '', 'task_login');

//declarations
$adminName = "";
$adminPassword    = "";
$errors   = array();

if (isset($_POST['adminLog'])) {
    admin_login();
}

function admin_login()
{

    global $adminName, $adminPassword, $errors, $db;

    $adminName = validate_input($_POST['adminname']);
    $adminPassword = validate_input($_POST['adminpassword']);

    if (empty($adminName)) {
        array_push($errors, "username is required");
    }
    if (empty($adminPassword)) {
        array_push($errors, "password is required");
    }

    if (count($errors) == 0) {
        // $adminPassword = md5($adminPassword);

        $query = "SELECT * FROM adminstrator WHERE admin_name='$adminName' AND admin_password='$adminPassword' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $logged_in_admin = mysqli_fetch_assoc($results);

            $_SESSION['admin'] = $logged_in_admin;
            $_SESSION['admin_success'] = "you are now logged in";
            header('location: admin.php');
        }else{
            array_push($errors, "wrong name/password combnation");
        }
            
    }
}


function validate_input($value)
{
    global $db;
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return mysqli_real_escape_string($db, $value);
}
function display_error()
{
    global $errors;

    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['admin']);
	header("location: admin_login.php");
}

function isAdmin()
{
	if (isset($_SESSION['admin']) && $_SESSION['admin']['admin_status'] == 1 ) {
		return true;
	}else{
		return false;
	}
}