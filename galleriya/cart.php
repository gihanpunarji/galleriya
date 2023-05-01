<?php

// session_start();
// require "connection/connection.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">


    <!-- Bootstrap Icon CDN -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="resources/svg/logo-black.svg">
</head>

<body>
    <?php include "components/header.php";?>

    <div class="container">
        <div class="col-12">
            <?php
            if (isset($_SESSION["user"])) {
                $user_email = $_SESSION["user"]["email"];
                $total = 0;
                $total_price = 0;
                $total_delivery_fee = 0;

                $cart_item_rs = Database::search("SELECT * FROM `cart_item` WHERE `user_email` = '".$user_email."' ");
                $cart_item_num = $cart_item_rs->num_rows;                

            ?>
            <div class="row mt-4">
                <div class="col-12 col-md-8">
                    <?php
                        if($cart_item_num == 0) {
                        ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 emptyCart"></div>
                            <div class="col-12 mb-2">
                                <label class="form-label fs-1 fw-bold">
                                    You have no items in your Cart yet.
                                </label>
                            </div>
                            <div class="col-12 col-lg-4 mb-4 d-grid">
                                <a href="shop.php" class="btn btn-light-red">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                        } else {
                            ?>
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold">Galleriya Bag</h2>
                        <span class="text-black-50"><?php echo $cart_item_num ?> Items</span>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 col-12 d-flex justify-content-between align-items-center">
                        <span class="text-black-50">Item</span>
                        <span class="text-black-50">Details</span>
                        <span class="text-black-50">Price</span>
                        <span class="empty-span"></span>
                    </div>
                    <?php
                          
                            for ($i=0; $i < $cart_item_num; $i++) { 
                                $cart_item_data = $cart_item_rs->fetch_assoc();
                                
                                $paint_id = $cart_item_data["paint_id"];
                               
                                $paint_rs = Database::search("SELECT * FROM `paint` WHERE `id` = '".$paint_id."' ");
                                $paint_data = $paint_rs->fetch_assoc();

                            ?>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <?php
                        $img_rs = Database::search("SELECT * FROM `images` WHERE `paint_id` = '".$cart_item_data["paint_id"]."'");
                        $img_data = $img_rs->fetch_assoc();
                        ?>
                        <div class="col-12 cart-img"
                            style="background-image: url('<?php echo 'middlewares/'.$img_data["path"] ?>');">
                        </div>
                        <div class="d-flex flex-column gap-1">
                            <span style="font-size: 12px;"><?php echo $paint_data["title"] ?></span>
                            <span style="font-size: 12px;">By <?php echo $paint_data["artist"] ?></span>
                            <input type="number" value="<?php echo $cart_item_data["qty"] ?>" min="0"
                                max="<?php echo $paint_data["qty"] ?>" id="qty" class="form-control"
                                style="width: 70px;">
                        </div>
                        <div>
                            <span class="fw-bold text-primary">Rs.
                                <?php echo $paint_data["price"] ?></span>
                            <?php
                                     ?>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-2">
                            <a href="<?php echo "singleProductView.php?id=" . $paint_data['id'] ?>"
                                class="btn btn-sm btn-light-red">Buy Now</a>
                            <button onclick="removeFromCart(<?php echo $cart_item_data['paint_id'] ?>)"
                                class="btn btn-sm btn-dark">Remove</button>
                        </div>

                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <?php
                        }
                        
                        ?>


                </div>
                <div class="col-12 col-md-3 ms-md-4">
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold">Summary</h2>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <span>Items</span>
                        <span class="text-black-50">(<?php echo $cart_item_num ?>)</span>
                    </div>

                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <span>Delivery fee :</span>
                        <span class="text-black-50"><?php echo $paint_data["delivery_fee"] ?></span>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12 d-flex justify-content-between align-items-center">
                        <span class="fs-4">Total</span>
                        <span class="text-black-50">
                            <?php
                    $rs = Database::search("SELECT * FROM `cart_item` WHERE
                    `user_email` = '".$user_email."' ");
                    $num = $rs->num_rows;

                    for ($i=0; $i < $num; $i++) { 
                        $paint_id = $rs->fetch_assoc()["paint_id"];

                        $paint_rs = Database::search("SELECT * FROM `paint` WHERE `id` = '".$paint_id."' ");
                        
                        $paint_cart_data = $paint_rs->fetch_assoc();

                        $paint_data_price = $paint_cart_data["price"];
                        $delivery_fee = $paint_cart_data["delivery_fee"];

                        $total += $paint_data_price;
                        $total_delivery_fee += $delivery_fee;

                        $total_price = $total + $total_delivery_fee;

                    }
                    echo number_format($total_price, 2);


                    ?>
                        </span>

                    </div>

                    <div class="col-12 mt-2">
                        <a href="#" class="btn btn-dark w-100">Checkout</a>
                    </div>
                </div>
                <?php
                        }
                        
                    } else {
                        ?>
                <div class="col-12">
                    <span class="fw-bold fs-2">Please Sign In to use the cart</span>
                </div>
                <?php
                    }
                    ?>


            </div>
        </div>
    </div>

    <?php include "components/footer.php";?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="Javascript/script.js"></script>

</body>

</html>