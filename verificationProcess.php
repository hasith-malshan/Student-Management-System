<?php
require "connection.php";

$code = $_POST["code"];
$type = $_POST["type"];

if (empty($type)) {
    echo "Type Selection Error Please Login using Correct User Portal";
} else if ($type == "admin" || $type == "teacher" || $type == "student" || $type == "officer") {

    if (empty($code)) {
        echo "Please enter Verification Code";
    } else {
        $rs = Database::s("SELECT * FROM `" . $type . "` WHERE `vc`='" . $code . "' AND `status_id`='3' ");

        $n = $rs->num_rows;

        if ($n == 1) {
            $uid = uniqid();
            Database::iud("UPDATE `" . $type . "` SET `status_id`='1' ,`vc`='".$uid."'  WHERE `vc`='" . $code . "';");
            echo "Account Activated";
        } else {
            echo "Invalid Details Check Verification Code and Account Type OR your Account Already a active Account OR BLocked Account check in Login page";
        }
    }
} else {
    echo  "Account Type Not Detected";
}
