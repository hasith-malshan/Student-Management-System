<?php
//This process is like assignment upload process. In the assignment upload page the whole process has commented and well explained
session_start();
require '../connection.php';

if(isset($_SESSION["teacher"]["id"])){

$noteName = $_POST["noteName"];
$noteDescription = $_POST["noteDescription"];

if (isset($_FILES["file"]["name"])) {
    $note = $_FILES["file"];

    if (isset($note)) {

        if (empty($noteName)) {
         echo "Add Note Name";
        }else if (empty($noteDescription)) {
            echo "Add Note Description";
        }else{

        $file_extension = $note["type"];

        if ($file_extension != "application/pdf") {
            echo "Please select only PFD files";
        } else {

            $checkTeacherS = Database::s("SELECT `teacher`.`id` AS `t_id`,`teacher`.`fname` AS `fname`, `teacher`.`lname` AS `lname`,`grade`.`name` AS `g_name`, `subject`.`name` AS `s_name`   FROM `teacher` INNER JOIN `subject` ON `teacher`.`subject_id` = `subject`.`id` INNER JOIN `grade` ON `teacher`.`grade_id`=`grade`.`id` WHERE `email`='" . $_SESSION["teacher"]["email"] . "' AND `status_id`='1' AND  `subject_id`<>'1' AND `grade_id`<>'1' ;");
            $checkTeacherNr = $checkTeacherS->num_rows;

            if ($checkTeacherNr == 1) {

                $checkTeacherData = $checkTeacherS->fetch_assoc();
                $grade = $checkTeacherData["g_name"];
                $subject = $checkTeacherData["s_name"];

                $new_name = "../Notes/" . $_SESSION["teacher"]["fname"] ."-".$_SESSION["teacher"]["fname"] ."-".$grade."-".$subject. ".pdf";

                $fileName = $new_name;

                Database::iud("INSERT INTO `notes`(`name`,`note`,`teacher_id`,`file_path`) VALUES('" . $noteName . "','".$noteDescription."','" . $_SESSION["teacher"]["id"] . "','".$new_name."');");

                move_uploaded_file($note["tmp_name"], $fileName);

                echo "000";

            } else {
                echo "Admin need to assign Grade and Subject For you";
            }
        }
    }
    } else {
        echo "Please Select a note";
    }
}else {
    echo "Please Select a note and Fill Details about the note";
}
}else{

}