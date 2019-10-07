<?php

?>
<div class="col-md-12 col-sm-12">
	<!--  -->
	<div class="my-groups--container" id="my-groups--container">
	</div>
</div>

<div class="col-md-12 col-sm-12">

</div>
<div class="col-xs-12 col-sm-6">
	<section class="my-bookclubs">
		<div class="section-header">
			<h3><?php echo getTranslation('My book clubs'); ?></h3>
		</div>
		<div class="bookclubs" id="bookclub-list">
		</div>
	</section>
</div>

<div class="col-xs-12 col-sm-6">
	<!--  -->
	<section class="new-group">
		<div class="icon">
			<img src="img/user_dark.png">
		</div>
		<div class="section-header">
			<h3><?php echo getTranslation('Start your own club!'); ?></h3>
		</div>
		<div class="section-instructions">
			<p><?php echo getTranslation('Select a unique name for your new club and start enjoying your new space!'); ?></p>
			<p><?php echo getTranslation('Club names must start with a letter and can contain letter, numbers and/or underscores up to 25 characters'); ?></p>
		</div>
		<div class="new-form">
			<form method="POST" action="php/submit/newGroupRequest.php" id="new-club--form">
				<div class="form-group">
					<label class="" for="">Club name</label>
					<div class="input-group">
						<div class="input-group-addon">
							<span class="fas fa-book-reader"></span>
						</div>
						<input id="group-name" name="name" type="text" class="form-control" placeholder="MyClubName">
					</div>
				</div>
				<div class="error-msg" id="error-msg"></div>
				<div class="actions">
					<button type="submit" class="btn main-btn">Create Club!</button>
				</div>
			</form>
		</div>
	</section>
</div>

<!-- <div class="col-md-4 col-sm-12" id="similar-books">
	<h2 class="Section-title no-padding">Similar books</h2>
</div> -->

<script type="text/javascript">
// Probably only name validation and request validation
var postError = '<?php echo $error === null ? "" : $error; ?>';
var postArgs = '<?php echo $args === null ? "" : $args; ?>';

function getUserClubs() {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getMyClubs.php',
	});
}

function link(content, link) {
	var anchor = $('<a></a>', {href: link});
	anchor.text(content);
	return anchor;
}

$(document).ready(function() {
	//check if there is any post error and display error
	if(postError !== '') {
		switch(postError) {
			case 'name': displayError(getSpan('duplicateName', [postArgs])); break;
			default: displayError(getText('There was an error during the processing, please try again later')); break;
		}
	}

	if(loggedIn) {
		// call my groups and display them
		getUserClubs().then(function(clubs) {

			var printClub = function(club) {
				console.log(club);
				var img = $('<img>', {src: club.icon === '' ? DEFAULT_CLUB  : club.icon});
				var icon = $('<div></div>', {class: 'icon', alt: 'club icon'}).append(img);
				var name = $('<div></div>', {class: 'name'}).append(document.createTextNode(club.displayName));
				var handle = $('<div></div>', {class: 'handle'}).append(document.createTextNode('@' + club.clubName));
				var link = $('<a></a>', {href: ROOT_PATH + 'club/' + club.clubName});
				var info = $('<div></div>', {class: 'info'}).append(name).append(handle).append(link);
				var div = $('<div></div>', {class: 'bookclub prlg-panel', tabindex: '0'}).append(icon).append(info);
				return div;
			};


			if(Array.isArray(clubs) && clubs.length > 0) {
				// $('#new-group--section-title').text(getText('Start a new book club!'));
				// $('#new-group--holder').removeClass('col-md-12');
				// $('#new-group--holder').addClass('col-md-6');
				const holder = $('#bookclub-list');
				for(var i = 0; i < clubs.length; i++) {
					var club = clubs[i];
					holder.append(printClub(clubs[i]));
				}
			} else {
				// put img for empty holder
			}

		});

	}
});

$('#new-club--form').submit(function() {
	$('#error-msg').empty();
	var groupName = $('#group-name');
	var name = groupName.val();
	if(name == '' || name == undefined) {
		displayFormViolation(groupName, getText('Please select a club name'));
		return false;
	}
	if(name.length < 3 || name.length > 25) {
		displayFormViolation(groupName, getText('The club name must be between 3 and 25 characters long'));
		return false;
	}
	if(!(/^[a-zA-Z][a-zA-Z0-9_]{2,24}$/.test(name))) {
		displayFormViolation(groupName, getText('The club name must start with a letter and can contain only letters, numbers and underscores'));
		return false;
	}
	// TODO: check name availability online
	// if(!validname) {
	// 	checknameAvailability(name);
	// 	return false;
	// }
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

</script>