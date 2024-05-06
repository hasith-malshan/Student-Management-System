<?php
session_start();
require '../connection.php';

if (isset($_SESSION["admin"]["id"])) {
    //checking session to verify if there is a admin

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Admin - Manage Officers</title>
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
                        <h3 class="text-dark mb-4">Manage Academic Officers</h3>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Academic Officers Details</p>
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
                                //searching the details of oficers
                                $officerSearch = Database::s("SELECT * FROM `officer`");
                                $officerSearchNr = $officerSearch->num_rows;
                                //getting number ofrows of results in the officer searching

                                ?>


                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>officer id</th>
                                                <th>username</th>
                                                <th>email</th>
                                                <th>Regester Date</th>
                                                <th>User Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php


                                            //if there is one more rows in the result set then i'm going to load the data
                                            for ($i = 0; $i < $officerSearchNr; $i++) {

                                                //searching statuses fro m the status table to load to the options in the select tag 
                                                $statusSearch = Database::s("SELECT * FROM `status` WHERE `id`<>'3'AND `id`<>'4' AND `id`<>'6' ");

                                                $officerSearchData = $officerSearch->fetch_assoc();
                                                //adding result set in to an associative array
                                            ?>
                                                <!-- loading data in toa atble row -->
                                                <tr>
                                                    <td><img class="rounded-circle me-2" width="30" height="30" src="images/me.jpg"><?php echo $officerSearchData['id'] ?></td>
                                                    <td><?php echo $officerSearchData['username'] ?></td>
                                                    <td><?php echo $officerSearchData['email'] ?></td>
                                                    <td><?php echo $officerSearchData['reg_date'] ?></td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example" id="<?php echo $officerSearchData['id'] . "status" ?>">

                                                            <?php
                                                            //serching statusname from the status table whick is already the ststus that belongs to the officer
                                                            $showStatus = Database::s("SELECT * FROM `status` WHERE `id` = '" . $officerSearchData['status_id'] . "' ");
                                                            //Assigning values to an associative array
                                                            $showStatusData = $showStatus->fetch_assoc();


                                                            ?>
                                                            <!-- Adding the already selected ststus as the first option and showing ti witha green background -->
                                                            <option selected value="<?php echo $officerSearchData['status_id'] ?>" class="bg-success text-white"><?php echo $showStatusData['status'] ?></option>

                                                            <?php
                                                            //loading ststus in to the otions in the select
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
                                                        <div class="d-grid gap-2">
                                                            <button type="button" name="" id="" class="btn btn-primary" onclick="manageOfficer('<?php echo $officerSearchData['id'] ?>');">Update Data</button>
                                                        <!-- callingf manage officer function to manage the officer -->
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }

                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>officer id</th>
                                                <th>username</th>
                                                <th>email</th>
                                                <th>Regester Date</th>
                                                <th>User Status</th>
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
    //rede4recting to the index page if there is no session belongs to the officer
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
