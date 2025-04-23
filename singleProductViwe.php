<?php

require "connection.php";



if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,product.title,
    product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,product.category_id,
    product.brand_has_model_id,product.condition_id,product.status_id,product.user_email,product.colour_id,
    model.name AS mname,brand.name AS bname FROM `product` INNER JOIN `brand_has_model` ON 
    brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON brand.id=brand_has_model.brand_id 
    INNER JOIN `model` ON model.id=brand_has_model.model_id WHERE product.id='" . $pid . "'");




    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | SmartIQ</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resource/logo.jpg" />
        </head>

        <body>

            <div class="container-fluid">
                <div class="row">
                    <?php include "header.php"; ?>

                    <div class="col-12 mt-0 bg-white singleProduct">
                        <div class="row">
                            <div class="col-12" style="padding: 10px;">
                                <div class="row">

                                    <div class="col-12 col-lg-2 order-2 order-lg-1">
                                        <ul>

                                            <?php

                                            $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {

                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["code"];
                                            ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                        <img src="<?php echo $img[$x]; ?>" class="img-thumbnail mt-1 mb-1" style="height: 200px;" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);" />
                                                    </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                    <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                </li>
                                            <?php
                                            }

                                            ?>


                                        </ul>
                                    </div>

                                    <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                        <div class="row">
                                            <div class="col-12 align-items-center border border-1 
                                border-secondary">
                                                <div class="mainImg" id="mainImg"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-6 order-3">
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="row border-bottom border-dark">
                                                    <nav aria-label="breadcrumb">
                                                        <ol class="breadcrumb">
                                                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                                            <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                                                        </ol>
                                                    </nav>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 fw-bold text-success"><?php echo $product_data["title"]; ?></span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="badge">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>

                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews and Ratings</label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <?php

                                                $price = $product_data["price"];
                                                $adding_price = ($price / 100) * 5;
                                                $new_price = $price - $adding_price;
                                                $difference = $new_price - $price;
                                                $percentage = ($difference / $price) * 100;

                                                ?>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-4 text-dark fw-bold">Rs. <?php echo $price; ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 text-danger fw-bold">Rs. <?php echo $new_price; ?> .00</span>
                                                        &nbsp;&nbsp; | &nbsp;&nbsp;
                                                        <span class="fs-4 fw-bold text-black-50">Save Rs. <?php echo $difference; ?> .00 (<?php echo $percentage; ?>%)</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <span class="fs-5 text-primary"><b>Warrenty : </b>6 Months Warrenty</span><br />
                                                        <span class="fs-5 text-primary"><b>Return Policy : </b>1 Months Return Policy</span><br />
                                                        <span class="fs-5 text-primary"><b>In Stock : </b>10 Items Available</span>
                                                    </div>
                                                </div>

                                                <div class="row border-bottom border-dark">
                                                    <div class="col-12 my-2">
                                                        <div class="row g-2">
                                                            <!-- <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary"><b>Seller : </b><?php echo $_SESSION["u"]["fname"] ?> <?php echo  $_SESSION["u"]["lname"] ?></span>
                                                            </div> -->
                                                            <div class="col-12 col-lg-6 border border-1 border-dark text-center">
                                                                <span class="fs-5 text-primary"><b>Sold : </b>100 Items</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-2 border-danger rounded">
                                                                <div class="row">
                                                                    <div class="col-3 col-lg-2 border-end border-2 border-danger">
                                                                        <img src="resource/pricetag.png" />
                                                                    </div>
                                                                    <div class="col-9 col-lg-10">
                                                                        <span class="fs-5 text-danger fw-bold">
                                                                            Stand a chance to get 5% discount by using VISA or MASTER
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-12 my-2">
                                                                <div class="row g-2">

                                                                    <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative ">
                                                                        <div class="col-12 product-qty">
                                                                            <div class="  row">
                                                                                <span class=" col-3 mt-1 position-absolute">Quantity : </span>
                                                                                <input type="text" class=" offset-2 border-0 fs-5 fw-bold text-start position-absolute text-start " pattern="[0-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />

                                                                            </div>


                                                                            <div class="position-absolute qty-buttons border-start border-start-1 border-secondary">
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                                      qty-inc border-bottom  border-bottom-1 border-secondary">
                                                                                    <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                                </div>
                                                                                <div class="justify-content-center d-flex flex-column align-items-center 
                                                                                     qty-dec">
                                                                                    <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec();'></i>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>


<div class="col-12">

<textarea class="col-12 form-control-plaintext " readonly name="" id=""><?php echo $product_data["description"]; ?></textarea>

