<?php

require "connection/connection.php";
session_start();

    $id = $_GET["id"];
    $email = $_GET["e"];

    if(isset($_SESSION['user'])) {
        $user = Database::search("SELECT * FROM `invoice` 
    WHERE `user_email` = '".$_SESSION['user']['email']."'")->fetch_assoc();

    if (isset($user)) {
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Paint</title>

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
            <div class="row">
                <div class="col-12 text-center mt-3">
                    <h1>Product Purchased Successful</h1>
                </div>
                <div class="col-12">
                    <h6>Write something</h6>
                    <div class="col-md-12">
                        <div class="mt-2">
                            <textarea type="text" id="message" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-between mt-2">
                    <div>
                        <h6>Give rating</h6>
                    </div>
                    <div>
                        <a class="btn btn-sm btn-light-red px-5"
                            onclick="postReview('<?php echo $id ?>', '<?php echo $email ?>')">Post</a>
                    </div>
                </div>
                <div class="col-12">
                    <a href="<?php echo "invoice.php?id=" .$id. "&e=". $email ?>">Skip to Invoice</a>
                </div>
            </div>
        </div>
    </div>
    <script src="javaScript/script.js"></script>
</body>

</html>
<?php
        } else {
            echo "405 Bad Request";
        }
    } else {
        echo "405 Bad Request";
    }

?>