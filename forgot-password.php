<?php
// include "server/server.php";
$conn = mysqli_connect('localhost', 'root', '') or
die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($conn, 'bms_db' ) or die(mysqli_error($conn));
session_start();

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
					<input name="email" type="email" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">email</label>
				</div>
				<div class="form-action mb-3">
                    <input type="submit" value="Submit" name="submit" class="btn btn-info btn-rounded btn-login" style="font-size: 16px;">
                    <!-- <button type="submit" name="submit" class="btn btn-info btn-rounded btn-login" style="font-size: 16px;">Submit</button> -->
				</div>
                </form>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>




