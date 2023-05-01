<?php  

require "../connection/connection.php";

require "../SMTP.php";
require "../PHPMailer.php";
require "../Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET['e'])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
    $n = $rs->num_rows;

    if($n == 1) {

        $code = uniqid();

        Database::iud("UPDATE `user` SET `verification_code` = '".$code."' WHERE `email` = '".$email."'");

         // email code
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gihanpunarji@gmail.com';
            $mail->Password = 'lkfoyaihqwtxbvto';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('gihanpunarji@gmail.com', 'Reset Password');
            $mail->addReplyTo('gihanpunarji@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Galleriya.com Reset Password Verification Code';
            $bodyContent = '<h1 style="color:green">Your Verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()) {
                echo "Verification code send failed";
            } else {
                echo "success";
            }

    } else {
        echo("Enter your email");
    }
}


?>