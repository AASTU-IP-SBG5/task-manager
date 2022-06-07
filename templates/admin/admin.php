
<?php 
include("function.php");
 
if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: admin_login.php');
}


?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="adjust-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><i class="fa fa-square-o "></i>&nbsp;Admin Panel</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#admin_name">#admin_name</a></li>
                        <li><a href="#">Go To Website</a></li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">                    
                    <li class="text-center user-image-back">
                        <i class="fa-solid fa-user fa-8x"></i>                     
                    </li>


                    <li>
                        <a href="index.html"><i class="fa-solid fa-gauge"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#messages"><i class="fa-solid fa-message"></i>Messages</a>
                    </li>
                    <li>
                        <a href="#notificaions"><i class="fa-solid fa-bell"></i>Notifications</a>
                    </li>
                    <li>
                        <a href="#admin_project_list"><i class="fa fa-table "></i>Admin and Project</a>
                    </li>
                    <li>
                        <a href="#add_admin"><i class="fa-solid fa-circle-plus"></i>Add Admin </a>
                    </li>
                    <li>
                        <a href="admin_login.php?logout='1'"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Admin Dashboard</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-6" id="dashboard">
                        <h5>User Number</h5>
                        <div class="panel panel-primary text-center no-boder bg-color-blue">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <i class="fa-solid fa-people-group fa-5x"></i>
                                <h3>120+</h3>
                            </div>
                            <div class="panel-footer back-footer-blue">
                                Total User
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" id="daily_visitors">
                        <h5>Daily Visitors</h5>
                            <div class="alert bg-success text-center">
                                <i class="fa-solid fa-eye fa-5x"></i>
                                <h3> 100+ </h3>
                                Active Daily Visitors
                            </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" id="project_created">
                        <h5>Project Created</h5>
                        <div class="alert alert-info text-center">
                            <i class="fa-solid fa-diagram-project fa-5x"></i>
                            <h3> 100+ </h3>
                            Projects have been created so far
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-6" id="daily_usage">
                        <h5>Daily Usage</h5>
                        <div class="alert bg-warning text-center">
                            <i class="fa-solid fa-address-book fa-5x"></i>
                            <h3> 100+ </h3>
                            Total tasks created
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-4" id="add_admin">
                        <h5>Add Admin Account</h5>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" name="admin_username" required />
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="admin_email" required>
                            <label for="">Create Password</label>
                            <input type="password" class="form-control" name = "admin_password" required>
                            <label for="">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_passwrod" required><br>
                            <input type="submit" class="btn btn-primary" style="float: right;" value="Create">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>Go To website</label>
                        <a href="blank.html" target="_blank" class="btn btn-info btn-block">website</a>
                    </div>

                    <div class="col-md-4">
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, cumque tempore. Magnam, delectus? Error aliquam ipsum, autem voluptates molestias nam!
                        <a href="www.google.com">google.com</a>
                    </div>
                </div>
                <hr />

                <div class="row" id="admin_project_list">
                    <div class="col-md-6">
                        <h5>List of Admin Accounts</h5>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>ibsa21</td>
                                    <td>Ibsa</td>
                                    <td><a href="mailto:ibsaabraham663@gmail.com">ibsaabraham663@gmail.com</a></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>kaleab12</td>
                                    <td>Kaleab</td>
                                    <td><a href="kaleabg22@gmail.com">kaleabg22@gmail.com</a></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>ibsa21</td>
                                    <td>Ibsa</td>
                                    <td><a href="mailto:ibsaabraham663@gmail.com">ibsaabraham663@gmail.com</a></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>kaleab12</td>
                                    <td>Kaleab</td>
                                    <td><a href="kaleabg22@gmail.com">kaleabg22@gmail.com</a></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-md-6">
                        <h5>Recent Created Project</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr class="info">
                                        <th>#</th>
                                        <th>Project Name</th>
                                        <th>Created By</th>
                                        <th>Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="success">
                                        <td>1</td>
                                        <td>PHP Website</td>
                                        <td>ibsa21</td>
                                        <td>True</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />


                <div class="row">
                    <div class="col-md-4">
                        <h5>Panel Sample</h5>
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Default Panel
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                            </div>
                            <div class="panel-footer">
                                Panel Footer
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Accordion Sample</h5>
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">Collapsible Group Item #1</a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                    <div class="panel-body">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Collapsible Group Item #2</a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                    <div class="panel-body">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.

                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">Collapsible Group Item #3</a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                  

                                        <div class="panel-body">
                                             Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h5>Tabs Sample</h5>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#home" data-toggle="tab">Home</a>
                            </li>
                            <li class=""><a href="#profile" data-toggle="tab">Profile</a>
                            </li>
                            <li class=""><a href="#messages" data-toggle="tab">Messages</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="home">
                                <h4>Home Tab</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="profile">
                                <h4>Profile Tab</h4>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                </p>

                            </div>
                            <div class="tab-pane fade" id="messages">
                                <h4>Messages Tab</h4>
                                <p >
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit eserunt mollit anim id est laborum.
                                </p>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- /. ROW  -->
                <hr />
                  <div class="row">
                    <div class="col-md-12">
                        <h5>Information</h5>
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Voluptatem expedita atque cupiditate accusamus voluptatum vitae, accusantium quae at magni nulla soluta sed velit deserunt quos eligendi voluptates perspiciatis laudantium voluptatibus aut officia aperiam, cumque dolor odit optio? Earum nihil suscipit vel, libero ab voluptate dicta ut iusto est pariatur? Ut?
                    </div>
                </div>
                <!-- /. ROW  -->

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>
</html>
