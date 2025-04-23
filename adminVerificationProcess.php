<?php

require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST["e"])){
    $email = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='".$email."'");
    $admin_num = $admin_rs->num_rows;

    if(1 > 0){

        $code = uniqid();

        Database::iud("UPDATE `admin` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sadeepasrirohanasinghe2@gmail.com';
            $mail->Password = 'dgrrfxryvhzxscob';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('sadeepasrirohanasinghe2@gmail.com', 'Admin Verification');
            $mail->addReplyTo('sadeepasrirohanasinghe2@gmail.com', 'Admin Verification');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'SmartIQ Admin Login Verification Code';
            $bodyContent = '<h1 style="color:blue;">Your verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

    }else{
        echo ("You are not a valid user");
    }

}else{
    echo ("Email field should not be empty.");
}

?>