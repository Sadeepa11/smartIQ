<?php
require "connection.php";

// Check if POST data is received
if ($_POST["brand"] != 0 && isset($_POST["model"])) {
    $brand = $_POST["brand"];
    $model = $_POST["model"];

    // Check if the brand already exists in the `brand` table
    $check_model = Database::search("SELECT * FROM `model` WHERE `name` = '".$model."'");
    if ($check_brand->num_rows == 0) {
        // Insert the new brand into the `brand` table
        $stmt = Database::iud("INSERT INTO `model` (`name`) VALUES ('".$model."')");
       
    }

    // Get the brand id
    $model_rs = Database::search("SELECT `id` FROM `model` WHERE `name` = '".$model."'");
    $model_data = $model_rs->fetch_assoc();
    $model_id = $model_data["id"];

    // Insert the relationship into the `category_has_brand` table
    $stmt2 = Database::iud("INSERT INTO `brand_has_model` (`brand_id`, `model_id`) VALUES ('".$brand."', '".$model_id."')");
    
    // Fetch updated brand options for the selected category
?>
    <option value="0">Select Model</option>
    <?php

    $model_rs = Database::search("SELECT * FROM `model`");
    $model_num = $model_rs->num_rows;

    for ($z = 0; $z < $model_num; $z++) {
        $model_data = $model_rs->fetch_assoc();
    ?>
        <option value="<?php echo $model_data["id"]; ?>"><?php echo $model_data["name"]; ?></option>
    <?php
    }

    


} else {
    echo ("ERROR: Missing data.");
}
?>
