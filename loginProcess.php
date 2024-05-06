<?php

session_start();
require "connection.php";

$username = $_POST["username"];
$passward = $_POST["passward"];
$remember = $_POST["remember"];
$type = $_POST["type"];


if (empty($type)) {
    $array['msg'] =  "Type Selection Error Please Login using Correct User Portal";
    echo json_encode($array);
} else if ($type == "admin" || $type == "teacher" || $type == "student" || $type == "officer") {

    if (empty($username)) {
        $array['msg'] = "Please enter username to sign in";
        echo json_encode($array);

    } else if (empty($passward)) {
        $array['msg'] = "Please Enter Your Password";
        echo json_encode($array);

    } else {

        $rs = Database::s("SELECT * FROM `" . $type . "` WHERE `username`='" . $username . "' AND `passward`='" . $passward . "' ;");

        //echo $type;

        $n = $rs->num_rows;

        if ($n == 1) {

            $rsData = $rs->fetch_assoc();

       
         if ($rsData["status_id"] == "1" || $rsData["status_id"] == "4" ) {

                $_SESSION["$type"] = $rsData;

                $array['type'] = $type;
                $array['msg'] = "000";
                echo json_encode($array);

                if ($remember == "true") {
                    setcookie("username".$type, $username, time() + (60 * 60 * 24 * 365));
                    setcookie("passward".$type, $passward, time() + (60 * 60 * 24 * 365));
                } else {
                    setcookie("username".$type, "", -1);
                    setcookie("passward".$type, "", -1);
                }
            } else {

                $array['msg'] = "00X";
                echo json_encode($array);
            }
        } else {
            $array['msg'] = "Invalid Details Check account details and Account Type ";
            echo json_encode($array);

           
        }
    }
} else {
    $array['msg'] = "Account Type Not Detected";
    echo json_encode($array);

   
}
