<?php
//in the begining
//starting sessions
//importing connection.php to make database connection and use SQL commands
//checking wheather if there is  session belongs to officer
session_start();
require '../connection.php';

if (isset($_SESSION["officer"]["id"])) {

    if (!isset($_GET["id"])) {
?>
        <script>
            window.location = "studentMarks.php";
        </script>

    <?php
    } else {
        $assignment_id = $_GET["id"];



    ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
            <title>Academic Officer - Single Assignment</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
            <link rel="stylesheet" href="../fonts/fontawesome-all.min.css">
            <link rel="stylesheet" href="../fonts/font-awesome.min.css">
            <link rel="stylesheet" href="../fonts/fontawesome5-overrides.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
        </head>

        <body id="page-top">
            <div id="wrapper">

                <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-dark p-0">
                    <div class="container-fluid d-flex flex-column p-0">
                        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                            <div class="sidebar-brand-text mx-3"><span> </span></div>
                        </a>
                        <hr class="sidebar-divider my-0">
                        <?php
                        require "sidebar.php";
                        ?>

                        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
                    </div>
                </nav>

                <div class="d-flex flex-column" id="content-wrapper">

                    <div id="content">


                        <?php
                        if ($_SESSION["officer"]["file_path"] != "") {
                            $img = "../" . $_SESSION["officer"]["file_path"];
                        } else {
                            $img = "../images/officer.png";
                        }
                        ?>

                        <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                            <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                                <?php
                                if ($_SESSION["officer"]["file_path"] != "") {
                                    $img = "../" . $_SESSION["officer"]["file_path"];
                                } else {
                                    $img = "../images/officer.png";
                                }
                                ?>

                                <ul class="navbar-nav flex-nowrap ms-auto">
                                    <div class="d-none d-sm-block topbar-divider"></div>
                                    <li class="nav-item dropdown no-arrow">
                                        <div class="nav-item dropdown no-arrow"><a class=" nav-link">
                                                <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION["officer"]["fname"] . "  " . $_SESSION["officer"]["lname"] ?></span>
                                                <img class="border rounded-circle img-profile" src="<?php echo $img ?>"></a>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </nav>

                        <?php

                        //loading the data of the assignmt answers using the assignment id
                        $searchAssignments = Database::s("SELECT * FROM `assignment_answers` WHERE `assignments_id`='" . $assignment_id . "'");

                        $searchAssignmentsNr =  $searchAssignments->num_rows;
                        // getting the number of rows from the result set

                        ?>
                        <div class="container-fluid">
                            <h3 class="text-dark mb-4">Assignments</h3>
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Assignment id : <?php echo $assignment_id ?></p>
                                </div>
                                <div class="card-body">




                                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>student id</th>
                                                    <th>student email</th>
                                                    <th>Submitted Date</th>
                                                    <th>Marks</th>

                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                if ($searchAssignmentsNr > 0) {

                                                    // this for loop is to load the al data about assignment marks
                                                    for ($i = 0; $i < $searchAssignmentsNr; $i++) {

                                                        //adding the data of the assignment asnwes t the table

                                                        $searchAssignmentsData = $searchAssignments->fetch_assoc();

                                                        // searching all the data of student who has a grade
                                                        $checkStudent = Database::s("SELECT * FROM `student` WHERE `id`='" . $searchAssignmentsData["student_id"] . "' AND `status_id`='1' AND `grade_id`<>'1' ;");
                                                        $checkStudentData = $checkStudent->fetch_assoc();
                                                        // adding the results in to a associative array

                                                ?>
                                                        <tr>
                                                            <td><?php echo $searchAssignmentsData["student_id"] ?></td>
                                                            <td><?php echo $checkStudentData["email"] ?></td>
                                                            <td><?php echo $searchAssignmentsData["uploaded_date"] ?></td>
                                                            <td>
                                                                <lable class=""><?php echo $searchAssignmentsData["marks"] ?> <label< /td>
                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    // if there is no assignment thi messege will be displaye in the thable body

                                                    echo "<h1 class='text-warning text-center'>No Assignments</h1>";
                                                }
                                                ?>
                                            </tbody>


                                            <tfoot>
                                                <tr>
                                                    <th>student id</th>
                                                    <th>student email</th>
                                                    <th>Submitted Date</th>
                                                    <th>Marks</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 align-self-center">
                                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing x to n of m</p>
                                        </div>
                                        <div class="col-md-6">
                                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                                <ul class="pagination">
                                                    <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <footer class="bg-white sticky-footer">
                        <div class="container my-auto">
                            <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                        </div>
                    </footer>
                </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
            <script src="teacher.js"></script>
            <script src="js/chart.min.js"></script>
            <script src="js/bs-init.js"></script>
            <script src="../js/theme.js"></script>
        </body>

        </html>
    <?php
    }
} else {
    //if there is no session belongs to admin those users will be rederected in to index page

    ?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>