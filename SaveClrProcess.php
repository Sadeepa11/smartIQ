<?php
require "connection.php";

// Check if POST data is received
if ($_POST["clr"] ) {
    $clr = $_POST["clr"];
    
    // Check if the brand already exists in the `brand` table
    $check_clr = Database::search("SELECT * FROM `colour` WHERE `name` = '".$clr."'");
    if ($check_clr->num_rows == 0) {
        // Insert the new brand into the `brand` table
        $stmt = Database::iud("INSERT INTO `colour` (`name`) VALUES ('".$clr."')");
       
    }

    // Get the brand id
   

    // Insert the relationship into the `category_has_brand` table

    
    // Fetch updated brand options for the selected category
?>
    <option value="0">Select Colour</option>
    <?php

    $clr2_rs = Database::search("SELECT * FROM `colour`");
    $clr2_num = $clr2_rs->num_rows;

    for ($z = 0; $z < $clr2_num; $z++) {
        $clr2_data = $clr2_rs->fetch_assoc();
    ?>
        <option value="<?php echo $clr2_data["id"]; ?>"><?php echo $clr2_data["name"]; ?></option>
    <?php
    }

    


} else {
    echo ("ERROR: Missing data.");
}
?>
