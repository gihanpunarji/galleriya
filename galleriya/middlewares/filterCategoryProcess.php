<?php

require "../connection/connection.php";

$search = $_POST["search"];

 $query = "SELECT * FROM `paint` WHERE `title`";
        
if (!empty($search)) {
    $query.= " LIKE '%".$search."%'";
    ?>
<!-- PRODUCT SECTION -->
<div class="col-12">
    <div class="row d-flex justtify-content-center">
        <?php

        if (isset($_GET["page"])) {
            $page_num = $_GET["page"];
        } else {
            $page_num = 1;
        }

        $results_per_page = 8;

        $paint_rs = Database::search($query);
        $paint_num = $paint_rs->num_rows;

        $no_of_pages = ceil($paint_num / $results_per_page);
        $page_result = ($page_num - 1) * $results_per_page;

        $selected_paint_rs = Database::search($query." LIMIT ".$results_per_page." OFFSET ".$page_result."");
        $selecteed_paint_num = $selected_paint_rs->num_rows;

        for ($i=0; $i < $selecteed_paint_num; $i++) { 
            $selected_paint_data = $selected_paint_rs->fetch_assoc();
            ?>
        <div class="col-lg-3 col-md-4 col-6">
            <div class="product-item">
                <?php
                $image_rs = Database::search("SELECT * FROM `images` WHERE `paint_id` = '".$selected_paint_data["id"]."'");
                $image_data = $image_rs->fetch_assoc();
                ?>
                <div class="product-item-img"
                    style="background-image: url('<?php echo 'middlewares/'.$image_data["path"] ?>');">
                </div>
            </div>
            <div class="product-item-text">
                <h6 id="title"><?php echo $selected_paint_data["title"]; ?></h6>
                <a href="#" class="btn btn-sm btn-light-red">Add to Cart</a>
                <a href="<?php echo "singleProductView.php?id=". $selected_paint_data['id'] ?>"
                    class="btn btn-sm btn-dark">Buy Now</a>
                <div class="stock"><?php echo $selected_paint_data["qty"]; ?> Left Only</div>
                <h5>Rs. <?php echo $selected_paint_data["price"]; ?>. 00</h5>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- PRODUCT SECTION -->

<!-- PAGINATION -->
<nav class="d-flex justify-content-center mt-5">
    <ul class="pagination">
        <li class="page-item">
            <a href="<?php 
            if ($page_num <= 1) {
                echo "#";
            } else {
                echo "?page=". ($page_num - 1);
            }
            ?>" class="page-link">Previous</a>
        </li>
        <?php 
        for ($i=1; $i <= $no_of_pages; $i++) { 
            if ($page_num == 1) {
                ?>
        <li class="page-item active aria-current=" page">
            <a class="page-link" href="<?php echo "?page=".($i) ?>"><?php echo $i ?></a>
        </li>
        <?php
        } else {
            ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo "?page=".($i) ?>"><?php echo $i ?></a>
        </li>
        <?php
            }
        }
        ?>
        <li class="page-item">
            <a class="page-link" href="<?php 
            if ($page_num >= $no_of_pages) {
                echo "#";
            } else {
                echo "?page=". ($page_num + 1);
            }
            ?>">Next</a>
        </li>
    </ul>
</nav>
<!-- PAGINATION -->
<?php
} else {
    ?>
<!-- PRODUCT SECTION -->
<div class="col-12">
    <div class="row d-flex justtify-content-center">
        <?php

        if (isset($_GET["page"])) {
            $page_num = $_GET["page"];
        } else {
            $page_num = 1;
        }

        $results_per_page = 8;

        $paint_rs = Database::search("SELECT * FROM `paint`");
        $paint_num = $paint_rs->num_rows;

        $no_of_pages = ceil($paint_num / $results_per_page);
        $page_result = ($page_num - 1) * $results_per_page;

        $selected_paint_rs = Database::search("SELECT * FROM `paint` LIMIT ".$results_per_page." OFFSET ".$page_result."");
        $selecteed_paint_num = $selected_paint_rs->num_rows;

        for ($i=0; $i < $selecteed_paint_num; $i++) { 
            $selected_paint_data = $selected_paint_rs->fetch_assoc();
            ?>
        <div class="col-lg-3 col-md-4 col-6">
            <div class="product-item">
                <?php
                $image_rs = Database::search("SELECT * FROM `images` WHERE `paint_id` = '".$selected_paint_data["id"]."'");
                $image_data = $image_rs->fetch_assoc();
                ?>
                <div class="product-item-img" style="background-image: url('<?php echo $image_data["path"] ?>');">
                    <?php if($selected_paint_data["condition"] == 1) {
                        echo '<span class="label">New</span>';
                    } else {
                        echo "";
                    } ?>

                </div>
            </div>
            <div class="product-item-text">
                <h6 id="title"><?php echo $selected_paint_data["title"]; ?></h6>
                <a href="#" class="btn btn-sm btn-light-red" id="add-to-cart">Add to Cart</a>
                <div class="stock"><?php echo $selected_paint_data["qty"]; ?> Left Only</div>
                <h5>Rs. <?php echo $selected_paint_data["price"]; ?>. 00</h5>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- PRODUCT SECTION -->

<!-- PAGINATION -->
<nav class="d-flex justify-content-center mt-5">
    <ul class="pagination">
        <li class="page-item">
            <a href="<?php 
            if ($page_num <= 1) {
                echo "#";
            } else {
                echo "?page=". ($page_num - 1);
            }
            ?>" class="page-link">Previous</a>
        </li>
        <?php 
        for ($i=1; $i <= $no_of_pages; $i++) { 
            if ($page_num == 1) {
                ?>
        <li class="page-item active aria-current=" page">
            <a class="page-link" href="<?php echo "?page=".($i) ?>"><?php echo $i ?></a>
        </li>
        <?php
        } else {
            ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo "?page=".($i) ?>"><?php echo $i ?></a>
        </li>
        <?php
            }
        }
        ?>
        <li class="page-item">
            <a class="page-link" href="<?php 
            if ($page_num >= $no_of_pages) {
                echo "#";
            } else {
                echo "?page=". ($page_num + 1);
            }
            ?>">Next</a>
        </li>
    </ul>
</nav>
<!-- PAGINATION -->
<?php
}

?>