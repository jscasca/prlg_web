<?php

?>
<!DOCTYPE html>
<!-- <html lang="es"> -->
<html>
<head>
	<?php
	include("templates/__header.php");
	//maybe just styless and favicon?
	?>
	<title><?php echo getTranslation('Forgot your password?'); ?></title>
</head>
<body class="body-fullWidth">
	
	<section class="Registration text-center">
		<div class="Login-header">
			<a href="index.php"><img src="<?php echo $rootpath;?>img/prologes.png" /></a>
		</div>
		<div class="Login-container">
			<?php
			if(isset($sent) && $sent === true) {
			?>
			<h5><?php echo getTranslation('An email has been sent with instructions on how to reset your password!'); ?></h5>
			<?php
			} else {
			?>
			<h3><?php echo getTranslation('Forgot your password?'); ?></h3>

			<?php
				if(isset($expired) && $expired === true)echo getTranslation("<h4 class='error'>The token is invalid or has already expired. Please try again.</h4>"); 
			?>
			<h5><?php echo getTranslation('Enter your username or email address to reset your password'); ?></h5>
			<form action="forgotten" method="POST" class="Login-form" id="registration--form">
				<div class="form-group">
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-user"></span></div>
				        <input type="text" class="form-control" placeholder="<?php echo getTranslation('Email or username'); ?>" name="user" id="user">
				    </div>
				</div>
				<div id="error-msg"></div>
				<button type="send" class="btn Basic-button Green-button"><?php echo getTranslation('Submit'); ?></button>
				<h5><?php echo getTranslation('Already have an account?'); ?> <a href="login.php"><?php echo getTranslation('Log in'); ?></a></h5>
				<!--<h6>O utiliza tus redes sociales</h6>
				<div class="Login-buttonContainer">
					<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn Facebook-button">Facebook</a>
					<a href="#" class="btn Google-button">Google</a>
				</div>-->
			</form>
			<?php
			}
			?>
		</div>
	</section>

</body>
</html>