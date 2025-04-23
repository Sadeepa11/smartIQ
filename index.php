<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | SmartIQ</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="resource/logo.jpg" />
    <style>
        /* Modern styling */
        body {
            background-color: #f8f9fa;
        }

        .search-container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.08);
            margin: 1rem 0;
        }

        .search-input {
            border-radius: 0.5rem;
            border: 2px solid #e9ecef;
            padding: 0.75rem;
            transition: all 0.2s;
        }

        .search-input:focus {
            border-color: #4a90e2;
            box-shadow: 0 0 0 4px rgba(74,144,226,0.1);
        }

        .search-button {
            background: linear-gradient(45deg, #4a90e2, #357abd);
            border: none;
            font-weight: 600;
        }

        .search-button:hover {
            background: linear-gradient(45deg, #357abd, #2d6da3);
            transform: translateY(-1px);
        }

        .carousel-container {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1rem 2rem rgba(0,0,0,0.1);
        }

        .carousel-item img {
            object-fit: cover;
            border-radius: 1rem;
        }

        .category-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
            margin: 2rem 0 1rem 0;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d3748;
            position: relative;
        }

        .category-title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background: #4a90e2;
            border-radius: 3px;
        }

        .product-card {
            background: white;
            border: none;
            border-radius: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.05);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(0,0,0,0.1);
        }

        .product-img {
            border-radius: 1rem 1rem 0 0;
            object-fit: cover;
        }

        .product-title {
            color: #2d3748;
            font-size: 1rem;
            font-weight: 600;
            margin: 0.5rem 0;
        }

        .product-price {
            color: #4a90e2;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .stock-status {
            font-size: 0.9rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.5rem;
            display: inline-block;
            margin: 0.5rem 0;
        }

        .in-stock {
            background: #c6f6d5;
            color: #2f855a;
        }

        .out-stock {
            background: #fed7d7;
            color: #c53030;
        }

        .view-btn {
            background: #4a90e2;
            color: white;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: 600;
            transition: all 0.2s;
        }

        .view-btn:hover {
            background: #357abd;
            transform: translateY(-1px);
        }

        .product-section {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <?php include "header.php"; ?>

            <!-- Search Section -->
            <div class="col-12 search-container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-2 text-center mb-3 mb-lg-0">
                        <img src="resource/logo.jpg" alt="Logo" class="img-fluid" style="max-height: 60px;">
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="input-group">
                            <input type="text" class="form-control search-input" placeholder="Search products..." id="basic_search_txt">
                            <select class="form-select" style="max-width: 250px;" id="basic_search_select">
                                <option value="0">All Categories</option>
                                <?php
                                require "connection.php";
                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;
                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <button class="btn search-button w-100" onclick="basicSearch(0);">
                            <i class="bi bi-search me-2"></i>Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- Carousel Section -->
            <div class="col-12 mb-5 d-none d-lg-block">
                <div class="carousel-container">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-inner">
                            <?php
                            $s_rs = Database::search("SELECT * FROM `banners`");
                            $s_num = $s_rs->num_rows;
                            for ($z = 0; $z < $s_num; $z++) {
                                $s_data = $s_rs->fetch_assoc();
                            ?>
                                <div class="carousel-item <?php echo $z === 0 ? 'active' : ''; ?>">
                                    <img src="<?php echo $s_data['url']; ?>" class="d-block w-100" style="height: 70vh; object-fit: cover;">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Products by Category -->
            <div class="col-12" id="basicSearchResult">
                <?php
                $c_rs = Database::search("SELECT * FROM `category`");
                $c_num = $c_rs->num_rows;
                for ($y = 0; $y < $c_num; $y++) {
                    $c_data = $c_rs->fetch_assoc();
                ?>
                    <div class="product-section">
                        <div class="category-header">
                            <h2 class="category-title"><?php echo $c_data["name"]; ?></h2>
                        </div>
                        
                        <div class="row g-4">
                            <?php
                            $product_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $c_data["id"] . "' AND 
                            `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 offset 0");
                            $product_num = $product_rs->num_rows;
                            for ($z = 0; $z < $product_num; $z++) {
                                $product_data = $product_rs->fetch_assoc();
                                $image_rs = Database::search("SELECT * FROM `image` WHERE `product_id`='" . $product_data["id"] . "'");
                                $image_data = $image_rs->fetch_assoc();
                            ?>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product-card h-100">
                                        <img src="<?php echo $image_data["code"]; ?>" class="product-img w-100" style="height: 200px;">
                                        <div class="p-3">
                                            <h3 class="product-title">
                                                <?php echo $product_data["title"]; ?>
                                                <span class="badge bg-info rounded-pill ms-2">New</span>
                                            </h3>
                                            <div class="product-price mb-2">Rs. <?php echo $product_data["price"]; ?>.00</div>
                                            
                                            <?php if ($product_data["qty"] > 0) { ?>
                                                <div class="stock-status in-stock">
                                                    <i class="bi bi-check-circle me-1"></i>In Stock (<?php echo $product_data["qty"]; ?>)
                                                </div>
                                                <a href='<?php echo "singleProductViwe.php?id=" . ($product_data["id"]); ?>' 
                                                   class="btn view-btn w-100">View Product</a>
                                            <?php } else { ?>
                                                <div class="stock-status out-stock">
                                                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                                                </div>
                                                <button class="btn view-btn w-100 disabled">View Product</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>
</html>