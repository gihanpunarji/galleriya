<?php

// session_start();
// require "connection/connection.php";
$page_num;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <title>Shop | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">


    <!-- Bootstrap Icon CDN -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="resources/svg/logo-black.svg">

</head>

<body>
    <?php include "components/header.php";
    ?>

    <div class="container">
        <div class="col-12">
            <div class="row mt-3">
                <div class="col-12 col-md-2 d-flex align-items-center">
                    <span class="fw-bold">Hello, <?php if (isset($_SESSION["user"])) {
                                                    ?>
                        <a href="userProfile.php"
                            class="text-black-50"><?php echo $_SESSION["user"]["fname"] . " " . $_SESSION["user"]["lname"] ?></a>
                        <a href="#" class=" text-black" onclick="signout();"> Sign Out</a></span>

                    <?php
                                                    } else {
                ?>
                    <a href="userSignin.php" class="text-black-50">Sign In</a></span>
                    <?php
                                                    } ?>
                </div>
                <div class="col-8 col-md-8">
                    <input type="text" id="search" class="form-control" placeholder="Search anything here...">
                </div>
                <div class="col-4 col-md-2">
                    <button onclick="searchPaints('x');" class="btn btn-light-red">Search
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 d-none d-md-block">
            <div class="row mt-4">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://www.pictoclub.com/wp-content/uploads/2021/09/painting-brushes-2048x1365.jpg"
                                class="d-block w-100" style="height: 400px; object-fit: fill">
                        </div>
                        <div class=" carousel-item">
                            <img src="https://knowledgemerger.com/wp-content/uploads/2022/04/2020_09_08_103908_1599547210._large.jpg"
                                class="d-block w-100" style="height: 400px; object-fit: fill">
                        </div>
                        <div class=" carousel-item">
                            <img src="https://media.istockphoto.com/id/1183183791/photo/talented-female-artist-works-on-abstract-oil-painting-using-paint-brush-she-creates-modern.jpg?s=612x612&w=0&k=20&c=QrR6QQxioyM6zT5qPpKxr9KFz2VRrhVO3rXJ8fIfswY="
                                class="d-block w-100" style="height: 400px; object-fit: fill">
                        </div>
                    </div>
                    <button class=" carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-12 mt-4">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4">
                    <!-- FILTERS SECTION -->
                    <div class="col-12 bg-primary px-3 py-2 rounded text-white">
                        <div class="col-12">
                            <span class="fs-4">Category</span>
                        </div>
                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($i = 0; $i < $category_num; $i++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>

                        <div class="col-12 d-flex justify-content-between">
                            <span class="filter-text"><?php echo $category_data["category_name"]; ?></span>
                            <?php 
                            // $paint_category_num = Database::search("SELECT * FROM `paint` WHERE `category_id` = '".$category_data["id"]."'");
                            // for ($i=0; $i < $paint_category_num; $i++) { 
                                
                            // }
                            ?>
                            <span class="filter-text"><?php  ?></span>
                        </div>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="col-12 px-3 py-2">
                        <div class="col-12">
                            <span class="text-black-50 fs-4">Category</span>
                        </div>
                        <?php
                        $category_rs = Database::search("SELECT * FROM `category`");
                        $category_num = $category_rs->num_rows;

                        for ($i = 0; $i < $category_num; $i++) {
                            $category_data = $category_rs->fetch_assoc();
                        ?>
                        <div class="col-12 d-flex justify-content-between">
                            <div class="filter-text-btn"
                                onclick="getPressedPaintId('<?php echo $category_data['id']; ?>');">
                                <?php echo $category_data["category_name"]; ?></div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>

                    <!-- FILTERS SECTION -->
                </div>
                <div class="col-12 col-md-10 col-lg-8" id="paints">
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

                            $selected_paint_rs = Database::search("SELECT * FROM `paint` LIMIT " . $results_per_page . " OFFSET " . $page_result . "");
                            $selecteed_paint_num = $selected_paint_rs->num_rows;

                            for ($i = 0; $i < $selecteed_paint_num; $i++) {
                                $selected_paint_data = $selected_paint_rs->fetch_assoc();
                            ?>
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="product-item">
                                    <?php
                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `paint_id` = '" . $selected_paint_data["id"] . "'");
                                        $image_data = $image_rs->fetch_assoc();
                                        ?>
                                    <div class="product-item-img"
                                        style="background-image: url('<?php echo 'middlewares/' . $image_data["path"] ?>');">
                                    </div>
                                </div>
                                <div class="product-item-text">
                                    <h6 id="title"><?php echo $selected_paint_data["title"]; ?></h6>
                                    <a onclick='addToCart(<?php echo $selected_paint_data["id"] ?>)'
                                        class="btn btn-sm btn-light-red">Add to Cart</a>
                                    <a href="<?php echo "singleProductView.php?id=" . $selected_paint_data['id'] ?>"
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
                                                echo "?page=" . ($page_num - 1);
                                            }
                                            ?>" class="page-link">Previous</a>
                            </li>
                            <?php
                            for ($i = 1; $i <= $no_of_pages; $i++) {
                                if ($page_num == 1) {
                            ?>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="<?php echo "?page=" . ($i) ?>"><?php echo $i ?></a>
                            </li>
                            <?php
                                } else {
                                ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo "?page=" . ($i) ?>"><?php echo $i ?></a>
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
                                                                echo "?page=" . ($page_num + 1);
                                                            }
                                                            ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- PAGINATION -->
                </div>
            </div>
        </div>

    </div>

    <?php include "components/footer.php" ?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="javaScript/script.js"></script>
</body>

</html>