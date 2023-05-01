<?php  
session_start();

require "../connection/connection.php";

if (isset($_SESSION["user"])) {
    $user_mail = $_SESSION["user"]["email"];
    if (isset($_GET["id"])) {

        $paint_id = $_GET["id"];

        $cart_item_rs = Database::search("SELECT * FROM `cart_item` WHERE `user_email` = '".$user_mail."' 
        AND `paint_id` = '".$paint_id."' ");

        $cart_item_num = $cart_item_rs->num_rows;

        if ($cart_item_num == 1) {
            Database::iud("DELETE FROM `cart_item` WHERE `user_email` = '".$user_mail."' 
            AND `paint_id` = '".$paint_id."'");
            echo "Removed";
        } else {
        echo "Cannot remove, Please try again later";
        }
    } 

} else {
    echo "Something went wrong 😐";
}
?>