<?php
session_start();
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Mi Perfil</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/star-rating.min.js"></script>
	<script src="js/jquery.raty.min.js"></script>
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/star-rating.min.css">
	<link rel="stylesheet" href="css/style.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
					<form id="avatar-upload--form" action="php/submit/avatar.php" method="POST" enctype="multipart/form-data">
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
	var retries = 0;
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
	$('.backup-thumb').error(function() {
		$(this).attr('src', 'img/default.png');
	});
	$('.backup-cover').error(function() {
		$(this).attr('src', 'img/default.png');
	});
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
	  url: 'php/ajax/getMyInfo.php',
	  data: {user: id},
	  success: function(data){
			displayMyInfo(data);
		  },
	  error: function() {
		  retries++;
		  if(retries < 10)
			setTimeout('getMyInfo('+id+')', 300);
	  }
	});
}

function displayMyInfo(user) {
	$('#userDisplayName').html(user.displayName);
	$('#username').html(user.userName);
	currentAvatar = user.icon;
	$('#avatar').attr('src', user.icon);
	$('#avatar').error(function(){this.src='img/defaultuser.png';});
}

function printUserDetails(user) {
	$('#user-display').text(user.displayName);
	$('#user-name').html(user.userName);
	$('#user-icon').attr('src', user.icon);
}

function getRatingDiv(ratingDiv, rating) {
	if(rating == null) rating = 0;
	var stars = Math.floor(rating);
	for(var i = 0; i < stars; i++) {
		ratingDiv.append('<span class="fa fa-star"></span>');
	}
	if(rating%1 > 0) {
		ratingDiv.append('<span class="fa fa-star-half-o"></span>');
		stars++;
	}
	for(var i = stars; i < 5; i++) {
		ratingDiv.append('<span class="fa fa-star-o"></span>');
	}
	return ratingDiv;
}


</script>
