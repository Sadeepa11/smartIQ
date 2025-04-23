<?php

require "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["m"];
$condition = $_POST["con"];
$colour = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["to"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if($sort == 0){

    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%'";
        $status = 1;
    }

    if($category != 0 && $status == 0){
        $query .= " WHERE `category_id`='".$category."'";
        $status = 1;
    }else if($category != 0 && $status != 0){
        $query .= " AND `category_id`='".$category."'";
    }

    $pid = 0;
    if($brand != 0 && $model == 0){
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='".$brand."'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for($x = 0;$x < $brand_has_model_num;$x++){
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `brand_has_model_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `brand_has_model_id`='".$pid."'";
        }
    }

    if($brand == 0 && $model != 0){
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `model_id`='".$model."'");
        $brand_has_model = $brand_has_model_rs->num_rows;
        for($x = 0;$x < $brand_has_model_num;$x++){
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `brand_has_model_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `brand_has_model_id`='".$pid."'";
        }
    }

    if($brand != 0 && $model != 0){
        $brand_has_model_rs = Database::search("SELECT * FROM `brand_has_model` WHERE `brand_id`='".$brand."' 
        AND `model_id`='".$model."'");
        $brand_has_model_num = $brand_has_model_rs->num_rows;
        for($x = 0;$x < $brand_has_model_num;$x++){
            $brand_has_model_data = $brand_has_model_rs->fetch_assoc();
            $pid = $brand_has_model_data["id"];
        }

        if($status == 0){
            $query .= "WHERE `brand_has_model_id`= '".$pid."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `brand_has_model_id`='".$pid."'";
        }
    }

    if($condition != 0 && $status == 0){
        $query .= "WHERE `condition_id`='".$condition."'";
        $status = 1;
    }else if($condition != 0 && $status != 0){
        $query .= "AND `condition_id`='".$condition."'";
    }

    if($colour != 0 && $status == 0){
        $query .= "WHERE `colour_id`='".$colour."'";
        $status = 1;
    }else if($colour != 0 && $status != 0){
        $query .= "AND `colour_id`='".$colour."'";
    }

    if(!empty($price_from) && empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` >= '".$price_from."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` >= '".$price_from."'";
        }
    }else if(empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` <= '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` <= '".$price_to."'";
        }
    }else if(!empty($price_from) && !empty($price_to)){
        if($status == 0){
            $query .= "WHERE `price` BETWEEN '".$price_from."' AND '".$price_to."'";
            $status = 1;
        }else if($status != 0){
            $query .= "AND `price` BETWEEN '".$price_from."' AND '".$price_to."'";
        }
    }
    
}else if($sort == 1){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` ASC";
        $status = 1;
    }
}else if($sort == 2){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `price` DESC";
        $status = 1;
    }
}else if($sort == 3){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` ASC";
        $status = 1;
    }
}else if($sort == 4){
    if(!empty($search_txt)){
        $query .= " WHERE `title` LIKE '%".$search_txt."%' ORDER BY `qty` DESC";
        $status = 1;
    }
}

if ($_POST["page"] != "0") {

    $pageno = $_POST["page"];
} else {

    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$viewed_results_count = ((int)$pageno - 1) * $results_per_page;

$query .= " LIMIT " . $results_per_page . " OFFSET " . $viewed_results_count . "";
$results_rs = Database::search($query);
$results_num = $results_rs->num_rows;

while ($results_data = $results_rs->fetch_assoc()) {
?>

    <div class="card mb-3 mt-3 col-12 col-lg-6">
        <div class="row">

            <div class="col-md-4 mt-4">

                <img src="resource/mobile_images/iphone12.jpg" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">

                    <h5 class="card-title fw-bold"><?php echo $results_data["title"]; ?></h5>
                    <span class="card-text text-primary fw-bold"><?php echo $results_data["price"]; ?></span>
                    <br />
                    <span class="card-text text-success fw-bold fs">10 Items Left</span>

                    <div class="row">
                        <div class="col-12">

                            <div class="row g-1">
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="#" class="btn btn-success fs">Buy Now</a>
                                </div>
                                <div class="col-12 col-lg-6 d-grid">
                                    <a href="#" class="btn btn-danger fs">Add Cart</a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php
}

?>



<div class="offset-lg-4 col-12 col-lg-4 mb-3 text-center">
    <div class="row">

        <div class="pagination">
            <a <?php if ($pageno <= 1) {
                    echo "#";
                } else {
                ?> onclick="advancedSearch('<?php echo ($pageno - 1); ?>')" <?php
                                                                        } ?>>&laquo;</a>

            <?php

            for ($page = 1; $page <= $number_of_pages; $page++) {

                if ($page == $pageno) {

            ?>
                    <a onclick="advancedSearch('<?php echo ($page); ?>')" class="active">
                        <?php echo $page; ?>
                    </a>
            <?php

                }else{

                    ?>
                    <a onclick="advancedSearch('<?php echo ($page); ?>')">
                        <?php echo $page; ?>
                    </a>
            <?php

                }
            }

            ?>

            <a <?php if ($pageno >= $number_of_pages) {
                    echo "#";
                } else {
                ?> onclick="advancedSearch('<?php echo ($pageno + 1); ?>')" <?php
                                                                        } ?>>&raquo;</a>
        </div>

    </div>
</div>