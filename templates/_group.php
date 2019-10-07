<?php

?>

<div class="col-sm-12">
	<!-- Modals -->
	<div class="modal fade wishlist-dialog" id="add-to-wishlist--dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="header">
						<!--  -->
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="title"><span id="modal-title-placeholder">Add a book to the club wishlist</span></h3>
					</div>
					<div class="body">
						<div class="filter">
							<div class='instructions'>
								<span>Select a book from your readings to add it to the club wishlist.</span>
							</div>
							<div class='filter-textfield'>
								<div class="input-group">
									<input type="text" class="form-control" id="add-to-wishlist--filter">
									<span class="input-group-addon">
										<i class="fas fa-filter"></i>
									</span>
								</div>
								<!-- <input type='text' id='suggest-similar--filter' class='filter-textfield' placeholder='Filter'/> -->
							</div>
						</div>
						<div class="to-add-list default-book-list dialog aria-navigable-list" tabindex="0" id="my-to-add-list">
							<!-- Here list the books -->
							<!-- Sample result -->
								<!-- <div class="book prlg-panel" tabindex="-1">
										<div class="icon"><img src="../img/user_clear.png"></div>
										<div class="info">
											<div class="title">
												Book Title
											</div>
											<div class="author">
												Author One, Author Two
											</div>
										</div>
									</div> -->
								<!-- End Sample -->
						</div>
					</div>
					<div class="footer">
						<div class="actions">
								<button class="btn" id="close--wishlist-modal"><?php echo getTranslation('Close'); ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<!-- Not sur eif used -->
	<div id="group-modal--wishlist" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<!-- Header -->
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><span id="modal-title-placeholder"><?php echo getTranslation('Add a book to the club wishlist'); ?></span></h3>
				</div>
				<div class="modal-body text-center">
					<div class="modal-wishlist--info">
						<span><?php echo getTranslation('Add a book that you are reading, have read or is in your wishlist'); ?></span>
					</div>
					<!-- TODO: Implement filtering -->
					<!-- <div class="modal-wishlist--filter">
						<input type="text" />
					</div> -->
					<div class="modal-wishlist--collection" id="modal-wishlist--collection">
						<!--  -->
					</div>
				</div>

				<div class="modal-footer">
					<!--  -->
					<div class="modal-footer--buttons text-center">
						<!--  -->
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Reading modal -->
	<div id="group-modal--reading" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<!-- Header -->
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><span id="modal-title-placeholder"><?php echo getTranslation('Select what the club is reading'); ?></span></h3>
				</div>
				<div class="modal-body text-center">
					<div class="modal-wishlist--info">
						<span><?php echo getTranslation('Select a book from the club wishlist and mark it as the current reading'); ?></span>
					</div>
					<!-- TODO: Implement filtering -->
					<!-- <div class="modal-wishlist--filter">
						<input type="text" />
					</div> -->
					<div class="modal-wishlist--collection" id="modal-wishlist--collection">
						<!--  -->
					</div>
				</div>

				<div class="modal-footer">
					<!--  -->
					<div class="modal-footer--buttons text-center">
						<!--  -->
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="col-md-12">
<!--  -->
	<div id="book-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<h2 id="book-modal--body"></h2>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div id="login-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					Log in to write a prologue!
				</div>
				<div class="modal-body text-center">
					<a href="login.php"><button type="button" id="btn-to-review" class="btn Blue-button">Log In</button></a>
					<h5>New to the site?<a href="registration.php">Sign up!</a></h5>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div id="prologe-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><span id="modal-title-placeholder">Write a prologue!</span></h3>
				</div>
				<div class="modal-body">
					<div class="prologe-modal--prologe text-center">
						<textarea id="prologe-modal--textarea" class="prologe-modal--textarea"></textarea>
						<div class="prologe-modal--feedback text-right" id="prologe-modal--feedback"></div>
					</div>
					<div class="prologe-modal--rating">
						<span id='modal-rating--label'>Rate</span>: <span id="prologe-modal--raty"></span>
					</div>
				</div>
				<div class="modal-footer">
					<div class="modal-footer--buttons text-center">
						<button type="button" class="btn Blue-button" id="prologe-modal--submit">Stamp!</button>
					</div>
					<!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>-->
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modals here -->
<div class="col-sm-12"></div>

