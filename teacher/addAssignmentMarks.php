<?php
/*
This page is about at the student assignment marks by teacher 
in the beginning sessions was started then required in the connection.php then searching if there is a session belongs to teacher 
If there is a session belongs to teacher 
then I have assigned values from the client side which was send using ajax using post method
after few validations if there is no error, then teacher can upload the assignments marks into the assignment answer table
before that marks will be casted into to integer data type and there is range to the marks between 0 and 100 and the maximum length of mark should be 3 charactors 
and student id, assignment ID is mandatory to upload the assignment marks to the assignment answer table.

*/

session_start();
require '../connection.php';

if (isset($_SESSION["teacher"]["id"])) {

    $student_id = $_POST["s_id"];
    $assignment_id = $_POST["a_id"];
    $mark = $_POST["mark"];

    if (empty($student_id)) {
        echo "Student id Could not found";
    } else if (empty($assignment_id)) {
        echo "Assignment id Could not found";
    } else if (empty($mark)) {
        echo "Mark Could not found or you enterd 0";
    } else if (strlen($mark) > 3) {
        echo "Mark length Invalid";
    } else {
        $markV = (int)$mark;

        if (!is_int($markV)) {
            echo "Mark is not integer";
        } else if ($markV < 0 || $markV > 100) {
            echo "Mark is not valid Mark it shoul be between 0-100";
        } else {
            Database::iud("UPDATE `assignment_answers` SET `marks`='" . $mark . "' WHERE  `student_id`='" . $assignment_id . "' AND `assignments_id`= '" . $assignment_id . "' AND `student_id`='" . $student_id . "' ");
        }
    }
} else {

    //Redirecting the user if there is no session belongs to the teacher
?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>