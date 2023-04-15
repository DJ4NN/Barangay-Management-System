<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    require ("PHPMailer/PHPMailer/src/PHPMailer.php");
    require("PHPMailer/PHPMailer/src/SMTP.php");
    require("PHPMailer/PHPMailer/src/Exception.php");



        function sendMail($email,$otp){







            try {
                $mail = new PHPMailer(true);
                //Server settings
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'mendezstephen26@gmail.com';    //don't forget the email                 //SMTP username // email username
                $mail->Password   = 'rkdtewtnqrjbvyae';     // passowrd                          //SMTP // email password password
                $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->SetFrom('mendezstephen26@gmail.com');
                $mail->addAddress($email);
                      //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "OTP";
                $mail->Body    = "This is your otp ".$otp." Please don't reply" ;

                $mail->send();
                return true;
            }
            catch (Exception $e) {
                return false;
            }



        }



                ?>

<?php
session_start();
date_default_timezone_set('Asia/Manila');
$conn = new mysqli("localhost", "root" , "", "bms_db");
	if(isset($_SESSION['username'])){
		header('Location: dashboard.php');
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
                <form method="POST" action="forgot-password.php">
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




<?php


if(isset($_POST['submit'])){

    $email = $_POST['email'];

    $validation_reg = "SELECT `email` FROM `tbl_users` WHERE email = '$email' ";
    $validate = mysqli_query($conn,$validation_reg);

    if(mysqli_num_rows($validate) > 0){

        $otp = rand(9999, 1111);
        // echo $otp;
        // print_r($validate);
        //hashing of otp
        $hashed_otp = password_hash($otp,PASSWORD_DEFAULT);

        if(sendMail($email,$otp)){

            $query_otp = " INSERT INTO reset_password (code, email) VALUES('$hashed_otp', '$email')";
            $send_query_otp = mysqli_query($conn,$query_otp);

            $timestamp =  $_SERVER["REQUEST_TIME"];  
            // generate the timestamp when otp is forwarded to user email/mobile.
            $_SESSION['time'] = $timestamp;
            $_SESSION['email'] = $email;
            $_SESSION['otp'] = $otp;
            header("Location: otp-password.php");
            // $query_otp = "UPDATE `reset_password` SET `code`='$hashed_otp' WHERE email = '$email'";
            // insert the database of the otp

        }


        //    else{
        //    }
    }else{
        echo "<script>alert('Something went wrong!')</script>";
        // echo"invalid";
    }




}

