<?php

session_start();
require "../connection/connection.php";

if (isset($_SESSION['user'])) {
    $first_name = $_SESSION['user']['fname'];
    $last_name = $_SESSION['user']['lname'];
    $email = $_SESSION['user']['email'];
    $mobile = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'")->fetch_assoc()["mobile"];

    $array = [];

    $id = $_GET["id"];
    $qty = $_GET["qty"];
    $order_id = uniqid();
    $address;
    $postal_code;
    $amount;
    $merchant_id = "IO15306";
    $currency = "LKR";
    $api = "7acc55dc7caa8ff61d1fe59f52e6571024e8fdc76585882ea955f999e37d09c6";

    $address_table = Database::search("SELECT * FROM `address` a INNER JOIN `user_has_address` uha ON a.id = uha.address_id 
    INNER JOIN `district` d ON a.district_id = d.id
    INNER JOIN `province` p ON d.province_id = p.id WHERE uha.user_email = '" . $email . "'");

if ($address_table->num_rows == 0) {
    echo "0";
} else {
    $address_data = $address_table->fetch_assoc();
    
    $title = Database::search("SELECT * FROM `paint` WHERE `id` = '" . $id . "'")->fetch_assoc()["title"];
    $price = Database::search("SELECT * FROM `paint` WHERE `id` = '" . $id . "'")->fetch_assoc()["price"];
    $delivery_fee = Database::search("SELECT * FROM `paint` WHERE `id` = '" . $id . "'")->fetch_assoc()["delivery_fee"];

    $address = $address_data["line1"] . "," . $address_data["line2"];
    $district = $address_data["district_name"];

    $amount = $price + $delivery_fee;

    $array["id"] = $order_id;
    $array["amount"] = $amount;
    $array["item"] = $title;
    $array["merchant_id"] = $merchant_id;
    $array["first_name"] = $first_name;
    $array["last_name"] = $last_name;
    $array["email"] = $email;
    $array["phone"] = $mobile;
    $array["address"] = $address;
    $array["city"] = $district;
    $array["qty"] = $qty;
    $array["api"] = $api;

    echo json_encode($array);
}
    
} else {
    echo "-1";
}