</div>






                                                                    <div class="row">
                                                                        <div class="col-12 mt-5">
                                                                            <div class="row">
                                                                                <div class="col-12 d-grid">
                                                                                    <a class="btn btn-success col-12" type="submit"  >Contact On WhatsApp</a>
                                                                                </div>
                                                                                <!-- <div class="col-4 d-grid">
                                                                                    <button class="btn btn-primary">Add To Cart</button>
                                                                                </div>
                                                                                <div class="col-4 d-grid">
                                                                                    <button class="btn btn-secondary">
                                                                                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                    </button>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- <div class="col-12 bg-white">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-12 bg-white ">
                                <div class="row gap-2 justify-content-center">
                                    <?php


                                    $c_rs = Database::search("SELECT * FROM `category`");
                                    $c_num = $c_rs->num_rows;

                                    for ($y = 0; $y < $c_num; $y++) {

                                        $c_data = $c_rs->fetch_assoc();


                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c_data["id"] . "' AND 
`status_id`='1' ORDER BY `datetime_added`  LIMIT 5 OFFSET 0");

                                        $product_num = $product_rs->num_rows;

                                        for ($z = 0; $z < $product_num; $z++) {
                                            $product_data = $product_rs->fetch_assoc();
                                    ?>



                                            <div class="card col-6 col-lg-2 mt-2 mb-2  " style="width: 18rem;">

                                                <?php



                                                $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $image_data = $image_rs->fetch_assoc();

                                                ?>

                                                <img src="<?php echo $image_data["code"]; ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                                <div class="card-body ms-0 m-0 text-center">
                                                    <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?> &nbsp; <span class="badge rounded-pill text-bg-info">New</span></h5>
                                                    <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                                                    <?php

                                                    if ($product_data["qty"] > 0) {

                                                    ?>

                                                        <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                        <span class="card-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                                        <a href='<?php echo "singleProductViwe.php?id=" . ($product_data["id"]); ?>' class="col-12 btn btn-success">Buy Now</a>
                                                        <button class="col-12 btn btn-dark mt-2">
                                                            <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                        </button>

                                                    <?php

                                                    } else {

                                                    ?>
                                                        <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                                        <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br />
                                                        <button class="col-12 btn btn-success disabled">Buy Now</button>
                                                        <button class="col-12 btn btn-dark mt-2 disabled">
                                                            <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                        </button>

                                                    <?php

                                                    }


                                                    ?>

                                                    <button class="col-12 btn btn-outline-light mt-2 border border-primary">
                                                        <i class="bi bi-heart-fill text-danger fs-5"></i>
                                                    </button>
                                                </div>
                                            </div>

                                    <?php
                                        }
                                    }

                                    ?>
                                </div>
                            </div> -->

                            <!-- <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark border-end">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold">Product Details</span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-6">
                                        <div class="row d-block me-0 mt-4 mb-3 border-bottom border-end border-1 border-dark">
                                            <div class="col-12">
                                                <span class="fs-4 fw-bold">Feedbacks</span>
                                            </div>
                                        </div>
                                    </div> -->
                                <!-- </div>
                            </div> -->


                            <!-- <div class="col-12 col-lg-6 bg-white">
                                <div class="row">

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Brand: </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4">Apple</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-3">
                                                <label class="form-label fs-4 fw-bold">Model: </label>
                                            </div>
                                            <div class="col-9">
                                                <label class="form-label fs-4">iPhone 12</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fs-4 fw-bold">Description : </label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="60" rows="10" class="form-control" readonly></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> -->

                            <!-- <div class="col-12 col-lg-6">
                                <div class="row border border-1 border-dark rounded overflow-scroll me-0" style="height: 300px;">

                                    <?php

                                    $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                    $feedback_num = $feedback_rs->num_rows;

                                    for ($x = 0; $x < $feedback_num; $x++) {
                                        $feedback_data = $feedback_rs->fetch_assoc();
                                    ?>
                                        <div class="col-12 mt-1 mb-1 mx-1">
                                            <div class="row border border-1 border-dark rounded me-0">
                                                <?php

                                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $feedback_data["user_email"] . "'");
                                                $user_data = $user_rs->fetch_assoc();

                                                ?>
                                                <div class="col-10 mt-1 mb-1 ms-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></div>
                                                <div class="col-2 mt-1 mb-1 me-0">
                                                    <?php
                                                    if ($feedback_data["type"] == 1) {
                                                    ?>
                                                        <span class="badge bg-success">Positive</span>
                                                </div>
                                            <?php
                                                    } else if ($feedback_data["type"] == 2) {
                                            ?>
                                                <span class="badge bg-warning">Neutral</span>
                                            </div>
                                        <?php
                                                    } else if ($feedback_data["type"] == 3) {
                                        ?>
                                            <span class="badge bg-danger">Negative</span>
                                        </div>
                                    <?php
                                                    }
                                    ?>

                                    <div class="col-12">
                                        <b>
                                            <?php echo $feedback_data["feed"]; ?>
                                        </b>
                                    </div>
                                    <div class="offset-6 col-6 text-end">
                                        <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                    </div>
                                </div>
                            </div> -->
                        <?php
                                    }

                        ?>


                        </div>
                    </div>

                </div>
            </div>

            <?php include "footer.php"; ?>
            </div>
            </div>

            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>


<?php

    } else {
        echo ("Sory for the inconvinient");
    }
} else {
    echo ("Something went wrong");
}

?>