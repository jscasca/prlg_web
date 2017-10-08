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
			<h5>Recibiras un correo con instrucciones de como cambiar tu contraseña!</h5>
			<?php
			} else {
			?>
			<h3>Olvidaste tu contraseña?</h3>

			<?php
				if(isset($_REQUEST['e']))echo "<h4 class='error'>The token you provided has already expired.</h4>"; 
			?>
			<h5>Introduce tu nombre de usuario o correo para recuperar tu contraseña</h5>
			<form action="../php/submit/forgotten.php" method="POST" class="Login-form" id="registration--form">
				<div class="form-group">
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-user"></span></div>
				        <input type="text" class="form-control" placeholder="Usuario o correo" name="user" id="user">
				    </div>
				</div>
				<div id="error-msg"></div>
				<button type="send" class="btn Basic-button Green-button">Enviar</button>
				<h5>Ya eres miembro? <a href="login.php">Accede</a></h5>
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