<!-- All content (mobile) -->
<div class="col-xs-12 col-sm-8">
	<div class="main-group prlg-panel">
		<div class="group">
			<div class="icon-section">
				<div class="croppable-wrapper" id="croppable-wrapper">
					<div class="croppable" id="croppable"></div>
				</div>
				<div class="icon-controls" id="icon-controls"></div>
				<div class="club-icon" id="club-icon">
					<div class="icon">
						<img class="croppable-img">
					</div>
					<div class="edit-control" id="edit-control--icon">
						<!-- <div class="action" id="edit-club-icon">
							<input type="file" id="change-icon">
							<label for="change-icon"><i class="fas fa-pen"></i></label>
						</div> -->
					</div>
				</div>
			</div>
			<!-- Club info -->
			<div class="info">
				<div class="display-name editable" id="editable-display-name">
					<div class="value" id="editable-display-name--value">
					</div>
					<div class="field-editable">
						<div class="editable-area">
							<div class="wrapper contained">
								<input type="input" id="editable-display-name--input">
							</div>
						</div>
						<div class="actions">
							<button class="btn cancel">Cancel</button>
							<button class="btn main-btn save">Save</button>
						</div>
					</div>
				</div>
				<div class="handle" id="club-handle"></div>
				<div class="description" id="club-description">
					<div class="expandable">
						<div class="content"></div>
						<div class="editable-control" id="edit-club-description-control"></div>
						<div class="controls expandable-toggle"></div>
					</div>
					<div class="empty"></div>
					<div class="editable text-editable">
						<div class="editable-area">
							<div class="wrapper contained">
								<textarea rows="6" id="editable-description--input" placeholder="Write a description"></textarea>
							</div>
						</div>
						<div class="actions">
							<button class="btn cancel">Cancel</button>
							<button class="btn main-btn save">Save</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End club info -->
		</div>
	</div>

	<!-- Mobile Navigation -->
	<div class="mobile-nav" id="mobile-reorder-nav">
		<ul class="nav nav-tabs underline-tabs">
			<li><a href="#tab-members" data-toggle="tab"><?php echo getTranslation('Members'); ?></a></li>
			<li class="active"><a href="#tab-comments" data-toggle="tab"><?php echo getTranslation('Comments'); ?></a></li>
			<li><a href="#tab-books" data-toggle="tab"><?php echo getTranslation('Books'); ?></a></li>
		</ul>
	</div>

	<!-- Tab content (Mobile) -->
	<div class="mobile-nav tab-content">
			<!-- Member section -->
			<div class="tab-pane fade in" id="tab-members">
				<div class="holder" id="tab-members-holder">
					<!-- List the members and button to invite people/join';/>...... -->
					<section class="members" id="members-component">
						<div class="section-header underlined">
							<h3><?php echo getTranslation('Club Members'); ?></h3>
						</div>
						<div class="info">
							<!-- list -->

							<!-- My membership -->
							<div class="membership" id="membership">
							
								<!-- <div class="member">
									<div class="role">
										<button class="btn">You are a MEMBER</button>
									</div>
								</div>
								<div class="guest">
									<div class="actions">
										<button class="btn main-btn">JOIN CLUB</button>
									</div>
								</div> -->
							</div>

							<!-- Member list -->
							<div class="club-members" id="club-members">
								<!-- Memeber 1 -->
								<!-- <div class="member">
									<div class="icon">
										<img src="../img/user_dark.png">
									</div>
									<div class="info">
										<div class="display-name">
											<a href="#"><div>Some rnadom extra long name</div></a>
										</div>
										<div class="username">
											<a href="#"><div>@somerandomusername</div></a>
										</div>
									</div>
								</div> -->
							</div>
						</div>
						<!-- Create on demand -->
						<div class="member-actions">
							<div class="actions" id="member-actions">
								<!-- <div class="action invite"><button class="main-btn btn">Invite</button></div> -->
								<!-- <div class="action leave"><a href="#">Leave club</a></div> -->
							</div>
						</div>
					</section>
				</div>
			</div>
			<!-- Comment section -->
			<div class="tab-pane fade in active" id="tab-comments">
				<div class="holder" id="tab-comment-holder">
					<section id="comments-component">
						<div class="comment-area">
							<div class="comment-form">
								<div class="textarea-container">
									<textarea id="comment--textarea" placeholder="Write a comment..."></textarea>
									<div class="error-area" id="comment--error-area"></div>
								</div>
								<div class="actions">
									<button type="button" class="btn main-btn" disabled="disabled" id="comment--submit">Post</button>
								</div>
							</div>
							<!--  -->
						</div>
		
						<div class="main-group--threads" id="main-group--threads">
							<!-- Here be the past threads -->
							<!-- Here be the past threads -->
						</div>
					</section>
				</div>
			</div>

			<!-- Book section -->
			<div class="tab-pane fade in" id="tab-books">
				<div class="holder" id="tab-books-holder">
					<div class="side-tab-panel" id="books-component">
						<div class="">
							<ul class="nav nav-tabs">
								<li class="active nav-item"><a href="#tab-reading" data-toggle="tab" id="tab-reading--anchor"><?php echo getTranslation('Reading'); ?></a></li>
								<li class="nav-item"><a href="#tab-wishlist" data-toggle="tab" id="tab-wishlist--anchor"><?php echo getTranslation('Wishlist'); ?></a></li>
								<!-- <li class="nav-item"><a href="#tab-library" data-toggle="tab" id="tab-library--anchor"><?php echo getTranslation('Library'); ?></a></li> -->
							</ul>
						</div>
						<div class="tab-content">
							<!-- -->
							<div id="tab-reading" class="tab-pane active fade in">
								<!-- Currently reading-->
								<div class="group-reading" id="group-reading">
									<!-- <div class="icon">
										<img src="../img/book_dark.png">
									</div>
									<div class="info">
										<div class="title">
											<a href="#">The Lord of the Rings</a>
										</div>
										<div class="author"><a href="#">Author 1</a>, <a href="#">Author 2</a></div>
									</div>
									<div class="actions">
										<button class="btn main-btn">Finish</button>
									</div> -->
									<div class="section-name">
										<span><?php echo getTranslation('Currently reading'); ?></span>
									</div>
									<div class="icon" id="reading-book--icon"></div>
									<div class="info">
										<div class="title" id="reading-book--title"></div>
										<div class="author" id="reading-book--authors"></div>
									</div>
									<div class="actions" id="reading-book--actions"></div>
									<div class="background">
										<span id="empty-reading-msg"></span>
									</div>
								</div>
							</div>
							<div id="tab-wishlist" class="tab-pane fade">
								<!-- Wishlist-->
									
								<div class="group-wishlist" id="group-wishlist">
									<!-- Selected -->
									<div class="selected-book" id="selected-book--wishlist"></div>
									<!-- List of books -->
									<div class="section-name">
										<span><?php echo getTranslation('Our wishlist'); ?></span>
									</div>
									<div class="list" id="wishlist-list"></div>
									<!-- Actions -->
									<div class="actions wishlist-actions"></div>

									<div class="background" id="empty-wishlist">
										<span id="empty-wishlist-msg"></span>
									</div>
								</div>
							</div>
						</div>
							
					</div>
				</div>
			</div>
		</div>

	<!-- Grouo comments -->
	<div class="" id="main-group-comments-holder"></div>
