<?php

?>
<!DOCTYPE html>
<!-- <html lang="es"> Get this from a translation maybe-->
<html>
<head>
	<?php include('templates/__header.php'); ?>
	<title><?php echo getTranslation('Register'); ?></title>
</head>
<body class="body-background">
	<div class="forgotten full-body">
	
	<section class="centered-section opaque">
		<div class="header">
			<a href="index"><img src="<?php echo $rootpath;?>img/prologes.png" /></a>
		</div>
		<div class="content">
			<h2><<?php echo getTranslation('Join Prologes'); ?></h2>
			<form action="registration" method="POST" class="Login-form" id="registration--form">
				<h5><?php echo getTranslation('Join Prologes by filling this form'); ?></h5>
				<div class="form-group">
					<label class="sr-only" for=""><?php echo getTranslation('Username'); ?></label>
					<div class="input-group">
						<div class="input-group-addon"><span class="fa fa-user"></span></div>
						<input type="text" class="form-control" placeholder="<?php echo getTranslation('Username'); ?>" name="user" id="username">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for=""><?php echo getTranslation('Email'); ?></label>
					<div class="input-group">
						<div class="input-group-addon register-addon"><span class="fa fa-envelope"></span></div>
						<input type="text" class="form-control" placeholder="ex. john@email.com" name="email" id="email">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for=""><?php echo getTranslation('Password'); ?></label>
					<div class="input-group">
						<div class="input-group-addon"><span class="fa fa-lock"></span></div>
						<input type="password" class="form-control" placeholder="<?php echo getTranslation('Password'); ?>" name="pwd" id="pwd">
					</div>
				</div>
				<div class="form-group">
					<label class="sr-only" for=""><?php echo getTranslation('Confirm password'); ?></label>
					<div class="input-group">
						<div class="input-group-addon register-addon"><span class="fa fa-lock"></span></div>
						<input type="password" class="form-control" placeholder="<?php echo getTranslation('Password'); ?>" name="pwdConfirmation" id="pwd2">
					</div>
				</div>
				<div id="error-msg"></div>
				<button type="send" class="btn main-btn"><?php echo getTranslation('Sign up!'); ?></button>
				<!--<h6>O utiliza tus redes sociales</h6>
				<div class="Login-buttonContainer">
					<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn Facebook-button">Facebook</a>
					<a href="#" class="btn Google-button">Google</a>
				</div>-->
			</form>
			<h5><?php echo getTranslation('Already have an account?'); ?> <a href="login"><?php echo getTranslation('Log in'); ?></a></h5>
		</div>
	</section>

	</div>

</body>
</html>
<script type="text/javascript">
var validUsername = false;
var postError = '<?php echo $error === null ? "" : $error; ?>';
var postArgs = '<?php echo $args === null ? "" : $args; ?>';


$(document).ready(function() {
	//check if there is any post error and display error
	if(postError !== '') {
		switch(postError) {
			case 'user': displayError(getSpan('duplicateUser', [postArgs])); break;
			case 'email': displayError(getSpan('duplicateEmail', [postArgs])); break;
			default: displayError(getText('There was an error during registration, please try again later')); break;
		}
	}
});

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
		displayFormViolation(userInput, getText('Please type a username'));
		return false;
	}
	if(username.length < 3 || username.length > 25) {
		displayFormViolation(userInput, getText('The username must be between 3 and 25 characters long'));
		return false;
	}
	if(!(/^[a-zA-Z0-9_]{1,24}$/.test(username))) {
		displayFormViolation(userInput, getText('The username can contain only letters, numbers and underscores'));
		return false;
	}
	if(!validUsername) {
		checkUsernameAvailability(username);
		return false;
	}
	removeFormViolation(userInput);
	if(!(/^[a-zA-Z0-9\.]+@.+\.[a-z]{2,3}$/).test(email.val())) {
		displayFormViolation(email, getText('The email is not a valid format'));
		return false;
	}
	removeFormViolation(email);
	if(pwd.val().length < 6) {
		displayFormViolation(pwd, getText('Your password must be at least 6 characters long')); return false;
	}
	removeFormViolation(pwd);
	if(pwd.val() != pwd2.val()) {
		displayFormViolation(pwd2, getText('Your password does not match')); return false;
	}
	removeFormViolation(pwd2);
	return true;
});

function removeFormViolation(input) {
	input.css({border: '1px solid #3fb0ac', 'box-shadow':'0 0 5px #3fb0ac'});
}

function displayFormViolation(input, msg) {
	displayError(msg);
	input.css({border: '1px solid red', 'box-shadow': '0 0 5px red'});
	input.focus();
}

function displayError(msg) {
	$('#error-msg').append("<p>"+msg+"</p>");
}

function checkUsernameAvailability(username) {
	validUsername = false;
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: AJAX_DIR + 'getUsernameAvailability.php',
	  data: {username: username},
	  success: function(data){
	  	console.log(data);
	  	console.log('return');
			if(data === true) {
				validUsername = true;
				$('#registration--form').submit();
			} else {
				displayFormViolation($('#username'), getSpan('duplicateUser', username));
			}
		  }
	});
}
</script>