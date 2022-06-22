
<?php 
// include("process.php");
include("project.php");

if(!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

?>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <link href="/styles/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" rel="stylesheet" />

    <script crossorigin="anonymous" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script crossorigin="anonymous" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script crossorigin="anonymous" src="https://kit.fontawesome.com/e9e17d19f6.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <link href="/styles/style.css" rel="stylesheet" />
    <link href="/styles/bg.css" rel="stylesheet" />
    <link href="/styles/team_info.css" rel="stylesheet" />

    <title>Task Manager</title>

    <style>
        body,
        html {
            height: 100%;
            overflow-x: hidden;
        }

        body {
            width: 100%;
            height: 100%;
            position: absolute;
            background: linear-gradient(to bottom, #6e529d 0%, #d97b93 100%);
        }

        .card-shadow {
            box-shadow:
                0 100px 80px rgba(0, 0, 0, 0.12);
            border: none;
        }

        .wrapper {
            width: 95%;
            display: flex;
            justify-content: space-between;
            margin: 0 auto;
        }

        .sidebar-top {
            margin-top: 45px;
        }

        .py-5 {
            width: 75%;
        }

        .project-link {
            display: flex;
            margin-top: 5px;
        }

        .list-group {
            padding: 10px;
            border-radius: 5px;
        }

        ul {
            list-style: none;
        }

        li {
            margin-bottom: 10px;
        }

        .card-bg-color {
            background-color: #ebecf0 !important;
        }

        .list-items:hover {
            background-color: #ebecf0 !important;
        }


        .card-list {
            padding: 8px;
            background-color: #fff;
            width: 100%;
            margin-bottom: 7px;
            border-radius: 5px;
        }

        .autocomplete {
            position: relative;
            display: inline-block;
        }

        input {
            border: 1px solid transparent;
            background-color: #f1f1f1;
            padding: 10px;
            font-size: 16px;
        }

        input[type=text] {
            background-color: #f1f1f1;
            width: 100%;
        }

        input[type=submit] {
            background-color: green;
            color: #fff;
            cursor: pointer;
        }

        #autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            font-style: italic;
            top: 100%;
            left: 0;
            top: 0;
        }

        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
            font-style: italic;
        }

        .autocomplete-active {
            background-color: dodgerblue !important;
            color: #ffffff;
        }

        .messages {
            list-style-type: none;
            padding: 0;
            margin: 20px;
        }

        .messages li {
            border: 1px solid #ddd;
            margin-top: -1px;
            /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
            position: relative;
        }

        .messages li:hover {
            background-color: #eee;
        }

        .close-message {
            cursor: pointer;
            position: absolute;
            top: 50%;
            right: 0%;
            padding: 12px 16px;
            transform: translate(0%, -50%);
        }

        .close-message {
            background: #bbb;
        }

        .member-list {
            display: flex;
            width: 100%;
            text-align: center;
            margin-left: -50px;
        }

        .list-user {
            margin-left: 5px;
            width: 30px;
            line-height: 30px;
            border-radius: 50%;
            text-align: center;
            color: #f1f1f1;
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    <!-- star of header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/projects/">#Work<span>List</span></a>
        <button aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"
            class="navbar-toggler" data-target="#navbarNavDropdown" data-toggle="collapse" type="button">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/projects/show-projects/">Personal Projects <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dashboard/my-team/">Group Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
            </ul>
        </div>
        <div>
            <form action="/projects/search-projects/" class="form-inline" method="get">
                <input aria-label="Search" class="form-control mr-sm-2" name="query"
                    placeholder="Search your project...." type="search" />
            </form>
        </div>
        <div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/user/my-profile/">
                        <span><i class  = "fa-solid fa-user" ></i></span>
                        user </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_home.php?logout='1'">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- end of header -->

    <!-- start of main container section -->
    <div class="wrapper">

        <!-- Start of Sidebar -->
        <div class="sidebar-container">
            <div class="sidebar-top">

                <form action="project.php" method="POST" >
                     <?php echo display_project_error(); ?>

                    <!-- Add a token here -->
                    <div class="form-row">
                        <div class="form-group col-md-9">
                            <input class="form-control" id="id_project_name" maxlength="20" name="project_name"
                                placeholder="Add new project...." required="" type="text" />
                        </div>

                        <div class="form-group col-md-1">
                            <a class="btn btn-outline-primary" data-target="#create_project" data-toggle="modal"
                                href="#create_project">ADD</a>
                            <div aria-hidden="true" aria-labelledby="exampleModalCenterTitle" class="modal fade"
                                id="create_project" role="dialog" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">
                                                Add Description:
                                            </h5>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea cols="40" id="id_project_description" maxlength="100"
                                                name="project_description" required="" rows="10">
                                            </textarea>
                                            <div class="form-group">
                                                <label for="id_deadline_date">Deadline date:</label>
                                                <input class="form-control" id="id_deadline_date" name="deadline_date"
                                                    required="" type="date">
                                                </input>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- button for additon of a project -->
                                            <input class="btn btn-primary" type="submit" value="Submit" name="project_add_submit" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- start Listing projects  -->
            <div class="card border-info mb-3 card-bg-color" style="max-width: 18rem;">
                <div class="card-header">Browse Group Projects</div>
                <ul class="card-body text-info">
                    <li class="list-items">
                        <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                            href="/dashboard/team-project/1/">
                            Example project
                        </a>
                    </li>
                </ul>
            </div>
            <!-- end listing projects -->
        </div>
        <!-- End of sidebar -->

        <!-- Start of main section -->
        <div class="py-5">
            <div class="container">
                <div class="row hidden-md-up">

                    <!-- Start of Todo column -->
                    <div class="col-md-4">
                        <!-- Start of Add Task Modal (show only if atleast one project exists) -->

                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title" style="display:inline; margin-right: 20px;">Example project</h5>
                                <a href="#deleteProject{{project.id}}" data-toggle="modal"
                                    data-target="#deleteProject{{project.id}}"><i class="fa-solid fa-trash"></i>
                                </a>
                                <!-- Delete button Modal -->
                                <div class="modal fade" id="deleteProject{{project.id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">

                                        <form action={% url 'delete-pp' personal_default.id %} method="POST">
                                            {% csrf_token %}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Confirm
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete example project</p>
                                                    <!-- <p>Are you sure want to delete "{{personal_default.project_name}}"?</p> -->
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-warning" value="Delete">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- <h6 class="card-subtitle mb-2 text-muted">{{personal_default.count}} Tasks </h6> -->
                                <h6 class="card-subtitle mb-2 text-muted"> 2 Tasks </h6>

                                <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis
                                    laboriosam recusandae consequatur, ipsum quis provident.</p>

                                <a href="#exampleProject" data-toggle="modal" data-target="#exampleProject">
                                    +Add Task
                                </a>
                                <div class="modal fade" id="exampleProject" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <form action="project.php" method="POST">
                                                <!-- {% csrf_token %} -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        <!-- {{task.task_name}} -->
                                                        example task 1
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="id_task_name">Task name:</label>
                                                        <input class="form-control" id="id_task_name" maxlength="50"
                                                            name="task_name" required="" type="text" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id_description">Description:</label>
                                                        <textarea cols="40" id="id_description" name="task_description"
                                                            required="" rows="10">
                                      </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="id_deadline_date">Deadline date:</label>
                                                        <input class="form-control" id="id_deadline_date"
                                                            name="task_deadline_date" required="" type="text" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input class="btn btn-primary" name="task_submit" type="submit" value="submit" />

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- if no project exists -->
                        <!-- <div class="message-wrapper">
                            <p>No project</p>
                        </div> -->
                        <!-- End of Add Tsk Modal -->

                        <!-- Displaying a message -->
                    </div>
                    <!-- End of Todo Column -->

                    <!-- Start of Pending Column -->
                    <div class="col-md-4">
                        <div class="card card-bg-color">
                            <div class="card-header text-center text-white bg-secondary mb-3">
                                Pending
                                <span style="float: right;">+1</span>
                            </div>
                            <div class="card-body text-info">

                                <!-- iterate over the tasks and show it here -->
                                <div class="card-list">
                                    <a href="#exampletask" class="card-title" data-toggle="modal"
                                        data-target="#exampletask">example task1</a>
                                    <form action={% url 'mark-completed' task.id %} method="post" style="float: right;">
                                        <!-- {% csrf_token %} -->
                                        <div>
                                            <input type="checkbox" onclick="this.form.submit()">
                                        </div>
                                    </form>
                                </div>

                                <div class="modal fade" id="exampletask" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    <!-- {{task.task_name}} -->
                                                    example task1
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Description: {{task.description}}</p>
                                                <p>Status: ToDo </p>

                                                <p>Deadline: {{task.deadline_date}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href={% url 'update-personalTask' task.id %}
                                                    class="btn btn-primary">Edit</a>
                                                <form action={% url 'delete-pt' task.id %} method="post">
                                                    <!-- {% csrf_token %} -->
                                                    <input type="submit" value="Delete" class="btn btn-secondary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Pending Column -->

                    <!-- Start of Pending Column -->
                    <div class="col-md-4">
                        <div class="card card-bg-color">
                            <div class="card-header text-center text-white bg-success mb-3">
                                Completed
                                <span style="float: right;">+1</span>
                            </div>
                            <div class="card-body text-info">
                                <!-- iterate over the tasks and show it here -->
                                <div class="card-list">
                                    <a href="#exampletask" class="card-title" data-toggle="modal"
                                        data-target="#exampletask">example task2</a>
                                    <form action={% url 'mark-completed' task.id %} method="post" style="float: right;">
                                        <!-- {% csrf_token %} -->
                                        <div>
                                            <!-- <input type="checkbox" onclick="this.form.submit()"> -->
                                        </div>
                                    </form>
                                </div>

                                <div class="modal fade" id="exampletask" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">
                                                    <!-- {{task.task_name}} -->
                                                    example task1
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Description: {{task.description}}</p>
                                                <p>Status: ToDo </p>

                                                <p>Deadline: {{task.deadline_date}}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href={% url 'update-personalTask' task.id %}
                                                    class="btn btn-primary">Edit</a>
                                                <form action={% url 'delete-pt' task.id %} method="post">
                                                    <!-- {% csrf_token %} -->
                                                    <input type="submit" value="Delete" class="btn btn-secondary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Pending Column -->

                </div>
            </div>
        </div>
    </div>
    <!-- End of main container section -->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://pingendo.com/assets/bootstrap/bootstrap-4.0.0-alpha.6.min.js"></script>

    <script src="/static/js/mark_task.js"></script>
    <script src="/static/js/s.js"></script>

    <script>

        $('.list-user').each(function () {
            var back = ["green", "blue", "gray", "orange", "purple",];
            var rand = back[Math.floor(Math.random() * back.length)];
            $(this).css('background', rand);
        });

        var closebtns = document.getElementsByClassName("close-message");
        var i;

        for (i = 0; i < closebtns.length; i++) {
            closebtns[i].addEventListener("click", function () {
                this.parentElement.style.display = 'none';
            });
        }

        function autocomplete(inp, arr) {
            var currentFocus;
            inp.addEventListener("input", function (e) {
                var a, b, i, val = this.value;
                closeAllLists();

                if (!val) { return false; }

                currentFocus = -1;

                a = document.createElement("FORM");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");

                this.parentNode.appendChild(a);

                for (i = 0; i < arr.length; i++) {

                    if (arr[i][1].substr(0, val.length).toUpperCase() == val.toUpperCase()) {

                        b = document.createElement("DIV");
                        b.innerHTML = "<strong>" + arr[i][1].substr(0, val.length) + "</strong>";

                        b.innerHTML += arr[i][1].substr(val.length);
                        b.innerHTML += "<input type='hidden' name = 'user_id' value='" + arr[i][1] + "' id = '" + arr[i][0] + "' >";

                        b.addEventListener("click", function (e) {
                            inp.value = this.getElementsByTagName("input")[0].value;
                            closeAllLists();
                        });
                        console.log(b)
                        a.appendChild(b);
                    }
                }
            });


            inp.addEventListener("keydown", function (e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    currentFocus++;
                    addActive(x);
                } else if (e.keyCode == 38) {
                    currentFocus--;
                    addActive(x);
                } else if (e.keyCode == 13) {
                    e.preventDefault();
                    if (currentFocus > -1) {
                        if (x) x[currentFocus].click();
                    }
                }
            });
            function addActive(x) {
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                x[currentFocus].classList.add("autocomplete-active");
            }
            function removeActive(x) {
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }
            function closeAllLists(elmnt) {
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            document.addEventListener("click", function (e) {
                closeAllLists(e.target);
            });
        }
        var data = JSON.parse("{\u00221\u0022: \u0022ibsa\u0022}");
        data_list = []
        for (var user in data) {
            data_list.push([user, data[user]])
        }
        autocomplete(document.getElementById("myInput"), data_list);
    </script>
</body>

</html>