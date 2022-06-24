<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'phpMail/src/Exception.php';
require 'phpMail/src/PHPMailer.php';
require 'phpMail/src/SMTP.php';

session_start();

$db = mysqli_connect('localhost', 'root', '', 'task_login');

//declarations
$username = "";
$email = "";
$errors = array();

// if register button is clicked
if (isset($_POST['register_btn'])) {
    register();
}

// REGISTER USER
function register()
{
    // call these variables with the global keyword to make them available in function
    global $db, $errors, $username, $email;

    //call e functioin to do basic input validatation like escape
    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password_1 = e($_POST['password1']);
    $password_2 = e($_POST['password2']);

    // form validation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Username is required");

    } else {
        $username = e($_POST['username']);
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    } else {
        $email = e($_POST['email']);
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
        echo $email;
        $vKey = md5(time() . $username);
        $password = md5($password_1);

        $query = "INSERT INTO user (username, email, user_type, password)
					  VALUES('$username', '$email', 'user', '$password')";
        $state = mysqli_query($db, $query);
        if ($state) {
			$logged_in_user_id = mysqli_insert_id($db);
        	$_SESSION['user'] = getUserById($logged_in_user_id);
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
                $mail->isSMTP(); //Send using SMTP
                $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
                $mail->SMTPAuth = true; //Enable SMTP authentication
                $mail->Username = 'kiogir00@gmail.com'; //SMTP username
                $mail->Password = 'qpzzqirwudvyjocb'; //SMTP password
                $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
                $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('kiogir00@gmail.com', 'Mailer');
                $mail->addAddress($email, $username); //Add a recipient
               
                $mail->isHTML(true); //Set email format to HTML
                $mail->Subject = 'Account Creation Confimation';
                $mail->Body = 'welcome to Task manager. Enjoy your work!!';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if($mail->send()){
					echo "mail sent succfully";
					 // put logged in user in session
        			$_SESSION['success'] = "You are now logged in";
        			header('location: user_home.php');
				}
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: ";
            }
            // $message = "<a href='https://localhost/taskmanager/templates/user/verify.php?vkey=$vKey'> Register Account </a>";
          
        }
        // get id of the created user
        // }
    }
}

// return user array from their id
function getUserById($id)
{
    global $db;
    $query = "SELECT * FROM user WHERE id=" . $id;
    $result = mysqli_query($db, $query);

    $user = mysqli_fetch_assoc($result);
    return $user;
}

// basic validate string
function e($val)
{
    global $db;
    $val = trim($val);
    $val = stripslashes($val);
    $val = htmlspecialchars($val);
    return mysqli_real_escape_string($db, $val);
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
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: login.php");
}

if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
function login()
{
    global $db, $username, $errors;

    $username = e($_POST['username']);
    $password = e($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password);

        $query = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) { // user found
            // check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['user_type'] == 'admin') {

                $_SESSION['user'] = $logged_in_user;

                $_SESSION['success'] = "You are now logged in";
                header('location: ../admin/admin_home.php');
            } else {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "You are now logged in";

                $user_session_id = $_SESSION['user']['id'];
                $query_project = "SELECT * FROM project WHERE user_id='$user_session_id'";

                $results_project = mysqli_query($db, $query_project);
                $projectlist_in_session = mysqli_fetch_assoc($results_project);

                $_SESSION['project'] = $projectlist_in_session;
                header('location: user_home.php');
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
function isAdmin()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
        return true;
    } else {
        return false;
    }
}
$searchErr = '';
$search_result = '';
if (isset($_POST['search_query'])) {

    if (!empty($_POST['search_query'])) {
        $search = $_POST['search_query'];
        $stmt = $con->prepare("select * from project where project_name like '%$search%'");
        $stmt->execute();
        $search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } else {
        $searchErr = "Please enter the information";
    }
}

// function output_project(){
// 	global $db;
// 	$display_project_id = $_SESSION['user']['id'];
// 	$query = "SELECT project_name FROM project Where project_id =".$display_project_id;
// 	$resultSet = mysqli_query($db, $query);
// 	$rsProject = mysqli_fetch_assoc($resultSet);
// 	echo $rsProject;
// 	// $projectlist_in_session = mysqli_fetch_assoc($resultSet);
// 	foreach($resultSet as $project){
// 		$str = "<li class='list-items'><td>".$project."</td></li>";
// 		echo $str;
// 	}
	


// }