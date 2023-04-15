<?php
	session_start();
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
            <?php if(isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                    <?= $_SESSION['message']; ?>
                </div>
            <?php unset($_SESSION['message']); ?>
            <?php endif ?>
			<h1 class="text-center">Sign In Here</h1>
			<div class="login-form">
                <form method="POST" action="model/login.php">
				<div class="form-group form-floating-label">
					<input id="username" name="username" type="text" maxlength="20" class="form-control input-border-bottom" required>
					<label for="username" class="placeholder">Username</label>
				</div>
				<div class="form-group form-floating-label">
					<input id="password" name="password" type="password" maxlength="20" class="form-control input-border-bottom" required>
					<label for="password" class="placeholder">Password</label>
					<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
					<a href="forgot-password.php" class="text-info text-decoration-none text-start w-100" style="font-weight: 500;">Forgot Password?</a>
				</div>
				<div class="form-action mb-3">
                    <button type="submit" class="btn btn-info btn-rounded btn-login" style="font-size: 16px;">Sign In</button>
				</div>
                </form>
			</div>
		</div>
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>
