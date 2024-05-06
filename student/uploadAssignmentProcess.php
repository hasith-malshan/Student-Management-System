<?php

// This page is about uploading the assignment from the Student side in the beginning I have start sessions then 
//I have imported the connection.php to make the connection with database. Then I check the if it is a session belongs to the student

session_start();
require '../connection.php';

if (isset($_SESSION["student"]["id"])) {

?>
    <?php
    /*
In the beginning I have checked is there file type data from the client side then the ID and iD I storing that data in the variables named assignment and assignment ID 
then I checked if the assignment is present 
then I got the assignment type and I checked the assignment type is pDF if the assignment type is not equal to PDF 
then I send this error message to the the Blind Side in the is block I started entering data to the database
*/


    if (isset($_FILES["file"]["name"])) {
        $assignment = $_FILES["file"];
        $assignment_id = $_POST["id"];

        if (isset($assignment)) {

            $file_extension = $assignment["type"];

            if ($file_extension != "application/pdf") {
                echo "Please select only PFD files";
            } else {

                /* Then I searched a student from getting the student email using the session and checking the student if the student is active user and student has assigned grade 
Then I am checking the number of rows of the resort and if the Resorts equal one which is is the variable name of check StudentNr. */

                $checkStudent = Database::s("SELECT * FROM `student` WHERE `email`='" . $_SESSION["student"]["email"] . "' AND `status_id`='1' AND `grade_id`<>'1' ;");
                $checkStudentNr = $checkStudent->num_rows;

                if ($checkStudentNr == 1) {

                    $checkStudentData = $checkStudent->fetch_assoc();

                    //Then I add the data from the student search to a associative array then I get the grade of the student and then I get the great name 

                    $grade = Database::s("SELECT * FROM `grade` WHERE `id`='" . $_SESSION["student"]["grade_id"] . "' ");
                    $gradeData =  $grade->fetch_assoc();

                    //I  make a name for the assignment and I set the file path as Assignment/Answers 
                    //The assignment name there is a student email assignment ID and trade name
                    $new_name = "../Assignmets/Answers/" . $_SESSION["student"]["email"] . "-" . $assignment_id . "-" . $gradeData["name"] . ".pdf";

                    $fileName = $new_name;

                    //then I  get today as the the assignment submission date. 
                    $today = date("Y-m-d");

                    //Then I I check if there is a assignment already submitted 

                    $checksIfExists = Database::s("SELECT * FROM `assignment_answers` WHERE `student_id`='" . $_SESSION["student"]["id"] . "' AND `assignments_id`='" . $assignment_id . "' ;");
                    $checksIfExistsNr = $checksIfExists->num_rows;

                    if ($checksIfExistsNr == 1) {
                        move_uploaded_file($assignment["tmp_name"], $fileName);
                        echo "000";
                        //if there is a assignment already exist then upload the assignment at the same path and over it previously uploaded assignment

                    } else if ($$checksIfExistsNr->num_rows == 0) {
                        Database::iud("INSERT INTO `assignment_answers`(`file_path`,`marks`,`assignments_id`,`uploaded_date`,`student_id`) VALUES('" . $fileName . "','0','" . $assignment_id . "','" . $today . "','" . $_SESSION["student"]["id"] . "');");
                        move_uploaded_file($assignment["tmp_name"], $fileName);
                        echo "000";
                        //If there is no previously uploaded assignment then I will use the insert query and insert the data about the assignment into the assignment answer table then more the uploaded file to the file path that I mean above
                    }
                } else {
                    echo "Admin need to assign Grade and Subject For you";
                }
            }
        } else {
            echo "Please Select a note";
        }
    } else {
        echo "Please upload yourAssignment";
    }
} else {

    // Then there is some error messages. Related to the the errors that occurred in in assignment of loading then I will be inform the client using that error messages finally if there is no session belongs to the student then the user will be redirected to the index page
    ?>
    <script>
        window.location = "index.php";
    </script>
<?php
}

?>