<?php 

session_start();

require "connection/connection.php";

$mobile = $_POST["m"];
$addr1 = $_POST["ad1"];
$addr2 = $_POST["ad2"];
$pcode = $_POST["pc"];
$province = $_POST["pr"];
$district = $_POST["d"];


$email = $_SESSION["user"]["email"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' ");
$user_data = $user_rs->fetch_assoc();

if(isset($_FILES["image"])) {
    $image = $_FILES["image"];
    echo $image;


    $allowed_img_ext = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    $file_ext = $image["type"];


    if(!in_array($file_ext, $allowed_img_ext)) {
        echo "Please select a valid image type";
    } else {
        $new_file_ext;

        if ($file_ext == "image/jpg") {
            $new_file_ext = ".jpg";
        } else if ($file_ext == "image/jpeg") {
            $new_file_ext = ".jpeg";
        } else if ($file_ext == "image/png") {
            $new_file_ext = ".png";
        }  else if ($file_ext == "image/svg+xml") {
            $new_file_ext = ".svg";
        } 


        $file_location = "resources/profile_images/" . $_SESSION["user"]["fname"] . "_" . uniqid() . $new_file_ext;

        move_uploaded_file($image["tmp_name"], $file_location);


        $img_rs = Database::search("SELECT * FROM `profile_images` WHERE `user_email` = '".$email."'");

        $img_num = $img_rs->num_rows;

        if($img_num == 1) {
            Database::iud("UPDATE `profile_images` SET `path` = '".$file_name."' WHERE `user_email` = '".$email."'");
        } else {
            Database::iud("INSERT INTO `profile_images` (`path`, `user_email`) VALUES ('". $file_name ."', '".$email."')");
        }
    }
}


    if(empty($mobile)) {
        echo "Please enter the mobile number";
    } else if (empty($addr1)) {
        echo "Please enter the address line 1";
    } else if (empty($pcode)) {
        echo "Please enter the postal code";
    } else if ($province == '0') {
        echo "Please select the province";
    } else if ($district== '0') {
        echo "Please select the district";
    } else {

        // CHECK THE INSERTING AND THE UPDATING PROCESS

        Database::iud("UPDATE `user` SET `mobile` = '".$mobile."' WHERE `email` = '".$email."'");

        $address_table = Database::search("SELECT * FROM `address`");
        $uha_table = Database::search("SELECT * FROM `user_has_address`");
        $province_table = Database::search("SELECT * FROM `province`");
        $district_table = Database::search("SELECT * FROM `district`");

        // Insert
        Database::iud("INSERT IGNORE INTO `address` (`line1`, `line2`, `postal_code`, `district_id`)
        VALUES ('".$addr1."', '".$addr2."', '".$pcode."', '".$district."')");

        $address_id = Database::$connection->insert_id;
        
        // Insert
        Database::iud("INSERT IGNORE INTO `user_has_address` (`user_email`, `address_id`)
        VALUES ('".$email."', '".$address_id."')");




        echo "success";
    
}