<?php
session_start();
//starting sessions
require '../connection.php';
//importing connection.php to make database connection and use SQL commands
if (isset($_SESSION["admin"]["id"])) {
    //checking session to verify if there is a admin

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Admin - Add Officer</title>
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
                        <div class="sidebar-brand-text mx-3"><span>LMS ADMINS</span></div>
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
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Officer Invitation</h3><a class="btn btn-dark btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Enter Academmic officer Email</label>
                                    <input type="text" class="form-control" name="" id="email" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="" id="username" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="" class="form-label">Passward</label>
                                    <input type="text" class="form-control" name="" id="passward" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row d-flex justify-content-center">
                                    <button class="btn btn-primary col-2" onclick="generateItems();">Generate Username & Passward</button>
                                    <!-- request to generate usernames and passwards -->
                                    <button class="btn btn-danger col-2 mx-3" onclick="clearFields();">Clear Fields</button>
                                    <!-- clear fields -->
                                </div>
                                <div class="row d-flex justify-content-center mt-3">
                                    <button class="btn btn-success col-2" onclick="invitation('officer');">Send invitation</button>
                                    <!-- sending invitation to the officer type account -->
                                </div>

                            </div>
                        </div>




                    </div>
                </div>

                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>LMS 2022</span></div>
                    </div>
                </footer>
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="verificationAdmin.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="../js/bs-init.js"></script>
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

?>