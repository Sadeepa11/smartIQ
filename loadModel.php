<?php

require "connection.php";

$brand = $_GET["b"];

$rs = Database::search("SELECT * FROM `model` INNER JOIN `brand_has_model` ON `model`.`id`=`brand_has_model`.`model_id` WHERE `brand_has_model`.`brand_id`='" . $brand . "';");
$num = $rs->num_rows;

for ($x = 0; $x < $num; $x++) {
    $data = $rs->fetch_assoc();
?>
    <option value="<?php echo ($data["id"]); ?>"><?php echo ($data["name"]); ?></option>
<?php
}
?>