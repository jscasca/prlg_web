<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include('templates/__header.php'); ?>
	<title><?php echo getTranslation('Log in'); ?></title>
</head>
<body class="body-fullWidth">
	
	<section class="Login text-center">
		<div class="Login-header">
			<a href="index"><img src="img/prologes.png" /></a>
		</div>
		<div class="Login-container">
			<h5><?php echo getTranslation('Start using Prologues by login in with your user and password'); ?></h5>
			<form action="login" method="POST" class="Login-form">
				<?php
				if(isset($failureToLogin)) {
					?>
					<div class="login-error">
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
				<button type="send" class="btn Basic-button Green-button"><?php echo getTranslation('Log in'); ?></button>
				<h5><?php echo getTranslation('Not a member?'); ?> <a href="register"><?php echo getTranslation('Sign up!'); ?></a></h5>
				<h5><a href="forgotten"><?php echo getTranslation('Forgot your password?'); ?></a></h5>
				<!--<h6>O utiliza tus redes sociales</h6>
				<div class="Login-buttonContainer">
					<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn Facebook-button">Facebook</a>
					<a href="#" class="btn Google-button">Google</a>
				</div>-->
			</form>
		</div>
	</section>

</body>
</html>