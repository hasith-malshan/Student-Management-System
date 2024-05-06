<?php
session_start();

if(isset($_SESSION["admin"])){
    $_SESSION["admin"] = null;
    session_destroy();
    echo "000";
}

if(isset($_SESSION["officer"])){
    $_SESSION["officer"] = null;
    session_destroy();
    echo "000";
}

if(isset($_SESSION["teacher"])){
    $_SESSION["teacher"] = null;
    session_destroy();
    echo "000";
}

if(isset($_SESSION["student"])){
    $_SESSION["student"] = null;
    session_destroy();
    echo "000";
}
?>

<script>
    window.location = "index.php";
</script>