</div>



<!-- Aux for normal web -->
<div class="col-xs-12 col-sm-4 club-side-content">
	<div class="" id="side-tab-panel-holder"></div>
	<div class="" id="side-members-holder"></div>
</div>

<script type="text/javascript">
var clubId = '<?php echo $group; ?>';
var retries = 0;
var maxProloge = 380;
var maxComment = 240;

var club = null;

var myBookMap = null;
var wishlistMap = null;

var commentHandler = new CommentDataHolder($('#main-group--threads'), { translator: translator });

function joinClub(clubId) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'postGroupMembership.php',
		data: {club: clubId}
	});
}

function getClubInfo(clubId) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getClubInfo.php',
		data: {club: clubId}
	});
}

function getClubMembership(clubId) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getClubMembership.php',
		data: {club: clubId}
	});
}

function getClubComments(clubId) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getClubComments.php',
		data: {club: clubId}
	});
}

function link(content, link) {
	var anchor = $('<a></a>', {href: link});
	anchor.text(content);
	return anchor;
}

function postComment(comment) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'postClubThread.php',
		data: {club: clubId, comment: comment}
	});
}

function getUserBooks() {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getMyBooks.php',
	});
}

function addToWishlist(bookId) {
	return ajaxPromise({
		type: 'POST',
		dataType: 'json',
		url: AJAX_DIR + 'postToGroupWishlist.php',
		data: {club: clubId, book: bookId}
	});
}

function startReadingBook(bookId) {
	return ajaxPromise({
		type: 'POST',
		dataType: 'json',
		url: AJAX_DIR + 'postToGroupReading.php',
		data: {club: clubId, book: bookId}
	});
}

function startReading(readingId) {
	return ajaxPromise({
		type: 'POST',
		dataType: 'json',
		url: AJAX_DIR + 'postToGroupReading.php',
		data: {club: clubId, reading: readingId}
	});
}

function finishReading(readingId) {
	return ajaxPromise({
		type: 'POST',
		dataType: 'json',
		url: AJAX_DIR + 'postToGroupFinish.php',
		data: {club: clubId, reading: readingId}
	});
}

function authorsText(authors) {
	var arr = [];
	for(var i = 0; i < authors.length; i++) {
		arr.push(authors[i].name);
	}
	return arr.join(',');
}

function authorsNode(authors) {
	var span = $('<span></span>');

	for(var i = 0; i < authors.length; i++) {
		var author = authors[i];
		var link = $('<a></a>', {href: ROOT_PATH + 'author/' + author.id})
			.append(document.createTextNode(author.name));
		if(i > 0) span.append(document.createTextNode(', '));
		span.append(link);
	}
	return span;
}

function printWishlistBook(reading) {
	// Passing the reading cause we might want to show the user in the future?
	var book = reading.book;
	var icon = $('<img>', {src: book.thumbnail, class: 'wishlist-book--icon'});
	var iconDiv = $('<div></div>', {})
		.addClass('wishlist-book--icon')
		.addClass('centered-icon')
		.append(icon);
	var titleTextNode = document.createTextNode(book.title);
	var titleAnchor = $('<a></a>', {href: ROOT_PATH + 'book/' + book.id})
		.append(titleTextNode);
	var title = $('<h3></h3>', {class: 'wishlist-book--title'})
		.append(titleAnchor);
	var authors = authorsNode(book.authors);
	var infoDiv = $('<div></div>', {class:'wishlist-book--info'})
		.append(title)
		.append(authors);

	var bookDiv = $('<div></div>', {id: 'main-group--wishlist-' + book.id })
		.addClass('main-group--wishlist-book')
		.append(iconDiv)
		.append(infoDiv);
	return bookDiv;
	/*
	<div class="main-group--wishlist-book">
						<div class="wishlist-book--icon">
							<img class="wishlist-book--icon" src="/prologes/img/book_dark.png">
						</div>
						<div class="wishlist-book--info">
							<h3><a>The really descriptive and long title of the book: chapter 1</a></h3>
							<span>by <a>Author with a long Name</a>, <a>Author with a standar name</a></span>
						</div>
					</div>
	*/
}

function printBook(book) {
	var icon = $('<img>', {src: book.thumbnail, class: 'modal-wishlist--book-icon'});
	var iconDiv = $('<div></div>', {})
		.addClass('modal-wishlist--book-icon')
		.addClass('centered-icon')
		.append(icon);
	var titleTextNode = document.createTextNode(book.title);
	var title = $('<h3></h3>', {class: 'modal-wishlist--book-title'})
		.append(titleTextNode);
	var authorTextNode = document.createTextNode(authorsText(book.authors));
	var authors = $('<span></span>').append(authorTextNode);
	var infoDiv = $('<div></div>', {class:'modal-wishlist--book-info'})
		.append(title)
		.append(authors);
	var buttonTextNode = document.createTextNode(getText('Add it!'));
	var addItButton = $('<button></button>', {type: 'button', class:'btn'}).addClass('action-btn-green').append(buttonTextNode);
	var actionDiv = $('<div></div>', {class:'modal-wishlist--book-actions'})
		.append(addItButton);
	addItButton.on('click', function() {
		if(wishlistMap == null) wishlistMap = {};
		if(wishlistMap[book.id] === undefined) {
			addToWishlist(book.id).then(function(reading) {
				// ClubReading object
				if(wishlistMap[reading.book.id] === undefined) {
					wishlistMap[reading.book.id] = {book: reading.book};
					var wishlisted = printWishlistBook(reading);
					$('#main-group--wishlist-books').append(wishlisted);
				}

			});
		}
	});

	var bookDiv = $('<div></div>', {id: 'modal-wishlist-' + book.id }).addClass('modal-wishlist--book').addClass('img-left--block').append(iconDiv).append(infoDiv).append(actionDiv);
	//

	return bookDiv;

	/*
	<div class="modal-wishlist--book img-left--block">
							<div class="modal-wishlist--book-icon centered-icon">
								<img class="modal-wishlist--book-icon" src="/prologes/img/user_clear.png">
							</div>
							<div class="modal-wishlist--book-info">
								<h3><a href="/index">The title of the book</a></h3>
								<span>by <a>Author Name</a>, <a>Author name</a></span>
							</div>
							<div class="modal-wishlist--book-actions">
								<button type="button" class="btn action-btn-green"><?php echo getTranslation('Add it!'); ?></button>
							</div>
						</div>
	*/
}

