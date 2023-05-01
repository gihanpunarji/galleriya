<?php

// require "connection/connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icon CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="icon" href="resources/svg/logo-black.svg">
</head>

<body>

    <?php include "components/header.php" ?>


    <div>
        <div class="row">
            <div class="col-12">
                <div class="hero-img"></div>
                <div class="overlay"></div>
                <div class="hero-section d-flex flex-column align-items-center">
                    <div class="py-3">
                        <span class="title fw-bold">Sri Lanka's best Art Gallery Ever...</span>
                    </div>
                    <a href="userSignup.php" class="btn btn-light-red px-3 px-lg-4 py-1 py-lg-2">Sign Up</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-12 mt-5">
                <div class="row d-flex justify-content-center align-items-center ">
                    <?php  
                    
                    $paints_rs = Database::search("SELECT * FROM `paint` ORDER BY
                    `datetime_added` DESC LIMIT 3");
                    $paint_num = $paints_rs->num_rows;

                    for ($i=0; $i < $paint_num; $i++) { 
                        $paint_data = $paints_rs->fetch_assoc();
                        ?>
                    <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center g-3">
                        <div class="card text-center" style="width: 18rem;">
                            <?php
                            $img_rs = Database::search("SELECT * FROM `images` WHERE `paint_id` = '".$paint_data["id"]."'");
                            $img_data = $img_rs->fetch_assoc();
                            ?>
                            <img src="<?php echo 'middlewares/'. $img_data["path"]; ?>" class="card-img-top"
                                style="height: 300px; width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $paint_data["title"] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Rs. <?php echo $paint_data["price"] ?>. 00</li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-12 pt-3">
                <hr class="hr-line-red">
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            <div class="row">
                                <span class="text-center fs-3 text-gray-dark pt-3">
                                    Arts For Life
                                </span>
                                <span class="fs-4 text-gray-light text-center pt-5">Make
                                    Your Home Asthetic to your eyes with our
                                    finnest art collections.
                                    Your Wall is rich with our design.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            <div class="row">
                                <div class="img-wall-paint"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-5">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            <div class="row">
                                <div class="img-wall-paint2"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-none d-md-block">
                        <div class="col-12">
                            <div class="row">
                                <span class="text-center fs-3 text-gray-dark pt-3">
                                    Arts For Life
                                </span>
                                <span class="fs-4 text-gray-light text-center pt-5">Make
                                    Your Home Asthetic to your eyes with our
                                    finnest art collections.
                                    Your Wall is rich with our design.</span>
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
</body>

</html>