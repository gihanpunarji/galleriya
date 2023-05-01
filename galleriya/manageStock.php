<?php

session_start();
require "connection/connection.php";

if ($_SESSION["admin"]) {
    Database::search("SELECT * FROM `paint`");

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management | Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">


    <!-- Bootstrap Icon CDN -->

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="icon" href="resources/svg/logo-black.svg">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center mt-3">
            <div class="col-8 col-md-8">
                <input type="text" id="search" class="form-control" placeholder="Search product here...">
            </div>
            <div class="col-4 col-md-2">
                <button onclick="searchPaints('x');" class="btn btn-light-red ms-2" autocomplete="off">Search
                </button>
            </div>
        </div>
        <div class="col-12 px-3 mt-4">
            <form action="" method="post" id="myform">
                <select name="paints" class="form-select" aria-label="Default select example">
                    <?php
            
            $paint_rs = Database::search("SELECT * FROM `paint`");
            $paint_num = $paint_rs->num_rows;
            for ($i=0; $i < $paint_num; $i++) { 
                $data = $paint_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $data["id"] ?>"><?php echo $data["title"] ?></option>
                    <?php
            }
            ?>
                </select>
                <br><input type="submit" name="submit" class="form-input" value="Select" id="submit-btn">
            </form>
            <div class="col-12 mt-4">
                <div class="d-flex justify-content-between">
                    <h5 class="row-title">Id</h5>
                    <h5 class="row-title">Name</h5>
                    <h5 class="row-title">Current Stock</h5>
                    <h5 class="row-title">Add Stock</h5>
                </div>
            </div>
            <?php  
        if(isset($_POST['submit'])){  
        if(!empty($_POST['paints'])) {  
            $selected = $_POST['paints'];
            $paint_rs2 = Database::search("SELECT * FROM `paint` WHERE `id` = '".$selected."' ");
            $data2 = $paint_rs2->fetch_assoc();  
             ?>
            <div class="col-12 mt-4">
                <div class="d-flex justify-content-between">
                    <h6 class="row-title"><?php echo $selected ?></h6>
                    <h6 class="row-title"><?php echo $data2["title"] ?></h6>
                    <h6 class="row-title"><?php echo $data2["qty"] ?></h6>
                    <input type="number" class="form-input" min="0" id="stock">

                </div>
                <a class="btn btn-light-red btn-sm w-100 mt-4" onclick="addStock('<?php echo $selected ?>')">
                    Add
                </a>
            </div>
            <?php
        } else {  
            echo 'Please select the value.';  
        }  
        }  
    ?>
        </div>
    </div>
    <script src=" javascript/admin.js"></script>
</body>

</html>
<?php
} else {
    ?>
<h1>405 Bad Request</h1>
<?php
}


?>