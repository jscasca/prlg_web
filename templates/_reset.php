<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("templates/__header.php");
	//maybe just styless and favicon?
	?>
	<title><?php echo getTranslation('Reset your password'); ?></title>
</head>
<body class="body-background">
	<div class="reset forgotten full-body">
		<section class="centered-section opaque">
			<div class="header">
				<a href="index.php"><img src="<?php echo $rootpath;?>img/prologes.png" /></a>
			</div>
			<div class="content">
				<?php
				if(isset($sent) && $sent === true) {
				?>
				<h5><?php echo getTranslation('Your password has been updated!'); ?></h5>
				<a href='login'><?php echo getTranslation("Log in with your new password");?></a>
				<?php
				} else {
				?>
				<h2><?php echo getTranslation('Reset your password'); ?></h2>

				<h5><?php echo getTranslation('Enter your new password'); ?></h5>
				<form action="reset" method="POST" class="Login-form" id="reset--form">
					<?php
					if(isset($_REQUEST['token'])) {
						//print the token
						echo "<input type='hidden' name='token' id='token' value='".$_REQUEST['token']."' />";
					}
					?>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="fa fa-lock"></span></div>
							<input type="password" class="form-control" placeholder="<?php echo getTranslation('New password'); ?>" name="pwd" id="pwd">
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><span class="fa fa-lock"></span></div>
							<input type="password" class="form-control" placeholder="<?php echo getTranslation('Confirm new password'); ?>" name="pwdCnf" id="pwdCnf">
						</div>
					</div>
					<div id="error-msg" class="error-msg"></div>
					<button type="send" class="btn main-btn"><?php echo getTranslation('Update password'); ?></button>
					<h5><?php echo getTranslation('Already have an account?'); ?> <a href="login"><?php echo getTranslation('Log in'); ?></a></h5>
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
	</div>

</body>
</html>
<script type="text/javascript">

$('#reset--form').submit(function() {
	$('#error-msg').empty();

	var pwd = $('#pwd');
	var pwd2 = $('#pwdCnf');

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
</script>