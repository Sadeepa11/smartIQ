<?php
require "connection.php";

// Check if POST data is received
if (isset($_POST["brand"]) && $_POST["cat"] != 0 ) {
    $brand = $_POST["brand"];
    $cat = $_POST["cat"];

    // Check if the brand already exists in the `brand` table
    $check_brand = Database::search("SELECT * FROM `brand` WHERE `name` = '".$brand."'");
    if ($check_brand->num_rows == 0) {
        // Insert the new brand into the `brand` table
        $stmt = Database::iud("INSERT INTO `brand` (`name`) VALUES ('".$brand."')");
       
    }

    // Get the brand id
    $brand_rs = Database::search("SELECT `id` FROM `brand` WHERE `name` = '".$brand."'");
    $brand_data = $brand_rs->fetch_assoc();
    $brand_id = $brand_data["id"];

    // Insert the relationship into the `category_has_brand` table
    $stmt2 = Database::iud("INSERT INTO `category_has_brand` (`category_id`, `brand_id`) VALUES ('".$cat."', '".$brand_id."')");
    
    // Fetch updated brand options for the selected category

    ?>
    <option value="0">Select Brand</option>
    <?php

    $brand_rs = Database::search("SELECT * FROM `brand`");
    $brand_num = $brand_rs->num_rows;

    for ($x = 0; $x < $brand_num; $x++) {
        $brand_data = $brand_rs->fetch_assoc();

    ?>

        <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>

    <?php
    }


} else {
    echo ("ERROR: Missing data.");
}
?>
