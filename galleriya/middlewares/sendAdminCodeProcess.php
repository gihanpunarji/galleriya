<?php  

require "../connection/connection.php";

require "../SMTP.php";
require "../PHPMailer.php";
require "../Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET['e'])) {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `admin` WHERE `email` = '".$email."'");
    $n = $rs->num_rows;

    if($n == 1) {

        $code = random_int(100000, 999999);

        Database::iud("UPDATE `admin` SET `verification_code` = '".$code."' WHERE `email` = '".$email."'");

         // email code
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'gihan.code.test@gmail.com';
            $mail->Password = 'iqeiilodupsnryow';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('gihan.code.test@gmail.com', 'Admin Verification Code');
            $mail->addReplyTo('gihan.code.test@gmail.com', 'Admin Verification Code');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Galleriya.com Admin Verification Code';
            $bodyContent = '<body style="background-color:#fdffcd">
	<table align="center" border="0" cellpadding="0" cellspacing="0"
		width="550" bgcolor="white" style="border:2px solid black">
		<tbody>
			<tr>
				<td align="center">
					<table align="center" border="0" cellpadding="0"
						cellspacing="0" class="col-550" width="550">
						<tbody>
							<tr>
								<td align="center" style="background-color: #4cb96b;
										height: 50px;">

									<a href="#" style="text-decoration: none;">
										<p style="color:white;
												font-weight:bold;">
											Galleriya
										</p>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr style="height: 300px;">
				<td align="center" style="border: none;
						border-bottom: 2px solid #4cb96b;
						padding-right: 20px;padding-left:20px">

					<p style="font-weight: bolder;font-size: 42px;
							letter-spacing: 0.025em;
							color:black;">
						Hello Admin!
						<br> Your Verification Code
					</p>
				</td>
			</tr>

			<tr style="display: inline-block;">
				<td style="height: 150px;
						padding: 20px;
						border: none;
						border-bottom: 2px solid #361B0E;
						background-color: white;">
					
					<h2 style="text-align: left;
							align-items: center;">
						Welcome to the GALLERIYA 2023.
                        The best place to explore awesome ARTs in the country.
				</h2>
                <h4>Your Login Code is ' .$code. '</h4>
					<p class="data"
					style="text-align: justify-all;
							align-items: center;
							font-size: 15px;
							padding-bottom: 12px;">
						Go to the https://galleriya.com for more information and 
                        explore your arts there....
					</p>
                    <p>Thank You.</p>
				</td>
			</tr>
		</tbody>
	</table>
</body>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()) {
                echo "Verification code send failed";
            } else {
                echo "success";
            }

        }
        else {
        echo("Enter your email");
        }   
    } 


?>