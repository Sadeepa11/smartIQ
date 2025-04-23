<?php
session_start();

require "connection.php";

if(isset($_SESSION["u"])){
    if(isset($_GET["id"])){
        $pid = $_GET["id"];
        $umail = $_SESSION["u"]["email"];

        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='".$pid."' AND `user_email`='".$umail."'");
        $cart_num= $cart_rs->num_rows;

        $product_rs =  Database::search("SELECT * FROM `product` WHERE `id`='".$pid."'");
        $product_data =  $product_rs->fetch_assoc();

        $product_qty = $product_data["qty"];

        if($cart_num == 1){
            $cart_data= $cart_rs->fetch_assoc();
            $current_qty = $cart_data["qty"];
            $new_qty = (int)$current_qty + 1;

            if($current_qty <= $new_qty){
                Database::iud("UPDATE `cart` SET `qty`='".$new_qty."' WHERE `product_id`='".$pid."' AND `user_email`= '".$umail."'");
                echo("Update Finished");
            }else{
                echo("invalid Quantity");
            }
        }else{

            Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`qty`)VALUES('".$pid."','".$umail."','1')");
            echo("New Product Added to Cart");

        }


       
    }else{
        echo("Something Went Wrong");
    }
    
}else{
    echo("Please Log In or Sign Up");
}
?>