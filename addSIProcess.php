<?php


require "connection.php";





    $length = sizeof($_FILES);


    Database::iud("DELETE FROM `banners`");

    if($length <= 3 && $length > 0){

        $allowed_image_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");

        for($x = 0;$x < $length;$x++){
            if(isset($_FILES["simage".$x])){

                $image_file = $_FILES["simage".$x];
                $file_extention = $image_file["type"];

                if(in_array($file_extention,$allowed_image_extentions)){

                    $new_img_extention;

                    if($file_extention =="image/jpg"){
                        $new_img_extention = ".jpg";
                    }else if($file_extention =="image/jpeg"){
                        $new_img_extention = ".jpeg";
                    }else if($file_extention =="image/png"){
                        $new_img_extention = ".png";
                    }else if($file_extention =="image/svg+xml"){
                        $new_img_extention = ".svg";
                    }

                    $file_name = "resource//slider_images//_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($image_file["tmp_name"],$file_name);

                   


                    Database::iud("INSERT INTO `banners`(`url`) VALUES ('".$file_name."')");
                    
                }else{
                    echo ("Not an allowed image type");
                }

            }
        }

        echo ("Product images saved successfully");

    }else{
        echo ("Invalid Image Count");
    }



?>