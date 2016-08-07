<?php
session_start();

if(isset($_SESSION["SocialLogin"])) {
	//Print all the info
	$socialUser = $_SESSION["SocialLogin"];
	unset($_SESSION["SocialLogin"]);
} else {
	header("Location: ".URL_INTERNAL_SERVER_ERROR);
	die("shouldnt be here");
}

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Prologes: Social Sign Up</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body class="body-fullWidth">
	
	<section class="Registration text-center">
		<div class="Login-header">
			<a href="index.php"><img src="img/prologes.png" /></a>
		</div>
		<div class="Login-container">
			<form action="php/submit/registration.php" method="POST" class="Login-form" id="social-registration--form">
				<input type="hidden" name="user" value="<?php echo $socialUser['id'];?>" >
				<input type="hidden" name="token" value="<?php echo $socialUser['token'];?>" >
				<input type="hidden" name="icon" value="<?php echo $socialUser['icon'];?>" >
				<div class="form-group">
					<div class="registration--avatar">
						<img src="<?php echo $socialUser['icon'];?>" >
					</div>
				</div>
				<h5>Para completar tu registro, selecciona un nombre de usuario único.</h5>
				<div class="form-group">
					<label class="sr-only" for="">Usuario</label>
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-user"></span></div>
				        <input type="text" class="form-control" placeholder="Usuario" name="username" id="username">
				    </div>
				    <div id="error-msg"></div>
				</div>
				<button type="send" class="btn Basic-button Green-button">Registrar</button>
			</form>
		</div>
	</section>

</body>
	<!--<form action="php/submit/socialregistration.php" method="post" >
		<input type="hidden" name="user" value="<?php echo $socialUser['id'];?>" >
		<input type="hidden" name="token" value="<?php echo $socialUser['token'];?>" >
		<input type="hidden" name="icon" value="<?php echo $socialUser['icon'];?>" >
		<input type="text" name="username" id="username">
		<input type="submit">
	</form>-->
</html>
<script type="text/javascript">
var validUsername = false;

$('#username').change(function() {
	validUsername = false;
});

$('#social-registration--form').submit(function() {
	$('#error-msg').empty();
	var userInput = $('#username');
	var username = userInput.val();
	if(username == '' || username == undefined) {
		displayFormViolation(userInput, 'Tienes que seleccionar un nombre de usuario');
		return false;
	}
	if(username.length < 3 || username.length > 25) {
		displayFormViolation(userInput, 'El nombre de usuario tiene que tener entre 3 y 25 caracteres');
		return false;
	}
	if(!validUsername) {
		checkUsernameAvailability(username);
		return false;
	}
	return true;
});

$(document).ready(function() {
	
});

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
				validUsername = true;
				$('#social-registration--form').submit();
			} else {
				displayFormViolation($('#username'), 'El nombre de usuario <i>'+username+'</i> ya esta tomado');
			}
		  }
	});
}
</script>
