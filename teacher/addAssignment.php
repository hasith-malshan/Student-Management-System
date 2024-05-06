<?php
//This page is used to add assignment for the teacher in the beginning the session is start then required connection.php and then check if there is a session belongs to teacher
session_start();
require '../connection.php';

if (isset($_SESSION["teacher"]["id"])) {

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>teacher - Dashboard</title>
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
                    if ($_SESSION["teacher"]["file_path"] != "") {
                        $img = "../" . $_SESSION["teacher"]["file_path"];
                    } else {
                        $img = "../images/officer.png";
                    }
                    ?>

                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>

                            <?php
                            if ($_SESSION["teacher"]["file_path"] != "") {
                                $img = "../" . $_SESSION["teacher"]["file_path"];
                            } else {
                                $img = "../images/officer.png";
                            }
                            ?>

                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow"><a class=" nav-link">
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION["teacher"]["fname"] . "  " . $_SESSION["teacher"]["lname"] ?></span>
                                            <img class="border rounded-circle img-profile" src="<?php echo $img ?>"></a>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0">Add Assignmets</h3><a class="btn btn-dark btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <div class="row g-5">
                                    <div class="col-md-4">
                                        <label for="">Your Grade</label>
                                        <input class="form-control" type="text" id="" disabled>
                                    </div>
                                    <div class="col-md-4">

                                        <label for="">Add Asignment Title</label>
                                        <input class="form-control" type="text" id="assignmentName">

                                    </div>

                                    <div class="col-md-4">

                                        <label for="">select Ends Date</label>
                                        <input class="form-control" type="date" id="assignmentDate">

                                    </div>

                                    <div class="col-md-6">
                                        <label for="formFileLg" class="form-label">Upload Assignment. (PDF & Word documents file types are only allowed)</label>
                                        <input class="form-control form-control" id="assignment" type="file" accept="application/pdf">
                                    </div>

                                    <div class="col-md-6">
                                        <textarea class="form-control" placeholder="Add any notes about Assignment" id="assignmentDescription" style="height: 100px"></textarea>

                                    </div>

                                    <div class="col-6">
                                        <input name="" id="" class="btn btn-primary" type="button" value="Button" onclick="addAssignment();">
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

        <!-- Modal -->
        <div class="modal fade " id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="msgModelTitle">Message from System</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="msgModelBody"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="teacher.js"></script>
    </body>

    </html>
<?php
} else {
    //If there is no session belongs to the teacher user will be redirected to index page
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>