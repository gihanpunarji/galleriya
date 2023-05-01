<?php

include "components/header.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $paint_rs = Database::search("SELECT * FROM `paint` WHERE id = '" . $pid . "'");
    $paint_num = $paint_rs->num_rows;

    if ($paint_num == 1) {
        $paint_data = $paint_rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $paint_data["title"] ?> | Galleriya</title>

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"> -->

    <link rel="stylesheet" href="css/style.css">

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="resources/svg/logo-black.svg">
</head>

<body>


    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a style="text-decoration: none; color: black"
                                        href="index.php">Galleriya</a></li>
                                <li class="breadcrumb-item" aria-current="page"><a
                                        style="text-decoration: none; color: black" href="shop.php">Shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a style="color: #c0c0c0"
                                        href="#"><?php echo $paint_data["title"] ?></a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <div class="col-12">
                                <?php
                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `paint_id` = '" . $paint_data["id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();
                                        ?>
                                <div class="col-12">
                                    <div class="single_page_img">
                                        <img style="width: 100%; height:100%;"
                                            src="<?php echo 'middlewares/' . $image_data["path"] ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <?php
                                    $rs = Database::search("SELECT * FROM `paint` p INNER JOIN `category` c 
                            ON p.category_id = c.id WHERE p.id = '" . $paint_data["id"] . "'");

                                    $rs_data = $rs->fetch_assoc();
                                    ?>
                            <div class="col-12">
                                <div class="col-12">
                                    <h3 class=" text-black-50 fw-bold"><?php echo $rs_data["title"] ?></h3>
                                </div>
                                <div class="col-12 mt-2">
                                    <h4 class=" text-black-50 fw-bold"><?php echo $rs_data["category_name"] ?></h4>
                                </div>
                                <?php
                                        $average_table = Database::search("SELECT AVG(rating) as avg_rating from review WHERE paint_id = '" . $pid . "';");
                                        $average_row = $average_table->fetch_assoc();
                                        ?>
                                <div class="col-12 mt-4">
                                    <h6 class=" text-black-50">This paint has average ratings of
                                        <?php echo intval($average_row["avg_rating"]) ?>
                                        /5</h6>
                                </div>
                                <div class="col-12 mt-2 d-flex">
                                    Rs.
                                    <?php echo $rs_data["price"] ?> .00</span>

                                </div>
                                <div class="col-12 mt-2">
                                    <span class="text-black-50">
                                        <?php
                                                if ($rs_data["description"] == null) {
                                                    echo "";
                                                } else {
                                                    echo $rs_data["description"];
                                                }
                                                ?>
                                    </span>
                                </div>
                                <div class="col-12 mt-2 d-flex" style="max-width: 400px;">
                                    <span>Category : </span>
                                    <span class="text-black-50">&nbsp; <?php echo $rs_data["category_name"] ?></span>
                                </div>
                                <div class="col-12 mt-2 d-flex" style="max-width: 400px;">
                                    <span>Artist : </span>
                                    <span class="text-black-50">&nbsp; <?php echo $rs_data["artist"] ?></span>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="border border-1 shadow"></div>
                                </div>
                                <div class="col-12 mt-3 d-flex align-items-center gap-2">
                                    <!-- <a href="#"><i class="fa-solid fa-plus"></i></a> -->
                                    <input type="number" class="form-control" value="<?php echo $rs_data["qty"] ?>"
                                        min="0" style="width: 100px;" id="qty"
                                        onclick='check_qty(<?php echo $rs_data["qty"] ?>)'>
                                    <!-- <a href="#"><i class="fa-solid fa-minus"></i></a> -->
                                    <span class="text-black-50">Quantity</span>
                                </div>
                                <div class="col-12 mt-3 d-flex gap-3">
                                    <?php 
                                    if ($rs_data["qty"] == "0") {
                                        ?>
                                    <button class="btn btn-sm btn-light-red" style="width: 100%;"
                                        onclick="buyNow(<?php echo $paint_data['id'] ?>)" disabled>Buy
                                        Now</button>
                                    <?php
                                    } else {
                                    ?>
                                    <button class="btn btn-sm btn-light-red" style="width: 100%;"
                                        onclick="buyNow(<?php echo $paint_data['id'] ?>)">Buy
                                        Now</button>
                                    <?php
                                    }
                                    ?>
                                    <!-- PAYHERE INTERGRATION -->

                                    <!--  -->
                                    <button class="btn btn-sm btn-dark" style="width: 100%;"
                                        onclick="addToCart('<?php echo $paint_data['id'] ?>')">Add
                                        to
                                        Cart</button>
                                </div>
                                <div id="card_container"></div>
                                <div class="col-12 mt-5">
                                    <hr class="shadow">
                                </div>
                                <div class="col-12">
                                    <span class="text-muted" style="font-size: 14px;">* Note: If you are around kegalle
                                        sometimes you may get Free
                                        Delivery. Contact
                                        the seller for more details! *</span>
                                </div>
                                <div class="col-12 text-black-50 mt-2 d-flex flex-column">
                                    <span>Withing Kegalle delivery : Rs.
                                        ---.00</span>
                                    <span>Outside Kegalle delivery : Rs.
                                        <?php echo $rs_data["delivery_fee"] ?> .00</span>
                                </div>
                                <div class="col-12 mt-5">
                                    <hr class="shadow">
                                </div>
                                <span>Customer Reviews and rating</span>
                                <?php
                                        $review_table = Database::search("SELECT * FROM `review` WHERE `paint_id` = '" . $pid . "'");
                                        for ($i = 0; $i < $review_table->num_rows; $i++) {
                                            if ($review_table->num_rows == 0) {
                                        ?><p>No reviews yet for this paint</p><?php
                                                                            } else {
                                                                                $review = $review_table->fetch_assoc();
                                                                                $user_table = Database::search("SELECT * FROM `user` WHERE `email` = '" . $review["user_email"] . "'");
                                                                                $user_data = $user_table->fetch_assoc();
                                                                                ?>
                                <div class="d-flex">
                                    <p><?php echo $user_data["fname"] . " " . $user_data["lname"] ?> : </p>&nbsp;
                                    <p><?php echo $review["review"] ?></p>
                                </div>
                                <?php
                                                                            }
                                                                        }  ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include "components/footer.php" ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>

    <script src="javaScript/script.js"></script>
</body>

</html>
<?php

    } else {
        echo "#";
    }
} else {
    echo "Something Went Wrong! 😐";
}

?>