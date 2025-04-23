<?php

require "connection.php";

if (isset($_GET["c"])) {

    $category_id = $_GET["c"];

    $category_rs = Database::search("SELECT * FROM `category_has_brand` WHERE `category_id`='" . $category_id . "'");
    $category_num = $category_rs->num_rows;

    for ($x = 0; $x < $category_num; $x++) {

        $category_data = $category_rs->fetch_assoc();

        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `id`='" . $category_data["brand_id"] . "'");

        $brand_data = $brand_rs->fetch_assoc();

?>

        <option value="<?php echo $brand_data["id"]; ?>"><?php echo $brand_data["name"]; ?></option>

<?php

    }
}

?>