<?php
require_once '/var/www/html/prologes/php/facebook-php-sdk-v4-5.0.0/src/Facebook/autoload.php';
session_start();
include '_lang.php';

include '../php/fb-login.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("../_header.php");
	?>
	<title>Sign up to Prologues</title>
</head>
<body class="body-fullWidth">
	
	<section class="Registration text-center">
		<div class="Login-header">
			<img src="../img/prologes.png" />
		</div>
		<div class="Login-container">
			<h5>Start using Prologues by filling up this form</h5>
			<form action="../php/submit/registration.php" method="POST" class="Login-form" id="registration--form">
				<div class="form-group">
					<label class="sr-only" for="">Username</label>
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-user"></span></div>
				        <input type="text" class="form-control" placeholder="Username" name="user" id="username">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Email</label>
				    <div class="input-group">
				        <div class="input-group-addon register-addon"><span class="fa fa-envelope"></span></div>
				        <input type="text" class="form-control" placeholder="ex. john@email.com" name="email" id="email">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Password</label>
				    <div class="input-group">
				        <div class="input-group-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder="Password" name="pwd" id="pwd">
				    </div>
				</div>
				<div class="form-group">
					<label class="sr-only" for="">Password</label>
				    <div class="input-group">
				        <div class="input-group-addon register-addon"><span class="fa fa-lock"></span></div>
				        <input type="password" class="form-control" placeholder="Password Confirmation" name="pwdConfirmation" id="pwd2">
				    </div>
				</div>
				<div id="error-msg"></div>
				<button type="send" class="btn Basic-button Green-button">Sign up</button>
				<h5>Already a member? <a href="login.php">Log In</a></h5>
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
<script type="text/javascript">
var validUsername = false;

$('#username').change(function() {
	validUsername = false;
});

$('#registration--form').submit(function() {
	$('#error-msg').empty();
	var userInput = $('#username');
	var email = $('#email');
	var pwd = $('#pwd');
	var pwd2 = $('#pwd2');
	var username = userInput.val();
	if(username == '' || username == undefined) {
		displayFormViolation(userInput, 'Please type a username');
		return false;
	}
	if(username.length < 3 || username.length > 25) {
		displayFormViolation(userInput, 'The username must be between 3 and 25 characters long');
		return false;
	}
	if(!(/^[a-zA-Z0-9_]{1,24}$/.test(username))) {
		displayFormViolation(userInput, 'The username must contain only letters, numbers and underscores');
		return false;
	}
	if(!validUsername) {
		checkUsernameAvailability(username);
		return false;
	}
	removeFormViolation(userInput);
	if(!(/^[a-zA-Z0-9\.]+@.+\.[a-z]{2,3}$/).test(email.val())) {
		displayFormViolation(email, 'The email is not a valid format');
		return false;
	}
	removeFormViolation(email);
	if(pwd.val().length < 6) {
		displayFormViolation(pwd, 'Your password must be at least 6 characters long'); return false;
	}
	removeFormViolation(pwd);
	if(pwd.val() != pwd2.val()) {
		displayFormViolation(pwd2, 'The password does not match'); return false;
	}
	removeFormViolation(pwd2);
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
