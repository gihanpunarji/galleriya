<?php

session_start();

require "../connection/connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rem_me = $_POST["rm"];

if(empty($email)) {
    echo "Please enter your Emai";
} else if (strlen($email) > 100) {
    echo "Email must have less than 100 characters";
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo"Invalid Email !!!";
} else if(empty($password)) {
    echo "Please enter your Password !!!";
} else if (strlen($password) < 5 || (strlen($password) > 20)) {
    echo"Password must be between 5 - 20 characters";
} else {
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."'");
    $user_num = $user_rs->num_rows;

    if ($user_num == 1) {
        echo "success";
        $data = $user_rs->fetch_assoc();
        $_SESSION["user"] = $data;

        if ($rem_me == "true") {
            setcookie("email", $email, time() + (60*60*24*30));
            setcookie("password", $password, time() + (60*60*24*30));
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }

    } else {
        echo "Invalid Credentials";
    }
}

?>