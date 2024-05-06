<?php
session_start();
//statting sessions
require '../connection.php';
//importing the connection.php because the all functions related to the databse connction and query execuution is in that page

if (isset($_SESSION["admin"]["id"])) {
    //checking is there any session belongs to admin
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Admin - Manage Teachers</title>
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
                        <div class="sidebar-brand-text mx-3"><span></span></div>
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
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                            <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-dark py-0" type="button"><i class="fas fa-search"></i></button></div>
                            </form>

                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                        <form class="me-auto navbar-search w-100">
                                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                                <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                            </div>
                                        </form>
                                    </div>
                                </li>


                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Hasith Malshan</span><img class="border rounded-circle img-profile" src="images/me.jpg"></a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                            <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Manage Teachers</h3>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Teacher Details</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 text-nowrap">
                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                    <option value="10" selected="">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>&nbsp;</label></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                    </div>
                                </div>


                                <?php
                                //seaarcing the all details of the teachers
                                $teacherSearch = Database::s("SELECT * FROM teacher");
                                $teacherSearchNr = $teacherSearch->num_rows;
                                //getting number of rows that in the result set


                                ?>


                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>teacher id</th>
                                                <th>username</th>
                                                <th>email</th>
                                                <th>Regester Date</th>
                                                <th>User Status</th>
                                                <th>Grade</th>
                                                <th>Subject</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                            // if there is one or more rows in the result set this for loop starts to add the data in to a table

                                            for ($i = 0; $i < $teacherSearchNr; $i++) {
                                                $teacherSearchData = $teacherSearch->fetch_assoc();
                                                // adding the techers data in to an assocative array;

                                                $subjectSearch = Database::s("SELECT * FROM `subject`");
                                                //select all data from subject
                                                $statusSearch = Database::s("SELECT * FROM `status` WHERE `id`<>'3'AND `id`<>'4' AND `id`<>'6' ");
                                                // select the statuses from the status table except status id = 3,4,6
                                                $gradeSearch = Database::s("SELECT * FROM `grade`");
                                                //se;lecting all dat afrom the grade table


                                            ?>

                                                <!-- adding data to a table row -->
                                                <tr>
                                                    <td><img class="rounded-circle me-2" width="30" height="30" src="images/me.jpg">1</td>
                                                    <td><?php echo $teacherSearchData['username'] ?></td>
                                                    <td><?php echo $teacherSearchData['email'] ?></td>
                                                    <td><?php echo $teacherSearchData['reg_date'] ?></td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example" id="<?php echo $teacherSearchData['id'] . "status" ?>">

                                                            <?php
                                                            //searching the the details of the teacher from the session and searching for what subjkect teacher is teaching, whts grade does teachs to and whst is the status of the teacher.
                                                            $showStatus = Database::s("SELECT * FROM `status` WHERE `id` = '" . $teacherSearchData['status_id'] . "' ");
                                                            $showGrade = Database::s("SELECT * FROM `grade` WHERE `id` = '" . $teacherSearchData['grade_id'] . "' ");
                                                            $showSubject = Database::s("SELECT * FROM `subject` WHERE `id` = '" . $teacherSearchData['subject_id'] . "' ");


                                                            $showStatusData = $showStatus->fetch_assoc();
                                                            $showGradeData = $showGrade->fetch_assoc();
                                                            $showSubjectData = $showSubject->fetch_assoc();
                                                            // adding the data that already seachrd in the show_status,show_grade & show subject to associative arrays


                                                            ?>
                                                            <!-- showing the already existing ststus -->
                                                            <option selected value="<?php echo $teacherSearchData['status_id'] ?>" class="bg-success text-white"><?php echo $showStatusData['status'] ?></option>

                                                            <?php
                                                            //loading status data in to the select tag through the options
                                                            for ($j = 0; $j < $statusSearch->num_rows; $j++) {
                                                                $statusSearchData = $statusSearch->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $statusSearchData['id'] ?>"><?php echo $statusSearchData['status'] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example" id="<?php echo $teacherSearchData['id'] . "grade" ?>">
                                                            <!-- showing the already existing drade to the teacher -->
                                                            <option selected value="<?php echo $teacherSearchData['grade_id'] ?>" class="bg-success text-white"><?php echo $showGradeData['name'] ?></option>

                                                            <?php
                                                            //if teacher is in the not assigned ststud (status Id = 06) then the admin can assign him a grade
                                                            if ($teacherSearchData['status_id'] == '6') {
                                                                for ($j = 0; $j < $gradeSearch->num_rows; $j++) {
                                                                    //loading ststuses from the ststus table to assign a ststus to the teaches who has the ststus of not assigned.
                                                                    $gradeSearchData = $gradeSearch->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $gradeSearchData['id'] ?>"><?php echo $gradeSearchData['name'] ?></option>
                                                                    <!-- loading data in to the options  using the for loop -->
                                                            <?php
                                                                }
                                                            }

                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td> <select class="form-select" aria-label="Default select example" id="<?php echo $teacherSearchData['id'] . "subject" ?>">
                                                            <!-- loading the current existing subject in to the option -->
                                                            <option selected value="<?php echo $teacherSearchData['subject_id'] ?>" class="bg-success text-white"><?php echo $showSubjectData['name'] ?></option>

                                                            <?php
                                                            // if the teaches is in the not assigned status. the load the subjects for the select tag

                                                            if ($teacherSearchData['status_id'] == '6') {
                                                                for ($j = 0; $j < $subjectSearch->num_rows; $j++) {
                                                                    $subjectSearchData = $subjectSearch->fetch_assoc();
                                                            ?>
                                                                    <option value="<?php echo $subjectSearchData['id'] ?>"><?php echo $subjectSearchData['name'] ?></option>
                                                            <?php
                                                                }
                                                            }

                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <!-- in onclick functio nwil be called to change the status -->
                                                        <div class="d-grid gap-2">
                                                            <button type="button" name="" id="" class="btn btn-primary" onclick="manageTeacher('<?php echo $teacherSearchData['id'] ?>');">Update Data</button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }

                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>teacher id</th>
                                                <th>username</th>
                                                <th>email</th>
                                                <th>Regester Date</th>
                                                <th>User Status</th>
                                                <th>Grade</th>
                                                <th>Subject</th>
                                                <th>Action</th>
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
        <script src="../common.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="js/bs-init.js"></script>
        <script src="../js/theme.js"></script>
    </body>

    </html>
<?php
} else {
    //if there is no session user will be redeirected to the index page
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
