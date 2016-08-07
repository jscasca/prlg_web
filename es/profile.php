<?php
session_start();
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("../_header.php");
	?>
	<title>Mi Perfil</title>
</head>
<body>
	<header class="header">
		<?php
		include("_navbar.php");
		?>
	</header>
	
	<div class="container">
		<div class="profile-container">
			<div class="col-md-4 col-sm-12">
				<div class="input-holder" id="displayHolder">
					<span>Nombre</span>
					<div class="">
						<h2 id="userDisplayName"></h2>
					</div>
				</div>
				<div class="input-holder" id="">
					<span>Usuario</span>
					<h3 id="username"></h3>
				</div>
			</div>
			
			<div class="col-md-8 col-sm-12 text-center">
				<div class="profile-avatar">
					<img src="img/defaultuser.png" alt="avatar" id="avatar">
				</div>
				<!--<div class="">
					<button class="btn Stroked-button--grey">Cambiar avatar</button>
				</div>-->
				<!--<div class="profile-avatar--options">
					<img src="img/defaultuser.png">
					<img src="img/defaultuser.png">
					<img src="img/defaultuser.png">
					<img src="img/defaultuser.png">
					<img src="img/defaultuser.png">
					<img src="img/defaultuser.png">
					<img src="img/defaultuser.png">
					<img src="img/defaultuser.png">
				</div>-->
				<div class="profile-avatar--change" id="profile-avatar--change">
					<button id="avatar-change--button" class="btn Basic-button Green-button">Cambiar</button>
				</div>
				
				<div class="profile-avatar--upload" id="profile-avatar--upload">
					<form id="avatar-upload--form" action="../php/submit/avatar.php" method="POST" enctype="multipart/form-data">
						<div id="avatar-upload">
							<input type="file" id="avatar-upload--file" class="form-upload" name="avatar">
							<label class="btn Basic-button Green-button" for="avatar-upload--file">Sube una imagen</label>
						</div>
						<div class="">
							<button id="avatar-upload--reset" type="reset" class="btn Basic-button">Cancelar</button>
							<button type="submit" class="btn Basic-button Green-button">Guardar</button>
						</div>
					</form>
				</div>
			</div>
			
		</div>
		
		
	<!--ends container -->	
	</div>
	
	<?php
	include("_footer.php");
	?>
</body>
</html>
<script type="text/javascript">
var currentAvatar = "";
$('#profile-avatar--upload').toggle();

$('#avatar-upload--form').submit(function() {
	//Check if there is a file
	if($('#avatar-upload--file').val() == '') {
		return false;
	}
	return true;
});
	
$(document).ready(function() {
	getMyInfo();
});

$('#avatar-upload--reset').click(function() {
	$('#avatar').attr('src', currentAvatar);
	toggleAvatarUpload();
});

$('#avatar-change--button').click(function() {
	toggleAvatarUpload();
});

function toggleAvatarUpload() {
	$('#profile-avatar--change').toggle();
	$('#profile-avatar--upload').toggle();
}

$('#avatar-upload--file').change(function() {
	//validate the file is an image
	//TODO: validation
	//then display
	previewAvatar(this);
});

function previewAvatar(input) {
	if(input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#avatar').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function getMyInfo(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: '../php/ajax/getMyInfo.php',
	  data: {user: id},
	  success: function(data){
			displayMyInfo(data);
		  },
	  error: function() {
	  }
	});
}

function displayMyInfo(user) {
	$('#userDisplayName').html(user.displayName);
	$('#username').html(user.userName);
	currentAvatar = user.icon;
	$('#avatar').attr('src', user.icon);
	$('#avatar').error(function(){this.src='../img/defaultuser.png';});
}

function printUserDetails(user) {
	$('#user-display').text(user.displayName);
	$('#user-name').html(user.userName);
	$('#user-icon').attr('src', user.icon);
}


</script>
