<?php  

session_start();
require "../connection/connection.php";

$email = $_POST["e"];

if(isset($_POST["e"])) {
    $vcode = $_POST["vc"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."'");
    $admin_data = $admin_rs->fetch_assoc();

    if ($admin_data["verification_code"] == $vcode) {
        $_SESSION["admin"] = $admin_data;
        echo "success";
    } else {       
        echo "Incorrect code";
    }


} else {
    "Register first";
}


?>