function updateClubAttribute(attribute, value) {
	return ajaxPromise({
		type: 'POST',
		dataType: 'json',
		url: AJAX_DIR + 'postClubInfo.php',
		data: {club: clubId, attribute: attribute, value: value}
	});
}

function setBookInfo(displayName, clubName, description, icon) {
	if(displayName !== null) {
		var name = $('<h1></h1>', {}).append(document.createTextNode(displayName));
		$('#club-title').empty().append(name);
	}
	if(clubName !== null) {
		var handle = $('<span></span>', {}).append(document.createTextNode('@' + clubName));
		$('#club-handle').empty().append(handle);
	}
	if(description !== null) {
		descriptionHolder = $('<div></div>', {});
		// Loop and append description
		var descriptionLines = description.split("\n");
		console.log(descriptionLines);
		for(var i = 0; i < descriptionLines.length; i++) {
			descriptionHolder.append($('<p></p>', {}).append(document.createTextNode(descriptionLines[i])));
		}
		$('#club-description').empty().append(descriptionHolder);
	}
	// Change the group icon to the new icon
	if(icon !== null) {
		icon = icon === '' ? DEFAULT_CLUB_ICON : icon;
		$('#club-icon').attr('src', icon);
	}
}

function previewIcon(input) {
	if(input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
			$('#club-icon').attr('src', e.target.result);
		}
		reader.readAsDataURL(input.files[0]);
	}
}

function sendFile(file) {
	var formData = new FormData();
	var request = new XMLHttpRequest();
	formData.set('file', file);
	formData.set('club', club.id);
	request.onload = function() {
		//
		console.log('Finished file');
	}
	request.open('POST', AJAX_DIR + 'postClubIcon.php');
	request.send(formData);
}

function resizeTx(el) {
	const max = 300; //calculate using the viewport
	// max height = Math.max(document.documentElement.clientHeight, window.innerHeight) || 400px`
	el.style.height = 'auto';
	el.style.height = (el.scrollHeight > max ? max : el.scrollHeight) + 'px';
}

function stringToDescription(el, description) {
	// el -> description
	if (description === '') {
		el.classList.add('empty');
	} else {
		el.classList.remove('empty');
		var content = el.querySelector('.content');
		while(content.firstChild) content.removeChild(content.firstChild);
		description.split('\n').forEach(function(line) {
			content.appendChild(objToNode({
				node: 'p',
				children: [{type: 'text', text: line}]
			}));
		});
		var expandable = el.querySelector('.expandable');
		var controls = expandable.querySelector('.controls');
		while(controls.firstChild) controls.removeChild(controls.firstChild);
		if (content.offsetHeight > 60) {
			// create more/less controls
			
			var more = objToNode({
				node: 'p',
				attrs: {class: 'more'},
				children: [{type: 'text', text: getText('Show more...')}]
			});
			var toggleExpand = function() {
				$(expandable).children().toggleClass('not-expanded');
			};
			more.addEventListener('click', toggleExpand);
			var less = objToNode({
				node: 'p',
				attrs: {class: 'less'},
				children: [{type: 'text', text: getText('Show less...')}]
			});
			less.addEventListener('click', toggleExpand);
			controls.append(more);
			controls.append(less);
		}
		$('#editable-description--input').val(description);
	}
};

var inCurrentWishlist;

var myBooksToAdd;

// TODO: fix this hack
var turnToAdmin;

var isAdmin = new Promise(function(s, f) {
	var resolved = false;
	turnToAdmin = function() {
		console.log('Turning to group admin...');
		if (!resolved) {
			resolved = true;
			s(true);
		}
	};

	setTimeout(() => {
		resolved = true;
		s(false);
	}, 1000);
});

var addCurrentReading = function(reading) {
	removeCurrentReading(); // TODO: stack them down if we are going to allow multiple
	$('#reading-book--icon').append(objToNode({node:'img',attrs:{src:reading.book.icon}}));
	var titleLink = objToNode({
		node: 'a',
		attrs: {href: ROOT_PATH + 'book/' + reading.book.id},
		children: [{type:'text',text:reading.book.title}]
	});
	$('#reading-book--title').append(objToNode({
		node: 'a',
		attrs: {href: ROOT_PATH + 'book/' + reading.book.id},
		children: [{type:'text',text:reading.book.title}]
	})).attr('readingid', reading.id); // Hack for the finish button
	// $('#reading-book--authors').append(); TODO: append the authors nicely
	$('#group-reading').removeClass('empty');
}

var removeCurrentReading = function() {
	$('#group-reading').addClass('empty');
	$('#reading-book--actions').empty();
	$('#reading-book--icon').empty();
	$('#reading-book--title').empty();
	$('#reading-book--authors').empty();
}

