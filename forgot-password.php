<?php
// include "server/server.php";
$conn = mysqli_connect('localhost', 'root', '') or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($conn, 'bms_db' ) or die(mysqli_error($conn));
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    require ("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");



        function sendMail($email,$otp){


            try {
                $mail = new PHPMailer(true);
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'zoeamara03@gmail.com';    //don't forget the email                 //SMTP username // email username
                $mail->Password   = 'nrapvbuhoctiqump';     // passowrd                          //SMTP // email password password
                $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->SetFrom('zoeamara03@gmail.com');
                $mail->addAddress($email);
                      //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "OTP";
                $mail->Body    = "This is your otp ".$otp." Please don't reply" ;

                $mail->send();
                echo "<script>alert('Success')</script>";

                // return true;
            }
            catch (Exception $e) {
                return false;
                echo "<script>alert('feld')</script>";

            }



        }



                ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
	<title>Login -  Barangay Management System</title>

<body class="login">
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper wrapper-login" style="background-color: #393E46;">

		<div class="container container-login animated fadeIn">

			<h1 class="text-center">Forgot password</h1>
			<div class="login-form">
                <form method="POST" action="forgot.php">
				<div class="form-group form-floating-label">
					<input name="email" type="email"  class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">email</label>
				</div>
				<div class="form-action mb-3">
                    <button type="submit" name="submit" class="btn btn-info btn-rounded btn-login" style="font-size: 16px;">Submit</button>
				</div>
                </form>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>




