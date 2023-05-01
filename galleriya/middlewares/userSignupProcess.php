<?php

require "../connection/connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["pw"];
$rppw = $_POST["rpw"];

if(empty($fname)) {
    echo "Please enter your first name !!!";
} else if (strlen($fname) > 45) {
    echo"First name must have less than 45 characters";
} else if(empty($lname)) {
    echo "Please enter your last name !!!";
} else if (strlen($lname) > 45) {
    echo "Last name must have less than 45 characters";
} else if(empty($email)) {
    echo "Please enter your Emai";
} else if (strlen($email) > 100) {
    echo "Email must have less than 100 characters";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo"Invalid Email !!!";
} else if(empty($password)) {
    echo "Please enter your Password !!!";
} else if (strlen($password) < 5 || (strlen($password) > 20)) {
    echo"Password must be between 5 - 20 characters";
} else if ($password != $rppw){
    echo "Passwords Should be matched";
} else {
    // CHECK IF USER IS ALREADY IN THE DATABASE
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
    $user_num = $user_rs->num_rows;

    if($user_num > 0) {

        echo "Email is already registered. Please Sign in.";

    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        // ADD NEW USER 
        Database::iud("INSERT INTO `user` (`email`, `fname`, `lname`, `password`, `status_id`, `joined_date`,`verification_code`, `mobile`) VALUES
        ('".$email."', '".$fname."', '".$lname."', '".$password."', '1', '".$date."', ' ', ' ')");

        echo "success";
        
    }
}

?>