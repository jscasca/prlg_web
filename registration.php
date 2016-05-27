<?php
require_once '/var/www/html/prologes/php/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';
session_start();

include 'php/fb-login.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrate</title>
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body class="body-fullWidth">
	
	<section class="Registration text-center">
		<div class="Login-header">
			<img src="img/prologes.png" />
		</div>
		<div class="Login-container">
			<h5>Comienza a utilizar Prologes ingresando tus datos
			de acceso a continuación</h5>
			<form action="php/submit/registration.php" method="POST" class="Login-form">
				<div class="form-group">
					<label class="sr-only" for="">Usuario</label>
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-user"></span></div>
				        <input type="text" class="form-control" placeholder="Usuario" name="user">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Correo Electrónico</label>
				    <div class="input-group">
				        <div class="input-group-addon register-addon"><span class="fa fa-envelope"></span></div>
				        <input type="email" class="form-control" placeholder="ej. juan@micorreo.com" name="email">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Contraseña</label>
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder="Contraseña" name="pwd">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Contraseña</label>
				    <div class="input-group">
				        <div class="input-group-addon register-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder=" Repetir Contraseña">
				    </div>
				</div>
				<button type="send" class="btn Basic-button Green-button">Registrar</button>
				<h5>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></h5>
				<h6>O utiliza tus redes sociales</h6>
				<div class="Login-buttonContainer">
					<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn Facebook-button">Facebook</a>
					<!--<a href="#" class="btn Google-button">Google</a>-->
				</div>
			</form>
		</div>
	</section>

</body>
</html>
