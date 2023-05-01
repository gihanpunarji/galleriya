<?php

require "../connection/connection.php";

$email = $_POST["e"];
$vocde = $_POST["vc"];
$password = $_POST["npw"];

if (empty($email)) {
    echo "Please enter the email";
} else if (empty($vocde)) {
    echo "Please enter the verification code";
} else if (empty($password)) {
    echo "Please enter the new password";
}  else if (strlen($password) < 5 || (strlen($password) > 20)) {
    echo "Please enter the new password";
} else {
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND
    `verification_code` = '".$vocde."'");

    $rs_num = $rs->num_rows;

    if ($rs_num == 1) {
        Database::iud("UPDATE `user` SET `password` = '".$password."' WHERE `email` = '".$email."'");
        echo "success";
    } else {
        echo "Invalid verification code";
    }
}

?>