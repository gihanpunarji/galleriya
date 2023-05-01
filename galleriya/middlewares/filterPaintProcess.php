<?php 

require "../connection/connection.php";
$cid = $_GET["cid"];

$paint_table = Database::search("SELECT * FROM `paint` WHERE `category_id` = '".$cid."'");
$paint_nums = $paint_table->num_rows;

?>
<!-- PRODUCT SECTION -->
<div class="col-12">
    <div class="row d-flex justtify-content-center">
        <?php
    for ($i=0; $i < $paint_nums; $i++) { 
        $paint_data = $paint_table->fetch_assoc();
        $pid = $paint_data["id"];
    ?>
        <div class="col-lg-3 col-md-4 col-6">
            <div class="product-item">
                <?php
                 $image_rs = Database::search("SELECT * FROM `images` WHERE `paint_id` = '".$pid."'");
                 $image_data = $image_rs->fetch_assoc();
                ?>
                <div class="product-item-img"
                    style="background-image: url('<?php echo 'middlewares/'.$image_data["path"] ?>');">
                </div>
            </div>
            <div class="product-item-text">
                <h6 id="title"><?php echo $paint_data["title"]; ?></h6>
                <a href="#" class="btn btn-sm btn-light-red">Add to Cart</a>
                <a href="<?php echo "singleProductView.php?id=". $paint_data['id'] ?>" class="btn btn-sm btn-dark">Buy
                    Now</a>
                <div class="stock"><?php echo $paint_data["qty"]; ?> Left Only</div>
                <h5>Rs. <?php echo $paint_data["price"]; ?>. 00</h5>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- PRODUCT SECTION -->