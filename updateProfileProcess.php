<?php
session_start();
require "connection.php";

if (isset($_SESSION["admin"]["id"]) or isset($_SESSION["officer"]["id"]) or isset($_SESSION["student"]["id"]) or isset($_SESSION["teacher"]["id"])) {


    $type = $_POST["type"];
    if (empty($type)) {
        echo "Type Not Detected";
    } else {

        if (isset($_SESSION[$type])) {

            $username = $_POST["username"];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $c_num = $_POST["c_num"];

            $image;

            if (empty($username)) {
                echo "Please enter  Username";
            } else if (strlen($username) < 6) {
                echo "Select username with at lease 6 charactors";
            } else if (strlen($username) > 44) {
                echo "Charactor limit for Username is 44";
            } else if (empty($fname)) {
                echo "Please enter First your name";
            } else if (strlen($fname) > 44) {
                echo "Charactor limit for first name is 44";
            } else if (empty($lname)) {
                echo "Please enter Last your name";
            } else if (strlen($lname) > 44) {
                echo "Charactor limit for last name is 44";
            } else if (empty($c_num)) {
                echo "Please Enter Your Mobile number";
            } else if (strlen($c_num) != 10) {
                echo "Please Check mobile number";
            } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $c_num) == 0) {
                echo "Invalid Mobile number";
            } else {

                $userDetails = Database::s("SELECT * FROM `" . $type . "` WHERE `username`='" . $username . "' AND `email`<>'" . $_SESSION[$type]["email"] . "';");

                if ($userDetails->num_rows == 1) {
                    echo "your username has already used buy a user";
                } else {

                    if ($type == 'admin') {
                        Database::iud("UPDATE `" . $type . "` SET `username`= '" . $username . "',`c_num`='" . $c_num . "' WHERE `email`='" . $_SESSION[$type]["email"] . "' ;");
                    } else {
                        Database::iud("UPDATE `" . $type . "` SET `username`= '" . $username . "',`fname`='" . $fname . "',`lname`='" . $lname . "',`c_num`='" . $c_num . "' WHERE `email`='" . $_SESSION[$type]["email"] . "' ;");
                    }

                    $userDetails = Database::s("SELECT * FROM `" . $type . "` WHERE `email`='" . $_SESSION[$type]["email"] . "';");
                    $userDetailsD = $userDetails->fetch_assoc();
                    $_SESSION[$type] =  $userDetailsD;

                    echo $type;
                }


                if (isset($_FILES["image"]["name"])) {
                    echo "update with Image";
                    $img = $_FILES["image"];

                    $allowed_image_extention  = array("image/jpg", "image/png", "image/svg", "image/jpeg");

                    if (isset($img)) {
                        $file_extension = $img["type"];
                        //echo $file_extension;

                        if (!in_array($file_extension, $allowed_image_extention)) {
                            echo "Please select a Valid image";
                        } else {

                            $new_name = "ProfileImg/" . $_SESSION[$type]["email"] . "-" . $type . "-" . uniqid() . ".png";

                            Database::iud("UPDATE `" . $type . "` SET `file_path`='" . $new_name . "' WHERE `email`='" . $_SESSION[$type]["email"] . "';");

                            move_uploaded_file($img["tmp_name"], $new_name);
                            $userDetails = Database::s("SELECT * FROM `" . $type . "` WHERE `email`='" . $_SESSION[$type]["email"] . "';");
                            $userDetailsD = $userDetails->fetch_assoc();
                            $_SESSION[$type] =  $userDetailsD;
                            echo "001";
                        }
                    } else {
                        echo "Please Select an image";
                    }
                }
            }
        } else {
            echo "00X";
        }
    }
} else {
  ?>
  
  <script>
    window.location = "index.php"
  </script>
  <?php
}
