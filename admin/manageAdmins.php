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
        <title>Admin - Admins Officers</title>
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
                            <ul class="navbar-nav flex-nowrap ms-auto">

                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small">Hasith Malshan</span>
                                            <img class="border rounded-circle img-profile" src="images/me.jpg"></a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </nav>

                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Manage Admins</h3>
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Admin Details</p>
                            </div>
                            <div class="card-body">



                                <?php
                                //searcing details of admins exept super admins
                                $adminSearch = Database::s("SELECT * FROM `admin` WHERE `status_id`<>'4'");

                                $adminSearchNr = $adminSearch->num_rows;
                                //getting number of rowa in the result set



                                ?>


                                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                    <table class="table my-0" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>admin id</th>
                                                <th>username</th>
                                                <th>email</th>
                                                <th>User Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php



                                            for ($i = 0; $i < $adminSearchNr; $i++) {

                                                $statusSearch = Database::s("SELECT * FROM `status` WHERE `id`<>'3'AND `id`<>'4' AND `id`<>'6' ");
                                                //search statuses from the status table except super  , pending and Not assigned;

                                                $adminSearchData = $adminSearch->fetch_assoc();
                                                //assigning results of admin search to an associative array
                                            ?>

                                                <tr>
                                                    <!-- loading admin details to the admin table -->
                                                    <td><?php echo $adminSearchData['id'] ?></td>
                                                    <td><?php echo $adminSearchData['username'] ?></td>
                                                    <td><?php echo $adminSearchData['email'] ?></td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example" id="<?php echo $adminSearchData['id'] . "status" ?>">

                                                            <?php
                                                            $showStatus = Database::s("SELECT * FROM `status` WHERE `id` = '" . $adminSearchData['status_id'] . "' ");
                                                            //searching data from status table by using admin ststus id
                                                            $showStatusData = $showStatus->fetch_assoc();
                                                            //assigning results of admin search to an associative array



                                                            ?>
                                                            <option selected value="<?php echo $adminSearchData['status_id'] ?>" class="bg-success text-white"><?php echo $showStatusData['status'] ?></option>
                                                            <!-- showwing already assigned status -->
                                                            <?php
                                                            for ($j = 0; $j < $statusSearch->num_rows; $j++) {
                                                                $statusSearchData = $statusSearch->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $statusSearchData['id'] ?>"><?php echo $statusSearchData['status'] ?></option>
                                                                <!-- load other statuses to select a new status -->
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <div class="d-grid gap-2">
                                                            <button type="button" name="" id="" class="btn btn-primary" onclick="manageAdmin('<?php echo $adminSearchData['id'] ?>');">Update Data</button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            <?php
                                            }

                                            ?>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>admin id</th>
                                                <th>username</th>
                                                <th>email</th>
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
    // if there is no admin it will be rederect to the index page and then to the portal page

?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
