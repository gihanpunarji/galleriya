<?php

session_start();
require "../connection/connection.php";

if (isset($_SESSION["user"])) {

    $rid = $_POST["rid"];
    $id = $_POST["id"];
    $mail = $_POST["email"];
    $amount = $_POST["amount"];
    $qty = $_POST["qty"];

    $product_rs = Database::search("SELECT * FROM `paint` WHERE `id` = '" . $id . "'");
    $product_data = $product_rs->fetch_assoc();

    $curr_qty = $product_data["qty"];
    $new_qty = $curr_qty - $qty;

    Database::iud("UPDATE `paint` SET `qty` = '" . $new_qty . "' WHERE `id` = '" . $id . "'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice` (`reference_id`, `date`, `total`, `qty`, `status`, `paint_id`, `user_email`) VALUES 
    ('" . $rid . "', '" . $date . "', '" . $amount . "', '" . $qty . "', '1', '" . $id . "', '" . $mail . "')");

    echo "1";
} else {
    echo "Enexpected Error Occured";
}