var addActionsToReading = function(reading) {
	console.log('adding button');
	var finishReadingBtn = objToNode({
		node: 'button',
		attrs: {class: 'btn main-btn'},
		children: [{type:'text', text: getText('Finish reading')}]
	});
	// TODO: get rid of this hack
	if (reading === null || reading === undefined) {
		reading= {id: $('#reading-book--title').attr('readingid')};
	}
	finishReadingBtn.addEventListener('click', function() {
		//
		console.log('finish reading;', reading);
		finishReading(reading.id).then(function() {
			// TODO: remove from the reading list
			// TODO: add to library of read
		});
		removeCurrentReading();
	});
	$('#reading-book--actions').append(finishReadingBtn);
}

var removeReadingFromWishlist = function(bookId) {
	var el = document.getElementById('book-' + bookId);
	el.parentNode.removeChild(el);
}

var addReadingToWishlist = function(reading) {
	var listedBook = objToNode({
		node: 'div',
		attrs: {class: 'book', id: 'book-' + reading.book.id},
		children: [
			{
				node: 'div',
				attrs: {class: 'icon'},
				children: [{node: 'img', attrs:{src: '' + reading.book.icon}}]
			},
			{
				node: 'div',
				attrs: {class: 'info'},
				children: [
					{
						node: 'span',
						attrs: {class: 'title'},
						children: [{type: 'text', text: reading.book.title}]
					},
					{
						node: 'span',
						attrs: {class: 'author'},
						children: [{type: 'text', text: authorsText(reading.book.authors)}]
					}
				]
			}
		]
	});

	// Clicking an element should prompt it to the selected area
	listedBook.addEventListener('click', function() {
		console.log('moving to selected');
		$('#selected-book--wishlist').empty();
		var moveToReading = objToNode({
			node: 'button',
			attrs: {class: 'btn main-btn'},
			children: [{type: 'text', text: getText('Move to Reading')}]
		});
		moveToReading.addEventListener('click', function() {
			startReading(reading.id).then(function(reading) {
				addCurrentReading(reading);
				addActionsToReading(reading);
			});
			// And then remove from list
			removeReadingFromWishlist(reading.book.id);
			// And, since it was selected, empty the selected region
			$('#selected-book--wishlist').empty();
			// TODO: trigger reading tab
			$('#tab-reading--anchor').trigger('click');
			if ($('#wishlist-list > div').length === 0) {
				// is empty
				$('#group-wishlist').addClass('empty');
			}
		});
		// TODO: make it a tree button icon using `ellipsis-v`
		// fas fa-ellipsis-v
		var removeFromWishlist = objToNode({
			node: 'div',
			attrs: {},
			children: []
		});
		removeFromWishlist.addEventListener('click', function() {
			// TODO remove from wishlist promise and then 
			removeReadingFromWishlist(reading.book.id);
			// And, since it was selected, empty the selected region
			$('#selected-book--wishlist').empty();
		});
		var actions = objToNode({
			node: 'div',
			attrs: {class: 'actions'},
			children: []
		});
		var selected = objToNode({
			node: 'div',
			attrs: {class: 'book'},
			children: [
				{
					node: 'div',
					attrs: {class: 'icon'},
					children: [{node: 'img', attrs:{src: reading.book.icon}}]
				},
				{
					node: 'div',
					attrs: {class: 'info'},
					children: [
						{
							node: 'a',
							attrs: {class: 'title', href: ROOT_PATH + 'book/' + reading.book.id},
							children: [{type: 'text', text: reading.book.title}]
						}//,
						// {
						// 	node: 'a',
						// 	attrs: {class: 'author'},
						// 	children: [{type: 'text', text: 'TBD'}] // TODO: authors links
						// }
					]
				},
				actions
			]
		});
		$('#selected-book--wishlist').append(selected);
		// Only if admin
		isAdmin.then(function(admin) {
			if (admin) {
				actions.appendChild(moveToReading);
				actions.appendChild(removeFromWishlist);
			}
		});
	});

	$('#wishlist-list').append(listedBook);
};
	
