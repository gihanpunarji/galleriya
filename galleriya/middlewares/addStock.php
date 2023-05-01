<?php  

session_start();
require "../connection/connection.php";

if (!isset($_SESSION["admin"])) {
    ?>
<h1>505, Bad Request</h1>
<?php
} else {
    $qty = $_GET["q"];
    $id = $_GET["id"];
    Database::iud("UPDATE `paint` SET `qty` = '".$qty."' 
    WHERE `id` =  '".$id."' ");
    echo "Added Succesfully";
}

?>