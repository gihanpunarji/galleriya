<?php

require "connection/connection.php";

$email = $_GET["e"];
$id = $_GET["id"];

$invoice_table = Database::search("SELECT * FROM `invoice` WHERE `paint_id` = '".$id."' AND 
`user_email` = '".$email."'");

$invoice_data = $invoice_table->fetch_assoc();
$ref_num = $invoice_data["reference_id"];
$date_of_purchased = $invoice_data["date"];
$total = $invoice_data["total"];

$user_table = Database::search("SELECT * FROM `user` WHERE `email`= '".$email."'");
$user_data = $user_table->fetch_assoc();

$paint_table = Database::search("SELECT * FROM `paint` WHERE `id`= '".$id."'");
$paintr_data = $paint_table->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | Galleriya</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap Icon CDN -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resources/svg/logo-black.svg">

</head>

<body>
    <div class="container mt-6 mb-7">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-xl-7">
                <div class="card">
                    <div class="card-body p-5">
                        <h2>
                            Hey <?php echo $user_data["fname"] . " " . $user_data["lname"] ."," ?>
                        </h2>
                        <p class="fs-sm">
                            This is the receipt for a payment of <strong>Rs.<?php echo $total ?>.00 </strong> you made
                            to
                            buy the paint.
                        </p>

                        <div class="border-top border-gray-200 pt-4 mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Payment No.</div>
                                    <strong>#<?php echo $ref_num ?></strong>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted mb-2">Payment Date</div>
                                    <strong><?php echo $date_of_purchased ?></strong>
                                </div>
                            </div>
                        </div>

                        <div class="border-top border-gray-200 mt-4 py-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-muted mb-2">Client</div>
                                    <strong>
                                        <?php echo $user_data["fname"] . " " . $user_data["lname"] ."," ?>
                                    </strong>
                                    <p class="fs-sm">
                                        <?php

                                        $details_table = Database::search("SELECT * FROM `user_has_address` uha
                                        INNER JOIN `address` a ON uha.address_id = a.id
                                        INNER JOIN `district` d ON a.district_id = d.id 
                                        INNER JOIN `province` p ON d.province_id = p.id 
                                        WHERE uha.user_email = '" . $email. "'");
                                        $details_data = $details_table->fetch_assoc();
                                        ?>
                                        <?php echo $details_data["line1"] . "," . $details_data["line1"]."," . "<br>" .
                                        $details_data["district_name"]?>,<br>
                                        Sri Lanka.
                                        <br>
                                        <a href="#!" class="text-purple"><?php echo $user_data["email"] ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="text-muted mb-2">Payment To</div>
                                    <strong>
                                        Galleriya.com
                                    </strong>
                                    <p class="fs-sm">
                                        102/3 Dehiwala,
                                        Colombo
                                        <br>
                                        <a href="#!" class="text-purple">contact.galleriya@gmail.com
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <table class="table border-bottom border-gray-200 mt-3">
                            <thead>
                                <tr>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Description</th>
                                    <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Amount
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-0"><?php echo $paintr_data["title"] ?></td>
                                    <td class="text-end px-0">Rs.<?php echo $paintr_data["price"] ?>.00</td>
                                </tr>
                                <tr>
                                    <td class="px-0">Delivery Fee</td>
                                    <td class="text-end px-0">Rs.<?php echo $paintr_data["delivery_fee"] ?>.00</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-5">
                            <div class="d-flex justify-content-end">
                                <p class="text-muted me-3">Subtotal:</p>
                                <span>Rs.<?php echo $total ?>.00</span>
                            </div>
                            <div class="d-flex justify-content-end">
                                <p class="text-muted me-3">Discount:</p>
                                <span>-Rs.0</span>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <h5 class="me-3">Total:</h5>
                                <h5 class="text-success">Rs.<?php echo $total ?>.00</h5>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// };

?>