$(document).ready(function() {

	var resize = function() {
		var isVisible = function(el) {
			return 'block' === window.getComputedStyle(el).getPropertyValue('display');
		};
		if(window.innerWidth < 768) {
			$('#tab-members-holder').append($("#members-component"));
			$('#tab-comment-holder').append($('#comments-component'));
			$('#tab-books-holder').append($('#books-component'));
		} else {
			$('#side-tab-panel-holder').append($('#books-component'));
			$('#main-group-comments-holder').append($('#comments-component'));
			$('#side-members-holder').append($('#members-component'))
		}
	};

	window.addEventListener('resize', function() {
		resize();
	});

	resize();

	$('body').tooltip({placement: 'top', selector: '[data-toggle=tooltip]'});
	
	// Wishlist modal stuff
	$('#close--wishlist-modal').on('click', () => {
		$('#add-to-wishlist--dialog').modal('hide');
	});

	$('#add-to-wishlist--filter').on('keyup', () => {
		//
		if (myBooksToAdd !== undefined && myBooksToAdd.length > 1) {
			var filter = $('#add-to-wishlist--filter').val().toLowerCase();
			console.log('filtering on:', filter);
			if (filter === '') {
				// clean
				myBooksToAdd.forEach((bookPanel) => {
					bookPanel.ui.classList.remove('filtered-out');
				});
			} else {
				myBooksToAdd.forEach((bookPanel) => {
				if (bookPanel.title.indexOf(filter) !== -1 || bookPanel.authors.indexOf(filter) !== -1) {
					// found: mark it
					bookPanel.ui.classList.remove('filtered-out');
				} else {
					// hide this 
					bookPanel.ui.classList.add('filtered-out');
				}
			});
			}
		}
	});

	$('#add-to-wishlist--dialog').on('shown.bs.modal', () => {
		// TODO: refine this
		if (myBooksToAdd === undefined) {
			getUserBooks().then((data) => {
				myBooksToAdd = [];
				var existingBooks = {};
				data.forEach((book) => {
					if (existingBooks[book.id] === undefined) {
						existingBooks[book.id] = true;
						var authors = book.authors.reduce((acc, current) => { return acc === '' ? current.name : ', ' + current.name; }, '');
						var bookPanel = objToNode({
							node: 'div',
							attrs: {class: 'book prlg-panel', tabindex: '-1'},
							children: [
								{
									node: 'div',
									attrs: {class:'icon'},
									children: [{node: 'img', attrs: {src: book.icon}}]
								},
								{
									node: 'div',
									attrs: {class: 'info'},
									children: [
										{
											node: 'div',
											attrs: {class: 'title'},
											children: [{type: 'text', text: book.title}]
										},
										{
											node: 'div',
											attrs: {class: 'author'},
											children: [{type:'text', text: authors}]
										}
									]
								}
							]
						});
						bookPanel.addEventListener('click', function(e) {
							addToWishlist(book.id).then(function(reading) {
								addReadingToWishlist(reading);
							});
							$('#add-to-wishlist--dialog').modal('hide');
						});
						$('#my-to-add-list').append(bookPanel);
						myBooksToAdd.push({
							title: book.title.toLowerCase(),
							authors: authors.toLowerCase(),
							icon: book.icon,
							id: book.id,
							ui: bookPanel
						});
					}
				});
			});
		}
		// if map of books is empty fill it with books
		/*

							<!-- Sample result -->
								<div class="book prlg-panel" tabindex="-1">
										<div class="icon"><img src="../img/user_dark.png"></div>
										<div class="info">
											<div class="title">
												A book with a longer title
											</div>
											<div class="author">
												Author One, Author Two
											</div>
										</div>
									</div>
								<!-- End Sample -->
		*/
	});
  /* Set translated texts */
  $('#tab-prologues--anchor').html(getText('Prologues'));
  $('#tab-comments--anchor').html(getText('Comments'));
  $('#book-comment--textarea').attr('placeholder', getText('Write a comment...'));
  $('#modal-rating--label').text(getText('Rate'));
  $('#prologe-modal--submit').html(getText('Stamp'));

	// Load book club information
	getClubInfo(clubId).then(function(clubInfo) {
		console.log(clubInfo);
		if(clubInfo.club != undefined) {
			// Set the icon
			$('#club-icon').find('img').attr('src', (clubInfo.club.icon && clubInfo.club.icon !== '') ? clubInfo.club.icon : DEFAULT_CLUB_ICON );

			// Set the name
			/*
<div class="value" id="editable-display-name--value">
						<!-- Text node for club display name -->
						<span class="action" tabindex="0" role="button" id="edit-club-display-name" title="Change club name">
							<i class="fas fa-pen"></i>
						</span>
					</div>
			*/
			$('#editable-display-name--value').append(document.createTextNode(clubInfo.club.displayName));

			// Set the handler
			var handle = $('<span></span>', {}).append(document.createTextNode('@' + clubInfo.club.clubName));
			$('#club-handle').empty().append(handle);

			// Set the club description
			stringToDescription($('#club-description')[0], clubInfo.club.description);
		}

		var clubMemberList = $('#club-members');
		if(clubInfo.members !== undefined) {
			// DISPLAY MEMBERS
			var members = clubInfo.members;
			if (members.length > 0) {
				members.forEach(function(member) {
					clubMemberList.append(objToNode({
						node: 'div',
						attrs: { class: 'member'},
						children: [
							{
								node: 'div',
								attrs: { class: 'icon'},
								children: [
									{
										node: 'img',
										attrs: { 
											src: member.icon === '' ? ROOT_PATH + 'img/user_clear.png' : member.icon
										}
									}
								]
							},
							{
								node: 'div',
								attrs: { class: 'info'},
								children: [
									{
										node: 'div',
										attrs: { class: 'display-name'},
										children: [{
											node: 'a',
											attrs: { href: ROOT_PATH + 'user/' + member.userName},
											children: [{
												node: 'div',
												children: [{
													type: 'text',
													text: member.displayName
												}]
											}]
										}]
									},
									{
										node: 'div',
										attrs: { class: 'username'},
										children: [{
											node: 'a',
											attrs: { href: ROOT_PATH + 'user/' + member.userName},
											children: [{
												node: 'div',
												children: [{
													type: 'text',
													text: '@' + member.userName
												}]
											}]
										}]
									}
								]
							}
						]
					}));
				});
			}
		}
		if(clubInfo.wishlisted !== undefined) {
			var wishlist = clubInfo.wishlisted;
			var wishlistTab = $('#group-wishlist');
			$('#empty-wishlist-msg').append(getText('Nothing on the horizon, yet.'));
			if (wishlist.length > 0) {
				wishlist.forEach((reading) => {
					addReadingToWishlist(reading);
				});
			} else {
				wishlistTab.addClass('empty');
			}
		}
		// 
		if(clubInfo.reading !== undefined) {
			var reading = clubInfo.reading;
			if (reading.length > 0) {
				addCurrentReading(reading[0]);
			} else {
				$('#group-reading').addClass('empty');
				$('#empty-reading-msg').append(getText('We are taking a break'));
			}
		}
	});

getClubComments(clubId).then(function(comments) {
	commentHandler.printCollection(comments);
});

	if(loggedIn) {

		var memberBanner = function() {
			var btn = $('<button></button>', {class: 'btn'}).append(document.createTextNode(getText('you are a MEMBER'))).on('click', function() {
				// TODO: implement memebr popup
				console.log('membership');
			});
			var role = $('<div></div>', {Class: 'role'}).append(btn);
			var holder = $('<div></div>', {class: 'member'}).append(role);
			$('#membership').append(holder);

			// add actions here TODO:
			var leaveLink = objToNode({
				node: 'div',
				attrs: {class: 'action leave'},
				children: [{
					node: 'a',
					attrs: {href: '#'},
					children: [{type: 'text', text: getText('Leave club')}]
				}]
			});
			leaveLink.addEventListener('click', function() {
				console.log('Leaving club...');
			});
			$('#member-actions').append(leaveLink);
		};

		var enableCommenting = function() {
			//All the comment stuff
			$('#comment--submit').removeClass('disabled').removeAttr('disabled');
			$('#comment--submit').on('click', function() {
				var textarea = $('#comment--textarea');
				var commentText = textarea.val();
				if(commentText.length > 6400) {
					//alert and return 
					return 0;
				}
				if(commentText.trim() !== '') {
					$('#comment--submit').addClass('disabled').attr('disabled', 'disabled');
					$('#comment--error-area').html('');
					//post and show thread
					postComment(commentText).then(function(thread){
						console.log(thread);
						commentHandler.pushNew(thread);
						textarea.val('');
						$('#comment--submit').removeClass('disabled').removeAttr('disabled');
					}).catch(function(err) {
						console.log(err);
						var displayError = translator.getErrorMessage();
						switch(err.status) {
							case 401: displayError = translator.getErrorMessage('logInToPost'); break;
						}
						$('#comment--error-area').html('<i>' + displayError + '</i>')
					});
				}
			});
		};
		console.log('logged in');
		getClubMembership(clubId).then(function(membership) {
			console.log('membership', membership);
			if (membership) {
				if (membership.admin) {
					turnToAdmin();
					$('#main-group--reading-add').removeClass('disabled').removeAttr('disabled').on('click', function() {
						if(wishlistMap == null) {
							//
						} else {
							//
						}
						$('#group-modal--reading').modal('show');
					});
					console.log('Membership: ', membership);
					$('#edit-icon').one('click', function() {
						makeEditable(club.displayName, club.description);
					});
					$('#edit-icon').on('keypress', function() {
						$(this).trigger('click');
					});
					// Currently only admin can add to wishlist
					$('#main-group--wishlist-add').removeClass('disabled').removeAttr('disabled');
					$('#main-group--wishlist-add').on('click', function() {
						// get books
						if(myBookMap == null) {
							getUserBooks().then(function(books) {
								myBookMap = {};
								var holder = $('#modal-wishlist--collection');
								for(var i = 0; i < books.length; i++) {
									var book = books[i];
									if(myBookMap[book.id] === undefined) {
										var bookNode = printBook(book);
										holder.append(bookNode);
										myBookMap[book.id] = {
											book: book,
											node: bookNode
										};
									}
								}
								// Populate the modal section
							});
						}
						$('#group-modal--wishlist').modal('show');
					});
					/**
					 * If Admin allows to edit icon
					 */
					var croppable = null;
					var changeIconInput = objToNode({
						node: 'input',
						attrs: {id: 'change-icon', type: 'file'}
					});
					var cancelIconChange = function() {
						console.log(changeIconInput.value);
						croppable = null;
						$('#club-icon').css('display', 'flex');
						$('#croppable-wrapper').empty().append($('<div></div>', {class: 'croppable', id: 'croppable'}));
						$('#icon-controls').empty();
						$('#icon-change-form')[0].reset();
						console.log('After reset: ', changeIconInput.value);
					};
					changeIconInput.addEventListener('change', () => {
						if (croppable === null) {
							croppable = $('.croppable').croppie({
								enableExif: true,
								viewport: {
									width: 180,
									height: 180,
									type: 'square'
								},
								boundary: {
									width: 200,
									height: 200
								}
							});
						}
						var saveButton = objToNode({
							node: 'button',
							attrs: {class: 'btn main-btn'},
							children: [{type:'text', text: getText('Save')}]
						});
						saveButton.addEventListener('click', function() {
							$('#icon-controls .btn').attr('disabled', 'disabled');
							croppable.croppie('result', {type:'canvas',size:'viewport'}).then(function(blob) {
								var saving = ajaxPromise({
									type: 'POST',
									dataType: 'json',
									url: AJAX_DIR + 'postGroupIcon.php',
									data: {
										img64: blob,
										club: clubId
									}
								});
								saving.then(function(c) {
									cancelIconChange();
									console.log('Saved attribute:', c);
									// set the new src
									// this return a club
									$('#club-icon').find('img').attr('src', c.icon);
								});
							});
						});
						var cancel = objToNode({
							node: 'button',
							attrs: {class: 'btn cancel-btn'},
							children: [{type:'text',text:getText('Cancel')}]
						});
						cancel.addEventListener('click', cancelIconChange);
						$('#icon-controls').append(cancel).append(saveButton);
						$('#club-icon').css('display', 'none');

						var reader = new FileReader();
						reader.onload = function(e) {
							croppable.croppie('bind', {
								url: e.target.result
							}).then(function() {console.log('bind complete!');});
						};
						reader.readAsDataURL(changeIconInput.files[0]);
					});
					var changeIconForm = objToNode({
						node: 'form',
						attrs: {id: 'icon-change-form', style: 'display: none;'},
						children: [changeIconInput]
					});
					var changeIconAction = objToNode({
						node: 'div',
						attrs: {class: 'action', id: 'edit-club-icon'},
						children: [
							changeIconForm,
							{
								node: 'label',
								attrs: {for: 'change-icon'},
								children: [{
									node: 'i',
									attrs: {class: 'fas fa-pen'}
								}]
							}
						]
					});

					/**
					 * Allow to edit club name
					 */
					var displayNameSpan = objToNode({
						node: 'span',
						attrs: {class: 'action', tabindex: '0', role: 'button', id: 'edit-club-display-name', title: getText('Edit club name')},
						children: [{
							node: 'i',
							attrs: {class: 'fas fa-pen'}
						}]
					});
					displayNameSpan.addEventListener('click', () => {
						$('.editing').removeClass('editing');
						$('#editable-display-name--input').val($('#editable-display-name--value')[0].childNodes[0].wholeText.trim());
						var jDisplayName = $(displayNameSpan);
						jDisplayName.closest('.editable').addClass('editing');
						var controls = jDisplayName.closest('.editable').find('.actions');
						controls.find('.cancel').on('click', function() {
							jDisplayName.closest('.editable').removeClass('editing');
						});
						controls.find('.save').on('click', function() {
							var val = jDisplayName.closest('.editable').find('input').val();
							updateClubAttribute('name', val).then(function() {
								$('#editable-display-name .value')[0].childNodes[1].nodeValue = val;
								jDisplayName.closest('.editable').removeClass('editing');
							}), function(err) {
								console.warning('failed to save attribute', err);
							};
						});
						$('#editable-display-name--input').focus();
					});
					$('#editable-display-name--value').append(displayNameSpan);

					// Create empty frame for description
					var emptyDescriptionFrame = objToNode({
						node: 'div',
						attrs: {class: 'frame'},
						children: [{
							node: 'div',
							children: [{type: 'text', text: getText('Click here to add a description')}]
						}]
					});
					emptyDescriptionFrame.addEventListener('click', function() {
						$('.editing').removeClass('editing');
						var jDescription = $(emptyDescriptionFrame).closest('.description');
						jDescription.addClass('editing');
						var controls = jDescription.find('.actions');
						controls.find('.cancel').on('click', function() {
							jDescription.removeClass('editing');
						});
						controls.find('.save').on('click', function() {
							var val = $('#editable-description--input').val();
							updateClubAttribute('description', val).then(function() {
								jDescription.removeClass('editing');
								stringToDescription($('#club-description')[0], val);
							});
						});
						resizeTx($('#editable-description--input')[0]);
					});
					$('#club-description').find('.empty').append(emptyDescriptionFrame);

					/**
					 * Allow to edit club description
					 */
					// Create div
					var descriptionControl = objToNode({
							node: 'div',
							attrs: {tabindex: '0', role: 'button', title: getText('Change club description')},
							children: [{
								node: 'i',
								attrs: {class: 'fas fa-pen'}
							}]
					});
					descriptionControl.addEventListener('click', function() {
						$('.editing').removeClass('editing');
						var jDescription = $(descriptionControl).closest('.description');
						jDescription.addClass('editing');
						var controls = jDescription.find('.actions');
						controls.find('.cancel').on('click', function() {
							jDescription.removeClass('editing');
						});
						controls.find('.save').on('click', function() {
							var val = $('#editable-description--input').val();
							updateClubAttribute('description', val).then(function() {
								//
								jDescription.removeClass('editing');
								stringToDescription($('#club-description')[0], val);
							});
						});
						resizeTx($('#editable-description--input')[0]);
					});
					$('#edit-club-description-control').append(descriptionControl);
					
					$('#edit-control--icon').append(changeIconAction);
					var addToWishlistButton = objToNode({
						node: 'button',
						attrs: {class: 'main-btn btn', id: 'add-to-wishlist'},
						children: [{ type: 'text', text: getText('Add a book')}]
					});
					addToWishlistButton.addEventListener('click', () => {
						$('#add-to-wishlist--dialog').modal('show');
						$('#add-to-wislist--filter').focus();
					});
					var addToWishlist = objToNode({
						node: 'div',
						attrs: {class: 'actions'},
						children: [addToWishlistButton]
					});

					var addToWishlistButtonBg = objToNode({
						node: 'button',
						attrs: {class: 'main-btn btn', id: 'add-to-wishlist-bg'},
						children: [{ type: 'text', text: getText('Add a book')}]
					});
					addToWishlistButtonBg.addEventListener('click', () => {
						$('#add-to-wishlist--dialog').modal('show');
						$('#add-to-wislist--filter').focus();
					});
					var addToWishlistBg = objToNode({
						node: 'div',
						attrs: {class: 'actions'},
						children: [addToWishlistButtonBg]
					});

					// check if wihslist is empty
					// Add both buttons in case they empty the list
					$('#group-wishlist').find('.background').append(addToWishlistBg);
					$('#group-wishlist').append(addToWishlist);
					// if ($('#group-wishlist').hasClass('empty')) {
					// 	$('#group-wishlist').find('.background').append(addToWishlist);
					// } else {
					// 	$('#group-wishlist').append(addToWishlist);
					// }
					// TODO addcurrent
					addActionsToReading(null);
				}
				memberBanner();
			}
			// COMMENTING
			setTimeout(function() {
				enableCommenting();
			}, 2000);
		}).catch(function() {
			console.log('catch membership');
			console.log('NOT MEMBER');
			// JOIN or REQUEST INVITATION depending on club type
			var btn = $('<button></button>', {class: 'btn main-btn'}).append(document.createTextNode(getText('JOIN CLUB'))).on('click', function() {
				joinClub(clubId).then(function(response) {
					// Enable messaging if positive response and change button to memer
					// TODO: change button
					// Response can have either a membership if the club is public or a notification if the club is restrcited
					memberBanner();
					enableCommenting()
					// TODO: join can return a membership or an invite
					if (response.membership) {
						// TODO: member now
						// At least enable the comments
					} else if (response.invite) {
						// TODO: request sent
					}
				}).catch(function(e) {
					console.log('failed to join/request invite', e);
				});
				// Jin the club
			});
			var role = $('<div></div>', {Class: 'actions'}).append(btn);
			var holder = $('<div></div>', {class: 'guest'}).append(role);
			$('#membership').append(holder);
		});
		
		//if logged in show the comment thingy
	}

});

</script>