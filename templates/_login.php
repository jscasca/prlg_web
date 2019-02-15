<?php

?>
<!DOCTYPE html>
<!-- <html lang="es"> Get this from a translation maybe-->
<html>
<head>
	<?php include('templates/__header.php'); ?>
	<title><?php echo getTranslation('Log in'); ?></title>
</head>
<body class="body-background">
	<div class="forgotten full-body">
		<div class="centered-section opaque">
			<div class="header">
				<a href="#">
				<img src="<?php echo $rootpath;?>img/prologes.png" />
				</a>
			</div>
			<div class="content">
				<h2><?php echo getTranslation('Log In'); ?></h2>
				<form class="login-form" id="registration--form" method="POST" action="login">
					<p><?php echo getTranslation('Start using Prologues by login in with your user and password'); ?></p>
					<?php
					if(isset($failureToLogin)) {
						?>
						<div class="error-msg">
							<p><?php echo getTranslation($failureToLogin); ?></p>
						</div>
						<?php
					}
					?>
					<div class="form-group">
						<label class="sr-only" for=""><?php echo getTranslation('User'); ?></label>
							<div class="input-group">
									<div class="input-group-addon"><span class="fa fa-user"></span></div>
									<input type="text" class="form-control" placeholder="<?php echo getTranslation('User'); ?>" name="user">
							</div>
					</div>
					<div class="form-group">
						<label class="sr-only" for=""><?php echo getTranslation('Password'); ?></label>
							<div class="input-group">
									<div class="input-group-addon"><span class="fa fa-lock"></span></div>
									<input type="password" class="form-control" placeholder="<?php echo getTranslation('Password'); ?>" name="pwd">
							</div>
					</div>
					<button type="send" class="btn main-btn"><?php echo getTranslation('Log in'); ?></button>
				</form>
				<h5><?php echo getTranslation('Not a member?'); ?> <a href="register"><?php echo getTranslation('Sign up!'); ?></a></h5>
				<h5><a href="forgotten"><?php echo getTranslation('Forgot your password?'); ?></a></h5>
				<!--<h6>O utiliza tus redes sociales</h6>
				<div class="Login-buttonContainer">
					<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn Facebook-button">Facebook</a>
					<a href="#" class="btn Google-button">Google</a>
				</div>-->
			</div>
		</div>
	</div>

</body>
</html>