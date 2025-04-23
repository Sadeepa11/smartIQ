<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | SmartIQ</title>
    <link rel="stylesheet" href="bootstrsp.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resource/logo.jpg" />
</head>

<body>

    <div class="container-fluid">

        <div class="row">
            <?php include "header.php" ?>
            <?php

            require "connection.php";
            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];


                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON user.gender_id = gender.id  WHERE `email`='" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT *FROM `user_has_address` INNER JOIN `city` ON 
                 `user_has_address`.`city_id`=`city`.`id` INNER JOIN `district` ON 
                 `city`.`district_id`=`district`.`id` INNER JOIN `province` ON 
                 `district`.`province_id`=`province`.`id` WHERE `user_email`='" . $email . "'");

                $data = $details_rs->fetch_assoc();
                $image =  $image_rs->fetch_assoc();
                $address_data =  $address_rs->fetch_assoc();



            ?>
                <div class="col-12 bg-primary">
                    <div class="row">
                        <div class="col-12 bg-body rounded mt-4 mb-4">
                            <div class="row g-2">
                                <div class="col-mb-3 col-3 border-end">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">

                                        <?php
                                        if (empty($image["path"])) {
                                        ?>
                                            <img src="resource/profile_image/user.png" class="rounded-circle mt-5" style="width:200px;" id="viweImg" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image["path"]; ?>" class="rounded-circle mt-5" style="width: 200px;" id="viweImg" />
                                        <?php
                                        }
                                        ?>

                                        <span class="fw-bold"><?php echo $data["fname"] . " " . $data["lname"]; ?></span>
                                        <span class="fw-bold text text-black-50"><?php echo $data["email"] ?></span>

                                        <input type="file" class="d-none" id="profileimage" />
                                        <label onclick="changeImage();" for="profileimage" class="btn btn-primary mt-5" id="profileimage">Update Profile Image</label>
                                    </div>
                                </div>
                                <div class=" col-md-5 border-end">

                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-6 mt-1">
                                                <lable class="form-label">First Name</lable>
                                                <input type="text" class="form-control" value="<?php echo $data["fname"]; ?>" id="fname" />
                                            </div>

                                            <div class="col-6 mt-1">
                                                <lable class="form-label">Last Name</lable>
                                                <input type="text" class="form-control" value="<?php echo $data["lname"]; ?>" id="lname" />
                                            </div>

                                            <div class="col-12 mt-1">
                                                <lable class="form-label">Mobile</lable>
                                                <input type="text" class="form-control" value="<?php echo $data["mobile"]; ?>" id="mobile" />
                                            </div>

                                            <div class="col-12">
                                                <lable class="form-label">Password</lable>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" value="<?php echo $data["password"]; ?>" readonly />
                                                    <span class="input-group-text bg-primary text-white" id="basic-addon2 " style="cursor: pointer;">
                                                        <i class="bi bi-eye-slash-fill text-white"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <lable class="form-label">Email</lable>
                                                <input type="text" class="form-control" value="<?php echo $data["email"]; ?>" readonly />
                                            </div>

                                            <div class="col-12 mt-1">
                                                <lable class="form-label">Registered Date</lable>
                                                <input type="text" class="form-control" value="<?php echo $data["joined_date"]; ?>" readonly />
                                            </div>

                                            <?php

                                            if (!empty($address_data["line1"])) {
                                            ?>
                                                <div class="col-12 mt-1">
                                                    <lable class="form-label">Address line 1</lable>
                                                    <input type="text" class="form-control" value="<?php echo  $address_data["line1"]; ?>" id="line1" />
                                                </div>

                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12 mt-1">
                                                    <lable class="form-label">Address line 1</lable>
                                                    <input type="text" class="form-control" />
                                                </div>

                                            <?php
                                            }

                                            ?>

                                            <?php

                                            if (!empty($address_data["line2"])) {
                                            ?>
                                                <div class="col-12 mt-1">
                                                    <lable class="form-label">Address line 2</lable>
                                                    <input type="text" class="form-control" value="<?php echo  $address_data["line2"]; ?>" id="line2" />
                                                </div>

                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12 mt-1">
                                                    <lable class="form-label">Address line 2</lable>
                                                    <input type="text" class="form-control" />
                                                </div>

                                            <?php
                                            }



                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");
                                            ?>



                                            <div class="col-6 mt-1">
                                                <lable class="form-label">Province</lable>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $province_num = $province_rs->num_rows;
                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo $province_data["id"] ?>" <?php if (!empty($address_data["id"])) {
                                                                                                                if ($province_data["id"] == $address_data["id"]) {

                                                                                                            ?> selected <?php
                                                                                                                    }
                                                                                                                }



                                                                                                                        ?>>
                                                           
                                                            <?php
                                                            echo $province_data["name"]
                                                            ?>
                                                        </option>


                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-6 mt-1">
                                                <lable class="form-label">District</lable>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    $district_num = $district_rs->num_rows;
                                                    for ($x = 0; $x < $district_num; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo $district["id"] ?>" <?php
                                                                                                        if (!empty($address_data["id"])) {
                                                                                                            if ($district_data["id"] == $address_data["id"]) {

                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }



                                                                                                                    ?>><?php echo $district_data["name"] ?></option>

                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                            <div class="col-6 mt-1">
                                                <lable class="form-label">City</lable>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $city_rs = Database::search("SELECT * FROM `city`");
                                                    $city_num = $city_rs->num_rows;
                                                    for ($x = 0; $x < $city_num; $x++) {
                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["id"]; ?>" <?php
                                                                                                        if (!empty($address_data["city_id"])) {
                                                                                                            if ($city_data["id"] == $address_data["city_id"]) {
                                                                                                        ?>selected<?php
                                                                                                                }
                                                                                                            }
                                                                                                                    ?>><?php echo $city_data["name"]; ?></option>

                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                            <?php

                                            if (!empty($address_data["postal_code"])) {

                                            ?>
                                                <div class="col-6 mt-1">
                                                    <lable class="form-label">Postal Code</lable>
                                                    <input type="text" class="form-control" value="<?php echo  $address_data["postal_code"]; ?>" id="pcode" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6 mt-1">
                                                    <lable class="form-label">Postal Code</lable>
                                                    <input type="text" class="form-control" />
                                                </div>


                                            <?php

                                            }


                                            if (!empty($data["gender_id"])) {

                                            ?>

                                                <div class="col-12">
                                                    <lable class="form-label">Gender</lable>
                                                    <input type="text" class="form-control" value="<?php echo  $data["gender_name"]; ?>" readonly />
                                                </div>

                                            <?php
                                            } else {

                                            ?>
                                                <div class="col-12">
                                                    <lable class="form-label">Gender</lable>
                                                    <input type="text" class="form-control" readonly />
                                                </div>
                                            <?php
                                            }
                                            ?>


                                            <div class="col-12 d-grid mt-2">
                                                <button class="btn btn-primary" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <span class="fw-bold text-black-50 mt-5">Display ads</span>
                                    </div>
                                </div>




                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                header("location:index.php");
            }
            ?>

            <?php include "footer.php" ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>

</body>

</html>