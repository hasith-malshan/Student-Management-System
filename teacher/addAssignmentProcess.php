<?php

 
//In the beginning sessions have started then imported the connection is not PHP to make the connection and use the things with SQL queries then I have to check if there is a sessions belong to teacher 


session_start();
require '../connection.php';

if (isset($_SESSION["teacher"]["id"])) {

?>
    <?php

    //Then I have a sign the values that came from the client side using a by using the post method in two variables. 

    $assignmentName = $_POST["assignmentName"];
    $assignmentDescription = $_POST["assignmentDescription"];
    $assignmentDate = $_POST["assignmentDate"];


    //Then after few validations I have check ok this file type of the assignment is PDF. If the file type is PDF then uploading can be done. 
    if (isset($_FILES["file"]["name"])) {
        $assignment = $_FILES["file"];

        //The validation are checking if there is a segment as a file is there a description about assignment and if there is a date and the  assignment file type should be pDF

        if (isset($assignment)) {

            if (empty($assignmentName)) {
                echo "Add Assignment Name";
            } else if (empty($assignmentDescription)) {
                echo "Add assignment Description";
            } else if (empty($assignmentDate)) {
                echo "Add assignment end Date";
            } else {

                $file_extension = $assignment["type"];

                if ($file_extension != "application/pdf") {
                    echo "Please select only PFD files";
                } else {

                    //To upload the assignment the system checks for the teacher details and which subject the teacher teach and what is the rate of the teacher 

                    $checkTeacherS = Database::s("SELECT `teacher`.`id` AS `t_id`,`teacher`.`fname` AS `fname`, `teacher`.`lname` AS `lname`,`grade`.`name` AS `g_name`, `subject`.`id` AS `s_id`,`subject`.`name` AS `s_name`   FROM `teacher` INNER JOIN `subject` ON `teacher`.`subject_id` = `subject`.`id` INNER JOIN `grade` ON `teacher`.`grade_id`=`grade`.`id` WHERE `email`='" . $_SESSION["teacher"]["email"] . "' AND `status_id`='1' AND  `subject_id`<>'1' AND `grade_id`<>'1' ;");
                    $checkTeacherNr = $checkTeacherS->num_rows;

                    if ($checkTeacherNr == 1) {

                        //Then if there is result set about the teacher the filename and the file path will be created using teacher details then there will be a unique ID for the assignment and assignment upload date is is named as today then we can upload the data about assignment to the assignment table assignment file which is a PDF will be uploaded to the file path that we created .

                        $checkTeacherData = $checkTeacherS->fetch_assoc();
                        $grade = $checkTeacherData["g_name"];
                        $subject = $checkTeacherData["s_name"];
                        $subject_id = $checkTeacherData["s_id"];


                        $new_name = "../Assignmets/" . $_SESSION["teacher"]["fname"] . "-" . $_SESSION["teacher"]["fname"] . "-" . $grade . "-" . $subject . ".pdf";

                        $fileName = $new_name;

                        $uid = uniqid();

                        $today = date("Y-m-d");



                        Database::iud("INSERT INTO `assignments`(`name`,`note`,`teacher_id`,`uid`,`start_date`,`end_date`,`status_id`,`file_path`,`grade_id`,`subject_id`) VALUES('" . $assignmentName . "','" . $assignmentDescription . "','" . $_SESSION["teacher"]["id"] . "','" . $uid . "','" . $today . "','" . $assignmentDate . "','1','" . $new_name . "','" . $_SESSION["teacher"]["grade_id"] . "','" . $_SESSION["teacher"]["subject_id"] . "');");

                        move_uploaded_file($assignment["tmp_name"], $fileName);

                        echo "000";
                        //Then we can see error messages related to that occurs from the client side after errors occurred the system will notify the teacher the errors
                    } else {
                        echo "Admin need to assign Grade and Subject For you";
                    }
                }
            }
        } else {
            echo "Please Select a note";
        }
    } else {
        echo "Please Select a note and Fill Details about the Assignment";
    }
} else {
    ?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>