<?php
session_start();
require 'connection.php';


if (isset($_SESSION["teacher"]["id"])) {
    $id = $_POST["id"];
    if (empty($id)) {
        echo "Assignment Id not Detected";
    } else {
        Database::iud("UPDATE `assignments` SET `publish_id_1`='1' WHERE `id`= '" . $id . "' ");
        echo "Assignmet Marks Published to the Academic Officers";
    }
} else if (isset($_SESSION["officer"]["id"])) {
    $id = $_POST["id"];

    if (empty($id)) {
        echo "Assignment Id not Detected";
    } else {
        Database::iud("UPDATE `assignments` SET `publish_id_2`='1' WHERE `id`= '" . $id . "' ");
        echo "Assignmets Marks Published to the Students";
    }
}
