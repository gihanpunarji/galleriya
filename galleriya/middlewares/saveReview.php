<?php
require "../connection/connection.php";

$id = $_POST["id"];
$email = $_POST["e"];
$feedback = $_POST["m"];

if(!empty($feedback)) {
$record = Database::search("SELECT * FROM `review` WHERE `user_email` = '".$email."'
AND `paint_id` = '".$id."'")->num_rows;

if ($record == 0) {
    Database::iud("INSERT INTO `review` (`rating`, `review`, `user_email`, `paint_id`) VALUES 
    ('4', '".$feedback."', '".$email."', '".$id."')");
} else {
    Database::iud("UPDATE `review` 
    SET `rating` = '4',
    `review` = '".$feedback."' WHERE `user_email` = '".$email."'
    AND `paint_id` = '".$id."'");
}

echo "1";
} else {
    echo "Please add something";
}


?>