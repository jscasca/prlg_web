<?php

?>
<div class="profile-container">
	<div class="col-sm-12">

		<div class="prlg-panel">
			<div class="main-profile">
				<div class="icon-section">
					<div class="croppable-wrapper" id="croppable-wrapper">
						<div class="croppable" id="croppable"></div>
					</div>
					<div class="icon" id="avatar-display--area">
						<img src="<?php echo $rootpath;?>img/defaultuser.png" alt="avatar" id="avatar">
					</div>
					<div class="actions change-icon" id="change-avatar--buttons">
						<div class="upload-btn">
							<input type="file" id="avatar-upload" name="avatar">
							<label class="btn" for="avatar-upload"><?php echo getTranslation('Change avatar'); ?></label>
						</div>
					</div>
					<div class="actions edit-avatar" id="save-avatar--buttons"></div>
				</div>
				<div class="info-section">
					<div class="info">
						<div class="section">
							<div class="field-name"><?php echo getTranslation('Display name'); ?></div>
							<div class="field-editable">
							</div>
							<div class="field-value">
								<div class="value display-name" id="userDisplayName"></div>
								<div class="action" tabindex="0" id="edit-user--displayname" role="button">
									<i class="fas fa-pen" title="<?php echo getTranslation('Edit'); ?>"></i>
								</div>
							</div>
						</div>
						<div class="section">
							<div class="field-name"><?php echo getTranslation('User name'); ?></div>
							<div class="field-value">
								<div class="value username" id="username"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
</div>
<script type="text/javascript">
var currentAvatar = "";
var error = "<?php echo isset($profileError) ? 'There was an error uploading the file. Please try again.' : ''; ?>";

var croppable = null;

function cancelAvatarChange() {
	return function() {
		croppable = null;
		$('#avatar-upload').val('');
		$('#avatar-display--area').css('display', 'flex');
		$('#croppable-wrapper').empty().append($('<div></div>', {class: "croppable", id: "croppable"}));
		$('#save-avatar--buttons').empty();
	};
};

var createEditable = function(value, save, cancel, validate) {
	if(validate === undefined) {
		validate = function(input) {
			return input !== '' && input.length < 25;
		};
	}
	var input = $('<input>', {type: 'input'}).val(value);
	// var cancelIcon = $('<i></i>', {class: 'action cancel fas fa-times', title: 'Cancel', tabindex: "0", role: 'button'}).on('click', cancel);
	// var saveIcon = $('<i></i>', {class: 'action submit fas fa-check', title: 'Cancel', tabindex: "0", role: 'button'}).on('click', save);
	var wrapper = $('<div></div>', {class: 'wrapper contained'}).append(input);
	// .append(cancelIcon).append(saveIcon);
	var inputHolder = $('<div></div>', {class: 'editable-are display-name'}).append(wrapper);

	var cancelButton = $('<button></button>', {class: 'btn', title: getText('Cancel'), tabindex: "0", role: 'button'}).on('click', cancel).append(getText(' Cancel'));
	var saveButton = $('<button></button>', {class: 'btn main-btn', title: getText('Save'), tabindex: "0", role: 'button'}).on('click', function() {
		var inputValue = input.val();
		if(validate(inputValue)) {
			save(inputValue);
		} else {
			//
		}
	}).append(getText('Save'));
	var controls = $('<div></div>', {class: 'actions'}).append(cancelButton).append(saveButton);

	var holder = $('<div></div>', {class: 'editable-area display-name'}).append(inputHolder).append(controls);
	return holder;
};
	
$(document).ready(function() {
	//display error if any
	if(error !== '') {
		$('#avatar-upload--error').html('<p>' + getText(error) + '</p>');
	}
	
	getMyInfo().then(function(profile){
		displayMyInfo(profile);
	});
	$('#displayname--label').text(getText('Display name')); // Can be done in php instead
	$('#username--label').text(getText('Username'));

	$('#edit-user--displayname').on('click', function() {
		// clean all others
		$('.field-editable').empty();
		$('.field-value').css('display', 'flex');
		// find the section
		var section = $(this).closest('.section');
		var editable = section.find('.field-editable');
		var value = section.find('.field-value');

		value.css('display', 'none');
		var editableArea = createEditable(value.find('.value').text(), function(newValue) {
			// ajax save
			ajaxPromise({
						type: 'POST',
						dataType: 'json',
						url: AJAX_DIR + 'postUserDisplay.php',
						data: {
							display: newValue
						}
					});
			section.find('.field-value .value').empty().append(document.createTextNode(newValue));
			$('.field-editable').empty();
			$('.field-value').css('display', 'flex');
		}, function() {
			$('.field-editable').empty();
			$('.field-value').css('display', 'flex');
		});
		editable.append(editableArea);
		section.find('input').focus();
	});

	$('#avatar-upload').change(function() {
		if(croppable == null) {
			croppable = $('.croppable').croppie({
				enableExif: true,
				viewport: {
					width: 200,
					height: 200,
					type: 'circle'
				},
				boundary: {
					width: 250,
					height: 250
				}
			});
			var saveButton = $('<button></button>', {class: 'btn main-btn'}).append('Save').on('click', function() {
				var cleanButtons = cancelAvatarChange();
				$('.actions btn').attr('disabled', 'disabled');
				croppable.croppie('result', {type:'canvas', size: 'viewport'}).then(function(blob) {
					var saving = ajaxPromise({
						type: 'POST',
						dataType: 'json',
						url: AJAX_DIR + 'postUserAvatar.php',
						data: {
							img64: blob
						}
					});
					saving.then(function(r) {
						cleanButtons();
						$('.actions btn').removeAttr('disabled');
						$('#avatar').attr('src', r.url);
					});
				});
			});
			var cancelButton = $('<button></button>', {class: 'btn cancel-btn'}).append('Cancel').on('click', cancelAvatarChange());
			$('#save-avatar--buttons').append(cancelButton).append(saveButton);
		}
		$('#avatar-display--area').css('display', 'none');
		var reader = new FileReader();
		reader.onload = function(e) {
			croppable.croppie('bind', {
				url: e.target.result
			}).then(function() {
				// console.log('bind complete');
			});
		};
		reader.readAsDataURL(this.files[0]);
	});
	//
});

function getMyInfo() {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getMyInfo.php',
	});
}

function displayMyInfo(user) {
	$('#userDisplayName').html(user.displayName);
	$('#username').html('@' + user.userName);
	currentAvatar = user.icon;
	$('#avatar').attr('src', user.icon + '?bs=' + Math.random());
	// $('#avatar').error(function(){this.src='../img/defaultuser.png';});
}

</script>
