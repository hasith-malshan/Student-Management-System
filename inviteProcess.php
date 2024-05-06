<?php


require "connection.php";

$email =  $_POST["email"];
$username =  $_POST["username"];
$passward =  $_POST["passward"];
$type =  $_POST["type"];

if (isset($type)) {
    if (empty($email)) {
        echo "Enter Email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid Email Format";
    } else if (strlen($email) > 100) {
        echo "Charactor limit for Email is 100";
    } else if (empty($username)) {
        echo "Enter username";
    } else if (empty($passward)) {
        echo "enter Passward";
    } else {


        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");


        if ($type == "officer") {
            $uid = uniqid();
            $r = Database::s("SELECT * from `officer` where `email`='" . $email . "' ");
            if ($r->num_rows > 0) {
                echo "This Email is Already regestered";
            } else {

                Database::iud("INSERT INTO `officer`(`email`,`username`,`passward`,`vc`,`status_id`,`fname`,`lname`,`reg_date`,`c_num`) VALUES ('" . $email . "','" . $username . "','" . $passward . "','" . $uid . "',3,'1','1','" . $date . "','1');");

                $array['email'] = $email;
                $array['type'] = "officer";
                echo json_encode($array);
            }
        } else  if ($type == "teacher") {

            $r = Database::s("SELECT * from `teacher` where `email`='" . $email . "' ");
            if ($r->num_rows > 0) {
                echo "This Email is Already regestered";
            } else {
                $uid = uniqid();

                Database::iud("INSERT INTO `teacher`(`email`,`username`,`passward`,`vc`,`status_id`,`grade_id`,`subject_id`,`fname`,`lname`,`reg_date`,`c_num`) VALUES ('" . $email . "','" . $username . "','" . $passward . "','" . $uid . "',3,1,1,'1','1','" . $date . "','1');");
              
                $array['email'] = $email;
                $array['type'] = "teacher";
                echo json_encode($array);

            }
        } else  if ($type == "student") {

            $r = Database::s("SELECT * from `student` where `email`='" . $email . "' ");
            if ($r->num_rows > 0) {
                echo "This Email is Already regestered";
            } else {
                $uid = uniqid();
                Database::iud("INSERT INTO `student`(`email`,`username`,`passward`,`vc`,`status_id`,`grade_id`,`fname`,`lname`,`reg_date`,`c_num`) VALUES ('" . $email . "','" . $username . "','" . $passward . "','" . $uid . "',3,1,1,'1','1','" . $date . "','1');");
               
                $array['email'] = $email;
                $array['type'] = "student";
                echo json_encode($array);
            }
        }
    }
} else {
    echo "Account Type NOT Detected";
}
