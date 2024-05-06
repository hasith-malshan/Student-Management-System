<?php

$username = floor(microtime(true) * 1000);
$passward =  "Pass" . str_shuffle("XY12@") . str_shuffle("78ab");


$array['username']= $username;
$array['passward']= $passward;

echo json_encode($array);
?>