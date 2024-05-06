<?php

if (isset($_SESSION["admin"]["id"])) {

?>
    <ul class="navbar-nav text-light" id="accordionSidebar">
        <li class="nav-item"><a class="nav-link" href="admin.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="addOfficers.php"><i class="fa fa-plus-square"></i><span>Add Academic Officers</span></a></li>
        <li class="nav-item"><a class="nav-link" href="addTeachers.php"><i class="fa fa-plus-square"></i><span>Add Teachers</span></a></li>

        <?php
        //only super Admin can <Manage the admins
        if ($_SESSION["admin"]["status_id"] == "4") {
        ?>
            <li class="nav-item"><a class="nav-link" href="manageAdmins.php"><i class="fas fa-pen-nib"></i><span>Manage admin</span></a></li>
        <?php
        }
        ?>

        <li class="nav-item"><a class="nav-link" href="manageOfficers.php"><i class="fas fa-pen-nib"></i><span>Manage Academic Officers</span></a></li>
        <li class="nav-item"><a class="nav-link" href="manageTeachers.php"><i class="fas fa-pen-nib"></i><span>Manage Teachers</span></a></li>
        <li class="nav-item"><a class="nav-link" href="manageStudents.php"><i class="fas fa-pen-nib"></i><span>Manage Students</span></a></li>
        <li class="nav-item"><a class="nav-link" href="studentMarks.php"><i class="fas fa-check"></i><span>Check Results</span></a></li>
        <li class="nav-item"><a class="nav-link active" href="updateProfile.php"><i class="fas fa-cog"></i><span>UpdateProfile</span></a></li>
        <li class="nav-item"><a class="nav-link active" href="../logOut.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>

    </ul>
<?php
} else {
}
?>