<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
require '../connection.php';

$email = $_POST["email"];
$type = $_POST["type"];

if (empty($email)) {
    echo "NO Email found in Invitation Process. Account has been created Somwthing went Wrong on your side. Invitation Failed";
} else if (empty($type)) {
    echo "NO type found in Invitation Process. Account has been created Somwthing went Wrong on your side. Invitation Failed";
}else{

    $rs = Database::s("SELECT * FROM `".$type."` WHERE `email`= '".$email."' ");


    if($rs->num_rows == 1){

        $dataset = $rs->fetch_assoc();
        $vs = $dataset["vc"];

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'lms.email.2022@gmail.com';
        $mail->Password = 'qtyvunafbvbikrle';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('lms.email.2022@gmail.com', 'Admin');
        $mail->addReplyTo('lms.email.2022@gmail.com', 'Admin');
        $mail->addAddress('hasher22542@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = 'LMS Sign Verification';
        $bodyContent = '<h1>LMS Verification</h1>';
        $bodyContent .= '<p>Verification Code :'.$dataset["vc"].' </p>';
        $bodyContent .= '<p>Account Type :'.$type.' </p>';
        $bodyContent .= '<p>Username :'.$dataset["username"].' </p>';
        $bodyContent .= '<p>Passward :'.$dataset["passward"].' </p>';
        $bodyContent .= '<p>Visit our LMS and Select Account Type and then Verify</p>';
        $mail->Body    = $bodyContent;
        
        if (!$mail->send()) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
        }

    }


}


