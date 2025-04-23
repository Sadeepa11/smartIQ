<?php

$cat = $_POST["cat"];

require "connection.php";

// Category insert query
Database::iud("INSERT INTO `category`(`name`) VALUES ('" . $cat . "')");

// Display categories
?>
<option value="0">Select Category</option>
<?php
$category_rs = Database::search("SELECT * FROM `category`");
$category_num = $category_rs->num_rows;

for ($x = 0; $x < $category_num; $x++) {
    $category_data = $category_rs->fetch_assoc();
?>
    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
<?php
}
?>
