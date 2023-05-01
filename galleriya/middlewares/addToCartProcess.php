<?php 

session_start();

require "../connection/connection.php";

if(isset($_SESSION["user"])) {
    if(isset($_GET["id"])) {

        $pid = $_GET["id"];
        $userMail = $_SESSION["user"]["email"];

        $cart_item_table = Database::search("SELECT * FROM `cart_item` WHERE `user_email` = '".$userMail."' AND
        `paint_id` = '".$pid."'");

        if($cart_item_table->num_rows != 0) {
            echo "Item has already added to the cart";
        } else {
            Database::iud("INSERT INTO `cart_item` (`qty`, `user_email`, `paint_id`)
            VALUES ('1', '".$userMail."', '".$pid."')");
            echo "added successfully";
        }
        
    }
}
?>