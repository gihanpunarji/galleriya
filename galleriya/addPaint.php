<?php

require "connection/connection.php";

session_start();

if(isset($_SESSION["admin"])) {

     ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Paint | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">


    <!-- Bootstrap Icon CDN -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="resources/svg/logo-black.svg">
</head>

<body>

    <div class="container">
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    <div class="text-center fw-bold fs-2 mt-3">Add a paint to the shop</div>
                </div>
                <div class="col-12">
                    <hr>
                </div>
                <div class="col-12 gap-2" style="display: flex; justify-content: center;">
                    <div class="left-div col-12 col-md-6">
                        <div class="col-12">
                            <div class="col-12">
                                <span class="fw-bold">Title</span>
                                <input type="text" class="form-control" id="title">
                            </div>
                        </div>
                        <?php
                        // $category_rs = Database::search("SELECT * FROM `paint` INNER JOIN `paint_has_category` ON `id` = `paint_has_category`.`paint_id` 
                        // INNER JOIN `category` ON `paint_has_category`.`paint_id` = `category`.`id`");

                        $category_rs = Database::search("SELECT * FROM `category`");
                        ?>
                        <div class="col-12">
                            <div class="col-12">
                                <span class="fw-bold">Category</span>
                                <select class="form-select" id="category">
                                    <option value="0">Select</option>
                                    <?php
                                    for ($i=0; $i < $category_rs->num_rows; $i++) { 
                                        $category_row = $category_rs->fetch_assoc();
                                        ?>
                                    <option value="<?php echo $category_row["id"] ?>">
                                        <?php echo $category_row["category_name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12">
                                <span class="fw-bold">Artist Name</span>
                                <input type="text" class="form-control" id="artist_name">
                            </div>
                        </div>

                        <div class="col-12 d-flex gap-3">
                            <div class="left-div">
                                <label for="dwk" class="form-check-label">Delivery Fee</label>
                                <input Placeholder="Rs.100" type="text" class="form-control" id="delivery">
                            </div>
                            <div class="left-div">
                                <label for="dwk" class="form-check-label">Price</label>
                                <input Placeholder="Rs.100" type="text" class="form-control" id="price">
                            </div>
                            <div class="left-div">
                                <label for="dwk" class="form-check-label">Quantity</label>
                                <input Placeholder="Amount" type="text" class="form-control" id="qty">
                            </div>
                        </div>
                        <div class="col-12">
                            <img src="resources/empty.svg" height="200" width="200" id="img"><br>
                            <input onclick="addPhoto2();" accept="image/*" type="file" id="paint_img">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="col-12">
                            <span class="fw-bold">Description</span>
                            <textarea cols="30" rows="10" class="form-control" id="des"></textarea>
                        </div>
                        <div class="col-12 mt-md-4">
                            <button class="btn btn-light-red" onclick="addNewPaint();">Add New Paint</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include "components/footer.php";?>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="Javascript/script.js"></script>
</body>

</html>
<?php
} else {
    ?>
<h1 class="text-center">404 Page Not found</h1>
<?php
}

?>