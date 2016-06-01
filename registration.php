<?php
require_once '/var/www/html/prologes/php/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';
session_start();

include 'php/fb-login.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrate a Prologes</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
			<form action="php/submit/registration.php" method="POST" class="Login-form" id="registration--form">
				<div class="form-group">
					<label class="sr-only" for="">Usuario</label>
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-user"></span></div>
				        <input type="text" class="form-control" placeholder="Usuario" name="user" id="username">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Correo Electrónico</label>
				    <div class="input-group">
				        <div class="input-group-addon register-addon"><span class="fa fa-envelope"></span></div>
				        <input type="text" class="form-control" placeholder="ej. juan@micorreo.com" name="email" id="email">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Contraseña</label>
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder="Contraseña" name="pwd" id="pwd">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Contraseña</label>
				    <div class="input-group">
				        <div class="input-group-addon register-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder=" Repetir Contraseña" name="pwdConfirmation" id="pwd2">
				    </div>
				</div>
				<div id="error-msg"></div>
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
<script type="text/javascript">
$('#registration--form').submit(function() {
	$('#error-msg').empty();
	var userInput = $('#username');
	var email = $('#email');
	var pwd = $('#pwd');
	var pwd2 = $('#pwd2');
	var username = userInput.val();
	if(username == '' || username == undefined) {
		displayFormViolation(userInput, 'Selecciona un nombre de usuario');
		return false;
	}
	if(username.length < 3 || username.length > 25) {
		displayFormViolation(userInput, 'El nombre de usuario tiene que tener entre 3 y 25 caracteres');
		return false;
	}
	if(!(/^[a-zA-Z0-9_]{1,24}$/.test(username))) {
		displayFormViolation(userInput, 'Tu usuario solo puede usar letras, numeros y guiones bajos');
		return false;
	}
	removeFormViolation(userInput);
	if(!(/^[a-zA-Z0-9\.]+@.+\.[a-z]{2,3}$/).test(email.val())) {
		displayFormViolation(email, 'Tu correo no es valido');
		return false;
	}
	removeFormViolation(email);
	if(pwd.val().length < 6) {
		displayFormViolation(pwd, 'Tu contraseña debe tener al menos 6 caracteres'); return false;
	}
	removeFormViolation(pwd);
	if(pwd.val() != pwd2.val()) {
		displayFormViolation(pwd2, 'Tu contraseña no coincide'); return false;
	}
	removeFormViolation(pwd2);
	checkUsernameAvailability(username);
	return false;
});

$(document).ready(function() {
	
});

function removeFormViolation(input) {
	input.css({border: '1px solid #3fb0ac', 'box-shadow':'0 0 5px #3fb0ac'});
}

function displayFormViolation(input, msg) {
	$('#error-msg').append("<p>"+msg+"</p>");
	input.css({border: '1px solid red', 'box-shadow': '0 0 5px red'});
	input.focus();
}

function checkUsernameAvailability(username) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getUsernameAvailability.php',
	  data: {username: username},
	  success: function(data){
			if(data === true) {
				$('#registration--form').submit();
			} else {
				displayFormViolation($('#username'), 'El nombre de usuario <i>'+username+'</i> ya esta tomado');
			}
		  }
	});
}
</script>
