<?php
//This page is about this sidebar which is on the side of the web page
if(isset($_SESSION["teacher"]["id"])){

?>
<ul class="navbar-nav text-light" id="accordionSidebar">
<li class="nav-item"><a class="nav-link" href="teacher.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
<li class="nav-item"><a class="nav-link" href="addNote.php"><i class="fa fa-plus-square"></i><span>Add Notes</span></a></li>
<li class="nav-item"><a class="nav-link" href="addAssignment.php"><i class="fas fa-pen-nib"></i><span>Add Assignemts</span></a></li>
<li class="nav-item"><a class="nav-link active" href="assignmentMark.php"><i class="fas fa-cog"></i><span>Check Student Marks</span></a></li>
<li class="nav-item"><a class="nav-link active" href="updateProfile.php"><i class="fas fa-cog"></i><span>UpdateProfile</span></a></li>
<li class="nav-item"><a class="nav-link active" href="../logOut.php"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>

</ul>
<?php
}else{
 ?>
 <script>
    window.location = "index.php";
 </script>
 <?php   
}

?>