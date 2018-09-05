<?php

?>
<div class="profile-container">
	<div class="col-md-4 col-sm-12">
		<div class="input-holder" id="displayHolder">
			<span id='displayname--label'>Name</span>
			<div class="">
				<h2 id="userDisplayName"></h2>
			</div>
		</div>
		<div class="input-holder" id="">
			<span id='username--label'>User</span>
			<h3 id="username"></h3>
		</div>
	</div>
	
	<div class="col-md-8 col-sm-12 text-center">
		<div class="profile-avatar">
			<img src="../img/defaultuser.png" alt="avatar" id="avatar">
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
			<!-- <button id="avatar-change--button" class="btn Basic-button Green-button">Change</button> -->
		</div>
		
		<div class="profile-avatar--upload" id="profile-avatar--upload">
			<form id="avatar-upload--form" action="<?php echo $rootpath;?>php/submit/avatar.php" method="POST" enctype="multipart/form-data">
				<div id="avatar-upload">
					<input type="file" id="avatar-upload--file" class="form-upload" name="avatar">
					<label class="btn Basic-button Green-button" for="avatar-upload--file">Change</label>
				</div>
				<div id="avatar-upload--actions" style="display:none;">
					<button id="avatar-upload--reset" type="reset" class="btn Basic-button">Cancel</button>
					<button type="submit" class="btn Basic-button Green-button">Save</button>
				</div>
				<div id='avatar-upload--error' class='error-msg'>
					<!-- show error -->
				</div>
			</form>
		</div>
	</div>
	
</div>
<script type="text/javascript">
var currentAvatar = "";
var error = "<?php echo isset($profileError) ? 'There was an error uploading the file. Please try again.' : ''; ?>";

$('#avatar-upload--form').submit(function() {
	//Check if there is a file
	if($('#avatar-upload--file').val() == '') {
		return false;
	}
	return true;
});
	
$(document).ready(function() {
	//display error if any
	if(error !== '') {
		$('#avatar-upload--error').html('<p>' + getText(error) + '</p>');
	}
	
	getMyInfo().then(function(profile){
		displayMyInfo(profile);
	});
	$('#displayname--label').text(getText('Display name'));
	$('#username--label').text(getText('Username'));
});

$('#avatar-upload--reset').click(function() {
	$('#avatar').attr('src', currentAvatar);
	$('#avatar-upload--actions').css('display', 'none');
});

$('#avatar-upload--file').change(function() {
	//validate the file is an image
	//TODO: validation
	//then display
	previewAvatar(this);
	$('#avatar-upload--actions').css('display', 'block');
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

function getMyInfo() {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getMyInfo.php',
	});
}

// function getMyInfo(id) {
// 	$.ajax({
// 	  type: 'GET',
// 	  dataType: 'json',
// 	  url: '../php/ajax/getMyInfo.php',
// 	  data: {user: id},
// 	  success: function(data){
// 			displayMyInfo(data);
// 		  },
// 	  error: function() {
// 	  }
// 	});
// }

function displayMyInfo(user) {
	$('#userDisplayName').html(user.displayName);
	$('#username').html(user.userName);
	currentAvatar = user.icon;
	$('#avatar').attr('src', user.icon + '?bs=' + Math.random());
	// $('#avatar').error(function(){this.src='../img/defaultuser.png';});
}

function printUserDetails(user) {
	$('#user-display').text(user.displayName);
	$('#user-name').html(user.userName);
	$('#user-icon').attr('src', user.icon);
}


</script>
