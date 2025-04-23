<?php

session_start();
require "connection.php";



$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["clr"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];
// $image = $_FILES["image"];

if($category == "0"){
    echo ("Please select a Category");
}else if($brand == "0"){
    echo ("Please select a Brand");
}else if($model == "0"){
    echo ("Please select a Model");
}else if(empty($title)){
    echo ("Please add the Title");
}else if(strlen($title) >= 100){
    echo ("Title should have less than 100 characters");
}else if ($condition == "0"){
    echo ("Please select a Condition");
}else if ($clr == "0"){
    echo ("Please select a Colour");
}else if(empty($qty)){
    echo ("Please add the Quantity");
}else if($qty == "0" | $qty == "e" | $qty < 0){
    echo ("Invalid value for field Quantity");
}else if(empty($cost)){
    echo ("Please add the Cost");
}else if(!is_numeric($cost)){
    echo ("Invalid value for field Cost Per Item");
}else if(empty($dwc)){
    echo ("Please add the Cost for Delivery inside Colombo");
}else if(!is_numeric($dwc)){
    echo ("Invalid value for field Delivery cost within Colombo");
}else if(empty($doc)){
    echo ("Please add the Cost for Delivery outside Colombo");
}else if(!is_numeric($doc)){
    echo ("Invalid value for field Delivery cost out of Colombo");
}else if(empty($desc)){
    echo ("Please add the Description");
}else{
    
$mhb_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id` = '".$brand."' AND `model_id` = '".$model."'");

$brand_has_model_id;


if($mhb_rs->num_rows > 0){

    $mhb_data = $mhb_rs->fetch_assoc();
    $brand_has_model_id = $mhb_data["id"];


}else{
    Database::iud("INSERT INTO `brand_has_model`(`model_id`,`brand_id`) VALUES ('".$model."','".$brand."')");
    $brand_has_model_id = Database::$connection->insert_id;

    echo($brand_has_model_id);
}

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

Database::iud("INSERT INTO `product` (`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,
    `delivery_fee_other`,`category_id`,`brand_has_model_id`,`colour_id`,`status_id`,`condition_id`) 
    VALUES ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$dwc."','".$doc."','".$category."',
    '".$brand_has_model_id."','".$clr."','".$status."','".$condition."')");
echo ("Product Added Successfully.");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);

    if($length <= 3 && $length > 0){

        $allowed_image_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml","image/webp");

        for($x = 0;$x < $length;$x++){
            if(isset($_FILES["image".$x])){

                $image_file = $_FILES["image".$x];
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
                    }else if($file_extention =="image/webp"){
                        $new_img_extention = ".webp";
                    }

                    $file_name = "resource//mobile_images//".$title."_".$x."_".uniqid().$new_img_extention;
                    move_uploaded_file($image_file["tmp_name"],$file_name);

                    Database::iud("INSERT INTO `image`(`code`,`product_id`) VALUES ('".$file_name."','".$product_id."')");
                    
                }else{
                    echo ("Not an allowed image type");
                }

            }
        }

        echo ("Product images saved successfully");

    }else{
        echo ("Invalid Image Count");
    }

}

?>