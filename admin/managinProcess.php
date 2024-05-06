<?php
//this page is used to update the status, grade, and the suubject of our main actors. 

session_start();
//starting sessions
require '../connection.php';
//importing the connection.php because the all functions related to the databse connction and query execuution is in that page


if (isset($_SESSION["admin"]["id"])) {
    // checking if there is session belongs to admin because thi page can access only to admin
?>

<?php

    $type  = $_POST["type"];
    // getting type from client side as a post request
    $id  = $_POST["id"];
    // getting id from client side as a post request

    $status  = $_POST["status"];
    // getting ststus from client side as a post request

    // the above results will be send buy client to change the data of the all 4 student,admin,officer, and teache


    if (empty($type)) {
        //checking the type is set if it is not then display a error messege
        echo "Type Selecting Error";
    } else if ($type == "admin") {
        //f the type ois admin these conditions will apply and then tthe details of  the adin will be changed
        if (empty($id)) {
            //checking id is present and not empty
            echo "admin id not detected";
        } else if (empty($status)) {
            //cheking ststus is present and not empty id oit is empty then this code will be diliver a error messege to the client side
            echo "admin status note detected";
        } else {
            // if all the neccessary details are present then the admin details canbe updated. 
            Database::iud("UPDATE `admin` SET `status_id`='" . $status . "' WHERE `id`='" . $id . "' ");
            echo "000";
        }
    } else if ($type == "officer") {
        //f the type ois admin these conditions will apply and then tthe details of  the adin will be changed

        if (empty($id)) {
            echo "officer id not detected";
            //check is the id of the is present. if it is not then display a error messege

        } else if (empty($status)) {
            echo "officer status note detected";
            //check is the ststus of the is present. if it is not then display a error messehe

        } else {
            // if all the neccessary details are present then the officer details canbe updated. 

            Database::iud("UPDATE `officer` SET `status_id`='" . $status . "' WHERE `id`='" . $id . "' ");
            echo "000";
        }
    } else if ($type == "teacher") {
        //this is the section belongs to the teacher
        $grade  = $_POST["grade"];
        //if the type equals to the teacher then the grade from the request will be assigned in tothe grade variable
        $subject  = $_POST["subject"];
        //if the type equals to the teacher then the subject from the request will be assigned in tothe grade variable


        if (empty($id)) {
            // checkig the id is present and if it is not display the error messege
            echo "teacher id not detected";
        } else if (empty($status)) {
            // checking wheather if there is  ststus of the teacher
            echo "teacher status note detected";
        } else if (empty($grade)) {
            // checking wheather if there is  grade of the teacher
            echo "teacher grade not detected";
        } else if (empty($subject)) {
            // checking wheather if there is  subject of the teacher
            echo "teacher subject not detected";
        } else {
            // if all the neccessary details are present then the teacher details canbe updated. 
            Database::iud("UPDATE `teacher` SET `status_id`='" . $status . "',`grade_id`='" . $grade . "',`subject_id`='" . $subject . "' WHERE `id`='" . $id . "' ");
            echo "000";
        }
    } else if ($type == "student") {
        // thgis is the sectionn belongs to the student
        $grade  = $_POST["grade"];

        if (empty($id)) {
            // checkig the id is present and if it is not display the error messege
            echo "student id not detected";
        } else if (empty($status)) {
            // checking wheather if there is  ststus of the teacher or if it is not then error messege will be displayed
            echo "student status note detected";
        } else if (empty($grade)) {
            // checking wheather if there is  grade of the teacher or if it is not then error messege will be displayed
            echo "Student grade not detected";
        } else {
            // if all the neccessary details are present then the teacher details canbe updated. 
            Database::iud("UPDATE `student` SET `status_id`='" . $status . "',`grade_id`='" . $grade . "' WHERE `id`='" . $id . "' ");
            echo "000";
        }
    }
} else {
}
