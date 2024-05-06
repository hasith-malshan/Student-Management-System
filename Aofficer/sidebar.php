<?php
//checking wheather if there is  session belongs to officer
if(isset($_SESSION["officer"]["id"])){

?>
<?php


?>
<ul class="navbar-nav text-light" id="accordionSidebar">
<li class="nav-item"><a class="nav-link" href="officer.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
<li class="nav-item"><a class="nav-link" href="addStudents.php"><i class="fas fa-pen-nib"></i><span>add Students </span></a></li>
<li class="nav-item"><a class="nav-link" href="studentMarks.php"><i class="fas fa-pen-nib"></i><span>Check Results</span></a></li>
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