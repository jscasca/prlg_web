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
	<title>Prologes - Cambia tu contraseña</title>
</head>
<body class="body-fullWidth">
	
	<section class="Registration text-center">
		<div class="Login-header">
			<a href="index.php"><img src="../img/prologes.png" /></a>
		</div>
		<div class="Login-container">
		
		<?php
		if(isset($_REQUEST['sent'])) {
			echo "<h5>Tu contraseña ha sido actualizada!</h5>";
			echo "<a href='login.php'>Inicia sessión con tu nueva contraseña</a>";
		} else {
		?>
			<h3>Cambia tu contraseña!</h3>
			<h5>Introduce tu nueva contraseña</h5>
			<form action="../php/submit/reset.php" method="POST" class="Login-form" id="registration--form">

				<?php
				if(isset($_REQUEST['token'])) {
					//print the token
					echo "<input type='hidden' name='token' id='token' value='".$_REQUEST['token']."' />";
				}
				?>
				<div class="form-group">
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder="Nueva contraseña" name="pwd" id="pwd">
				    </div>
				</div>
				<div class="form-group">
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder="Confirma tu contraseña" name="pwdCnf" id="pwdCnf">
				    </div>
				</div>
				<div id="error-msg"></div>
				<button type="send" class="btn Basic-button Green-button">Enviar</button>
				<h5>Already a member? <a href="login.php">Inicia sesión</a></h5>
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
<script type="text/javascript">
var validUsername = false;

$('#username').change(function() {
	validUsername = false;
});

$('#registration--form').submit(function() {
	$('#error-msg').empty();

	var pwd = $('#pwd');
	var pwd2 = $('#pwdCnf');

	if(pwd.val().length < 6) {
		displayFormViolation(pwd, 'Tu nueva contraseña debe de tener, por lo menos, 6 caracteres'); return false;
	}
	removeFormViolation(pwd);
	if(pwd.val() != pwd2.val()) {
		displayFormViolation(pwd2, 'Las contraseñas son diferentes'); return false;
	}
	removeFormViolation(pwd2);
	console.log('submitting');
	return true;
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
	validUsername = false;
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: '../php/ajax/getUsernameAvailability.php',
	  data: {username: username},
	  success: function(data){
	  	console.log(data);
	  	console.log('return');
			if(data === true) {
				validUsername = true;
				$('#registration--form').submit();
			} else {
				displayFormViolation($('#username'), 'The username <i>'+username+'</i> is already taken');
			}
		  }
	});
}
</script>
