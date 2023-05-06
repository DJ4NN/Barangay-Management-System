
<?php

$conn = new mysqli("localhost", "root" , "", "bms_db");

if($conn == FALSE){
    echo "error";
}

session_start();
$email = $_SESSION['email'];
date_default_timezone_set('Asia/Manila');

if(empty($_SESSION['email'])){
    echo "<script>window.location.href='login.php' </script>";
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
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                    <?= $_SESSION['message']; ?>
                </div>
            <?php unset($_SESSION['message']); ?>
            <?php endif ?>
			<h1 class="text-center">Reset Password</h1>
			<div class="login-form">
                <form method="POST" action="">
				<div class="form-group form-floating-label">
					<input id="username" name="password" type="password" maxlength="20" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Password</label>
				</div>

                <div class="form-group form-floating-label">
					<input id="username" name="new-password" type="password" maxlength="20" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Confirm Password</label>
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

    $pass = $_POST['password'];
    $new_pass = $_POST['new-password'];
    $dateUpdated = date("Y-m-d h:i:a");
    // $new_password = password_hash($pass,PASSWORD_DEFAULT);

    // checking

    if(empty($pass)){

        echo "<script>alert('Please put  password')</script>";

    }

    elseif(empty($new_pass)){

        echo "<script>alert('Please put second password')</script>";

    }

    else{

        if($pass == $new_pass){
            //hashing


            $pass_update = "UPDATE `tbl_users` SET `password`='$pass' WHERE email = '$email'";
            $run_update = mysqli_query($conn, $pass_update);

            if($run_update){
                session_destroy();
                unset($_SESSION['email']);
                echo "<script>window.location.href='dashboard.php'</script>";
                exit();
            }


            else{

                echo "<script>Password is not match</script>";

            }

        }



    }





}
?>
