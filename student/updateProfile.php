<?php
//In the beginning of the page is session start .
//then the require connection.php to make the connection with database
// then I have checked about if there is session belongs to session belongs to student
session_start();
require '../connection.php';

if (isset($_SESSION["student"]["id"])) {

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Student - Update Profile</title>
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

                            <?php
                            if ($_SESSION["student"]["file_path"] != "") {
                                $img = "../" . $_SESSION["student"]["file_path"];
                            } else {
                                $img = "../images/officer.png";
                            }
                            ?>

                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class=" nav-link">
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION["student"]["fname"] . "  " . $_SESSION["student"]["lname"] ?></span>
                                            <img class="border rounded-circle img-profile" src="<?php echo $img ?>"></a>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Update Profile</h3><a class="btn btn-dark btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4 border border-4 p-3">
                                <p for="" class="h3 text-center">Add image</p>
                                <div class="row d-flex justify-content-center">
                                    <?php



                                    //If there is a profile image for the student and using the image variable I send the file path then I load the data of the student using student session

                                    if ($_SESSION["student"]["file_path"] != "") {
                                        $img = "../" . $_SESSION["student"]["file_path"];
                                    } else {
                                        $img = "../images/officer.png";
                                    }
                                    ?>
                                    <img src="<?php echo $img ?>" alt="" class="col-4" id="img" width="200px" height="200px">
                                </div>
                                <div class="mt-3">
                                    <input class="form-control form-control" id="image" type="file" placeholder="Select Image">
                                </div>
                            </div>
                            <div class="col-12 col-md-8  p-3">
                                <label for="">Your Email</label> <input type="text" class="form-control" value="<?php echo $_SESSION['student']['email'] ?>" disabled><br />
                                <label for="">User name</label> <input type="text" id="username" value="<?php echo $_SESSION['student']['username'] ?>" class="form-control"><br />
                                <label for="">First Name</label> <input type="text" id="fname" value="<?php echo $_SESSION['student']['fname'] ?>" class="form-control"><br />
                                <label for="">Last Name</label> <input type="text" id="lname" value="<?php echo $_SESSION['student']['lname'] ?>" class="form-control"><br />
                                <label for="">Mobile number</label> <input type="text" id="c_num" value="<?php echo $_SESSION['student']['c_num'] ?>" class="form-control"><br />
                                <label for="">Password</label> <input type="password" id="" value="<?php echo $_SESSION['student']['passward'] ?>" class="form-control" disabled><br />
                                <div class="row justify-content-center">
                                    <button class="btn btn-success col-4" onclick="updateData('student')">update Data</button>
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
        <script src="../login.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="js/bs-init.js"></script>
        <script src="../js/theme.js"></script>
    </body>

    </html>
<?php
} else {
    //Redirecting the user to the index page if there is no season belongs to the student
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>