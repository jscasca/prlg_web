<?php
session_start();
include '_lang.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("../_header.php");
	?>
	<title>Prologes - Reset your password</title>
</head>
<body class="body-fullWidth">
	
	<section class="Registration text-center">
		<div class="Login-header">
			<a href="index.php"><img src="../img/prologes.png" /></a>
		</div>
		<div class="Login-container">
			<?php
			if(isset($_REQUEST['sent'])) {
			?>
			<h5>An email has been sent with instructions on how to reset your password!</h5>
			<?php
			} else {
			?>
			<h3>Forgotten your password?</h3>

			<?php
				if(isset($_REQUEST['e']))echo "<h4 class='error'>The token you provided has already expired.</h4>"; 
			?>
			<h5>Enter your username or email address to reset your password</h5>
			<form action="../php/submit/forgotten.php" method="POST" class="Login-form" id="registration--form">
				<div class="form-group">
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-user"></span></div>
				        <input type="text" class="form-control" placeholder="Email or username" name="user" id="user">
				    </div>
				</div>
				<div id="error-msg"></div>
				<button type="send" class="btn Basic-button Green-button">Submit</button>
				<h5>Already a member? <a href="login.php">Log In</a></h5>
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