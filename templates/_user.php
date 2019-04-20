<?php

?>
<div class="row">
	<div class="col-md-8 col-sm-12">
		<div class="prlg-panel">
			<section class="main-user">
				<div class="icon">
					<img src="../img/defaultuser.png" alt="Cover" id="user-icon" class="backup-user"/>
					<!-- <div class="main-user--follow" id="main-user--follow"></div> -->
				</div>
				<div class="info">
					<div id="user-display" class="display-name"></div>
					<div id="user-name" class="username"></div>
					<div id="currently-reading" class="currently-reading"></div>
				</div>
			</section>
		</div>
		
	</div>
</div>

<div class='row'>
	<div class='panle prlg_panel'>
</div>

<div class='row'>
	<ul class='nav nav-tabs underline-tabs'>
		<li class='active'><a href='#tab-prologes' data-toggle='tab'><?php echo getTranslation('Prologues'); ?></a></li>
		<!-- <li><a href='#tab-reading' data-toggle='tab'>Reading</a></li> -->
		<li><a href='#tab-wishlist' data-toggle='tab'><?php echo getTranslation('Wishlist'); ?></a></li>
		<li><a href='#tab-favorite' data-toggle='tab'><?php echo getTranslation('Favorites'); ?></a></li>
	</ul>
</div>

<div class='tab-content'>
	<!-- Prologes DIV -->
	<div id='tab-prologes' class='tab-pane fade in active'>
		<div class='user-prologes' id='prologe-library'></div>
	</div>

	<!-- Reading DIV -->
	<!-- <div id='tab-reading' class='tab-pane fade'>
		<div class='profile-library' id='reading-library'></div>
	</div> -->

	<!-- Wishlist DIV -->
	<div id='tab-wishlist' class='tab-pane fade'>
		<div class='default-book-list' id='wishlist-library'></div>
	</div>

	<!-- Favorite DIV -->
	<div id='tab-favorite' class='tab-pane fade'>
		<div class='default-book-list' id='favorite-library'></div>
	</div>
</div>
<script type="text/javascript">
var userId = '<?php echo $userid != null ? $userid : ""; ?>';
var userName = '<?php echo $username != null ? $username : ""; ?>';

var p = new UserDataSource({});
var t = new Translator();
var u = new UserHandler({translator: t});
var library = new UserLibraryTemplate({base: 'library-book'});
var prologes = new UserPrologeTemplate({base: 'user-prologe'});
var readingHolder = new PrologesDataHolder($('#reading-library'), library);
var favoriteHolder = new PrologesDataHolder($('#favorite-library'), jQuery.extend({}, library));
var wishlistHolder = new PrologesDataHolder($('#wishlist-library'), jQuery.extend({}, library));
var prologeHolder = new PrologesDataHolder($('#prologe-library'), prologes);
$(document).ready(function() {
	//getUserInfo(userId);

	getUserInfo(userId, userName).then(function(profile){
		console.log(profile);
		var user = profile.user;

		$('#user-display').text(user.displayName);
		$('#user-name').text('@' + user.userName);
		$('#user-icon').attr('src', user.icon);

		//print prologues
		prologeHolder.printCollection(profile.rated);
		printUserReadings(profile.readingBooks);
		// readingHolder.printCollection(profile.readingBooks);
		wishlistHolder.printCollection(profile.wishlistBooks);
		favoriteHolder.printCollection(profile.favouriteBooks);
	});

	function printUserReadings(readings) {

		var printBook = function(book) {
			var img = $('<img>', {src: book.icon});
			var icon = $('<div></div>', {class: 'icon'}).append(img);
			var titleLink = $('<a></a>', {href: ROOT_PATH + 'book/' + book.id}).append(document.createTextNode(book.title));
			var title = $('<div></div>', {class: 'title'}).append(titleLink);
			var author = $('<div></div>', {class: 'author'});
			for(var i = 0; i < book.authors.length; i++) {
				var link = $('<a></a>', { href: ROOT_PATH + 'author/' + book.authors[i].id}).append(document.createTextNode(book.authors[i].name));
				if(i > 0) author.append(document.createTextNode(', '));
				author.append(link);
			}
			var info = $('<div></div>', {class: 'info'}).append(title).append(author);
			var bookDiv = $('<div></div>', {class: 'book'}).append(icon).append(info);

			return bookDiv;
		}
		console.log(readings);
		var holder = $('#currently-reading');
		if(readings.length > 0) {
			var description = $('<div></div>', {class: 'description'}).append(document.createTextNode(getText('Currently reading:')));
			// print first only
			var firstBook = readings[0];

			var book = printBook(firstBook);

			var bookList = $('<div></div>', {class: 'book-list'}).append(book);

			holder.append(description);
			holder.append(bookList);
		} else {
			// display not reading anything
			var div = $('<div></div>', {class: 'empty-list' }).append(document.createTextNode(getText('Currently not reading anything')));
			holder.append();
		}
	}

	// p.getUserInfo(userId).then(function(data){
	// 	u.displayUser(data, $('#user-display'), $('#user-name'), $('#user-icon'));
	// });

	// p.getProloges(userId).then(function(prologes){
	// 	prologeHolder.printCollection(prologes);
	// });

	// p.getBooksReading(userId).then(function(books){
	// 	readingHolder.printCollection(books);
	// });

	// p.getBooksWishlisted(userId).then(function(books){
	// 	wishlistHolder.printCollection(books);
	// });

	// p.getBooksFavorited(userId).then(function(books){
	// 	favoriteHolder.printCollection(books);
	// });
	// if(loggedIn) {
	// 	p.getUserInteractions(userId).then(function(interactions){
	// 		console.log(interactions);
	// 		u.displayInteractionButton(userId, interactions, $('#main-user--follow'));
	// 	});
	// 	//getUserInteractions(userId);
	// }
});

function getNextWishlistedBooks(userid) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getUserWishlisted.php',
		data: {start: '0', limit: ''}
	});
}

function getUserInfo(userid, username) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getUserLibrary.php',
		data: {userid: userid, username: username}
	});
}
</script>