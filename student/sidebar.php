<?php
//This page is about this sidebar I use the side by using importing the sidebar.PHP

if (isset($_SESSION["student"]["id"])) {

?>
    <ul class="navbar-nav text-light" id="accordionSidebar">
        <li class="nav-item"><a class="nav-link" href="student.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="viewNotes.php"><i class="fas fa-pen-nib"></i><span>view Notes</span></a></li>
        <li class="nav-item"><a class="nav-link" href="assignments.php"><i class="fas fa-pen-nib"></i><span>Assignments</span></a></li>
        <li class="nav-item"><a class="nav-link" href="checkResults.php"><i class="fas fa-pen-nib"></i><span>Check Results</span></a></li>
        <li class="nav-item"><a class="nav-link active" href="updateProfile.php"><i class="fas fa-cog"></i><span>UpdateProfile</span></a></li>
        <li class="nav-item"><a class="nav-link" href="payments.php"><i class="fa fa-plus-square"></i><span>Payments</span></a></li>
        <li class="nav-item"><a class="nav-link active" href="../logOut.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>

    </ul>
<?php
} else {
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>