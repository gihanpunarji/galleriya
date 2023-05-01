<?php

require "connection/connection.php";
session_start();

if(isset($_SESSION["admin"])) {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel | Galleriya</title>

    <!-- Bootstrap CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="resources/svg/logo-black.svg">

</head>

<body>

    <div class="container">
        <div class="col-12">
            <div class="row mt-2 mt-md-5">
                <div class="col-md-3 d-none d-md-block">
                    <div class="col-12">
                        <div class="border rounded" style="height: 500px">
                            <div class="row px-2">
                                <h4 class="fw-bold" style="color: #c06a41">Admin Dashboard</h4>
                                <div class="row mx-2">
                                    <hr style="width: 80%">
                                </div>
                            </div>

                            <div class="row px-2">
                                <a class="link" href="./adminPanel.php">Dashboard</a>
                            </div>
                            <div class="row px-2">
                                <a class="link" onclick="addPaint()">Add Paint</a>
                            </div>
                            <div class="row px-2">
                                <a class="link">Customers</a>
                            </div>
                            <div class="row px-2">
                                <a class="link" href="manageStock.php">Stock Management</a>
                            </div>
                            <div class="row mx-2">
                                <a class="btn btn-sm btn-light-red px-5" onclick="signoutAdmin();">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4 pb-2 pb-md-0">
                            <?php
                        $today = date('Y-m-d');

                        $sql_today = Database::search("SELECT SUM(`total`) AS today_total FROM `invoice` 
                        WHERE DATE(`date`) = '".$today."'");
                        $today_row = $sql_today->fetch_assoc();
                        $today_total = $today_row["today_total"];
                        ?>
                            <div class="border rounded" style="height: 200px">
                                <h4 class="text-center fw-bold fs-5 pt-3">Today's Earning</h4>
                                <h6 class="text-center fs-5 pt-4">Rs.
                                    <?php echo ($today_total== 0)? "0" : $today_total ?>. 00</h6>
                                <h6 class="text-center pt-4"><a href="#">view</a></h6>
                            </div>
                        </div>
                        <div class="col-md-4 pb-2 pb-md-0">
                            <?php
                        $current_month = date('m');

                        $sql_month = Database::search("SELECT SUM(`total`) AS month_total FROM `invoice` 
                        WHERE MONTH(`date`) = '".$current_month."'");
                        $month_row = $sql_month->fetch_assoc();
                        $month_total = $month_row["month_total"];
                        ?>
                            <div class="border rounded" style="height: 200px">
                                <h4 class="text-center fw-bold fs-5 pt-3">Monthly Earning</h4>
                                <h6 class="text-center fs-5 pt-4">Rs. <?php echo $month_total ?>. 00</h6>
                                <h6 class="text-center pt-4"><a href="#">view</a></h6>
                            </div>
                        </div>
                        <div class="col-md-4 pb-2 pb-md-0">
                            <div class="border rounded" style="height: 200px">
                                <h4 class="text-center fw-bold fs-5 pt-3">Total Sales</h4>
                                <h6 class="text-center fs-5 pt-4">Rs. <?php 
                            $result = Database::search("SELECT SUM(total) AS `total` FROM `invoice`");
                            $total = $result->fetch_assoc();
                            echo $total["total"];
                        ?>. 00</h6>
                                <h6 class="text-center pt-4"><a href="#">view</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 pt-2 ">
                            <div class="border rounded" style="height: 100%">
                                <h6 class="ps-2 pt-2">Recent selled paints</h6>
                                <div class="d-flex justify-content-between align-items-center mt-3 px-2 ms-6">
                                    <span>#</span>
                                    <span>image</span>
                                    <span>artist</span>
                                    <span>Stock</span>
                                </div>
                                <?php
                                $invoice_table = Database::search("SELECT DISTINCT `paint_id`, `qty` FROM `invoice` ORDER BY `date` LIMIT 4");

                                for ($i=0; $i < $invoice_table->num_rows; $i++) { 
                                    $invoice_data = $invoice_table->fetch_assoc();
                                    $pid = $invoice_data["paint_id"];
                                
                                    $paint_table = Database::search("SELECT * FROM `paint` WHERE `id`= '".$pid."'");
                                    $paint_data = $paint_table->fetch_assoc();
                                    $artist = $paint_data["artist"];
                                    $stock = $paint_data["qty"];
                                    

                                    $image_table = Database::search("SELECT * FROM `images` WHERE `paint_id`= '".$pid."'");
                                    $img_data = $image_table->fetch_assoc();
                                    $img = $img_data["path"];

                                ?>
                                <div class="d-flex justify-content-between align-items-center mt-3 px-2">
                                    <span><?php echo $pid ?></span>
                                    <img src="middlewares/<?php echo $img ?>" width="50" height="70">
                                    <span><?php echo $artist ?></span>
                                    <span><?php echo $stock ?></span>

                                </div>
                                <div class="px-2">
                                    <hr width="100%">
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin
    <button onclick="addPaint()">Add paint</button> -->
</body>
<script src="javaScript/admin.js"></script>

</html>
<?php
} else {
    ?>
<h1>404 Page Not found</h1>
<?php
}

?>