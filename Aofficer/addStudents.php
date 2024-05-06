<?php
//in the begining
//starting sessions
//importing connection.php to make database connection and use SQL commands
//checking wheather if there is  session belongs to officer
session_start();

require '../connection.php';

if(isset($_SESSION["officer"]["id"])){

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Officer - Add Student</title>
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

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Add Student</h3><a class="btn btn-dark btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Enter Student Email</label>
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
                                <button class="btn btn-danger col-2 mx-3" onclick="clearFields();">Clear Fields</button>
                            </div>
                            <div class="row d-flex justify-content-center mt-3">
                                <button class="btn btn-success col-2" onclick="invitation('student');">Send invitation</button>
                            </div>

                        </div>
                    </div>

                    .


                </div>
            </div>

            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="verificationOfficer.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/bs-init.js"></script>
    <script src="../js/theme.js"></script>
</body>

</html>

<?php
}else{
 ?>
 <script>
    window.location = "index.php";
 </script>
 <?php   
}

?>