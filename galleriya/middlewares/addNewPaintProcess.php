<?php 

session_start();
require "../connection/connection.php";

if(isset($_SESSION["admin"])) {

    $title = $_POST["t"];
    $category = $_POST["c"];
    $des = $_POST["des"];
    $artist_name = $_POST["an"];
    $del = $_POST["del"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    
    if(!isset($_FILES["img"])) {
        echo "Select an image";
    } else if (empty($title)) {
        echo "Please add a title";
    } else if ($category == "0") {
        echo "Please select a category";
    } else if (empty($des)) {
        echo "Please enter a description";
    }else if (empty($artist_name)) {
        echo "Please enter the artist name";
    }else if (empty($del)) {
        echo "Please add a delivery fee";
    } else if (empty($price)) {
        echo "Please add a price";
    } else if (empty($qty)) {
        echo "Please add the amount"; 
    } else {

        Database::search("SELECT * FROM `paint`");
        
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $image = $_FILES["img"];
        // Check file type using MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $image["tmp_name"]);
        finfo_close($finfo);

        $allowed_image_types = array("image/jpeg", "image/png", "image/jpeg", "image/svg+xml");

        if(!in_array($file_type, $allowed_image_types)) {
            echo "Please select a valid image type";
        } else {
            // Check file size limit
            $max_size = 10485760; // 1 MB
            if($image["size"] > $max_size) {
                echo "File size exceeded limit.";
            } else {
                // Check file name and extension
                $file_ext = pathinfo($image["name"], PATHINFO_EXTENSION);
                $allowed_image_extensions = array("jpg", "jpeg", "png", ".svg");

                $paint_id = Database::$connection->insert_id;

                if(!in_array(strtolower($file_ext), $allowed_image_extensions)) {
                    echo "Invalid file extension.";
                } else {

                    Database::iud("INSERT INTO `paint` (`title`, `description`, `price`, `qty`, `datetime_added`, `delivery_fee`, `artist`, `category_id`) 
                    VALUES ('".$title."', '".$des."', '".$price."', '".$qty."', '".$date."', '".$del."', '".$artist_name."', '".$category."')");

                    $pid = Database::$connection->insert_id;

                    $dir = "resources/arts/";
                    // Set file name and location
                    $file_name = "paint_" . uniqid() . "." . $file_ext;
                    $file_location = $dir . $file_name;

                    // Check file permissions
                    if(!is_writable($dir)) {
                        echo "Destination folder is not writable.";
                    } else {    
                        // Move uploaded file to destination
                        if(move_uploaded_file($image["tmp_name"], $file_location)) {
                            // echo "File uploaded successfully.";
                            
                        } else {
                            echo "Error uploading file.";
                        }
                    }
                    Database::iud("INSERT INTO `images` (`path`, `paint_id`) VALUES
                            ('".$file_location."', '".$pid."')");
                }
                echo "success";
            }
        }
    }

}

?>