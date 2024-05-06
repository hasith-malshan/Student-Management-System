<?php
session_start();
require '../connection.php';

if (isset($_SESSION["teacher"]["id"])) {

    $assignment_id = $_GET["id"];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Admin - Dashboard</title>
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

                    <?php
                    $searchAssignments = Database::s("SELECT * FROM `assignment_answers` WHERE `assignments_id`='" . $assignment_id . "'");
                    $searchAssignmentsNr =  $searchAssignments->num_rows;

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
                                                <th>view assignment</th>
                                                <th>Marks</th>
                                                <th>action</th>

                                            </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                            if ($searchAssignmentsNr > 0) {
                                                for ($i = 0; $i < $searchAssignmentsNr; $i++) {
                                                    $searchAssignmentsData = $searchAssignments->fetch_assoc();

                                                    $checkStudent = Database::s("SELECT * FROM `student` WHERE `id`='" . $searchAssignmentsData["student_id"] . "' AND `status_id`='1' AND `grade_id`<>'1' ;");
                                                    $checkStudentData = $checkStudent->fetch_assoc();
                                            ?>
                                                    <tr>
                                                        <td><?php echo $searchAssignmentsData["student_id"] ?></td>
                                                        <td><?php echo $checkStudentData["email"] ?></td>
                                                        <td><?php echo $searchAssignmentsData["uploaded_date"] ?></td>
                                                        <td><button class="btn btn-primary"><a class="text-white" href="<?php echo $searchAssignmentsData['file_path'] ?>">View</a></button></td>
                                                        <td><input type="number" class="form-control" id="mark<?php echo $searchAssignmentsData["student_id"] ?>"></td>
                                                        <td><button class="btn btn-success" onclick="addMarks(<?php echo $searchAssignmentsData['student_id'] ?>,<?php echo $assignment_id ?>);">add marks</button></td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<h1 class='text-warning text-center'>No Assignments</h1>";
                                            }
                                            ?>
                                        </tbody>


                                        <tfoot>
                                            <tr>
                                                <th>student id</th>
                                                <th>student email</th>
                                                <th>Submitted Date</th>
                                                <th>view assignment</th>
                                                <th>Marks</th>
                                                <th>action</th>

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
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>