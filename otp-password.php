<?php
session_start();
date_default_timezone_set('Asia/Manila');
$conn = new mysqli("localhost", "root" , "", "bms_db");


$email = $_SESSION['email'];




if(empty($email)){
            echo "<script>window.location.href='forgot-password.php' </script>";
        }



        //otp has done

$timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp
if(($timestamp - $_SESSION['time']) > 30000)  // 5 minutes refers to 300 seconds
{

    $update_reset = "UPDATE `reset_password` SET `code`= ' ' WHERE email = '$email' ";
  $run_update = mysqli_query($conn,$update_reset);
echo '<script>alert("Your otp has been expired")</script>' ;

    // delete the otp in the database and alert the person that the otp is expired
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

			<h1 class="text-center">Sign In Here</h1>
			<div class="login-form">
                <form method="POST" action="">
				<div class="form-group form-floating-label">
					<input  name="otp" type="number"  class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">OTP code</label>
				</div>
				<div class="form-action mb-3">
                    <button type="submit" name="submit" class="btn btn-info btn-rounded btn-login" style="font-size: 16px;">Sign In</button>
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

    $otp = $_POST['otp'];




    $query = "SELECT email, code FROM reset_password WHERE email = '$email'";
    $result = mysqli_query($conn,$query);

    if (mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            if (password_verify($otp, $row['code'])){
                
                unset($_SESSION['otp']);
                header("location: change-password.php");
                 die();

            }
            else{
                echo '<script>alert("Incorrect credentials")</script>' ;
                die();
            }





        }










    }






}




?>
