<?php 
session_start();

require "connection/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icon CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <nav class="navbar sticky-top navbar-expand-lg bg-light">
        <div class="container">
            <button class="navbar-toggler shadow-none border border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand hidden" href="index.php">Galleriya</a>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item pe-4">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item pe-4">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item pe-4">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>
                </ul>

            </div>
            <ul class="navbar-nav">
                <li class="nav-item">

                    <a href="cart.php" class="nav-link position-relative"><i class="bi bi-bag"></i> Galleriya Bag
                        <?php
                    if (isset($_SESSION["user"])) {
                        $user_email = $_SESSION["user"]["email"];

                        $cart_rs = Database::search("SELECT * FROM `cart_item` WHERE `user_email` = '".$user_email."'");
                        $cart_num = $cart_rs->num_rows;

                        if($cart_num == 0) {
                            echo "";
                        } else {

                            ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php
                                echo $cart_num;
                                ?>
                        </span>
                        <?php
                            
                        }
               
                        
                    } else {
                        echo "";
                    }
                            ?>

                    </a>
                </li>
            </ul>
        </div>
    </nav>


</body>

</html>