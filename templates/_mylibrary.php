<?php

?>
<div class='row'>
	<ul class='nav nav-tabs underline-tabs'>
		<li class='active'><a href='#tab-prologes' data-toggle='tab'>Prologues</a></li>
		<!-- <li><a href='#tab-reading' data-toggle='tab'>Reading</a></li> -->
		<li><a href='#tab-wishlist' data-toggle='tab'>Wishlisted</a></li>
		<li><a href='#tab-favorite' data-toggle='tab'>Favorites</a></li>
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
<!-- <div class="row">
	<h2 id='library-reading--header'></h2>
	<div class="my-library" id="mylibrary-reading"></div>
</div>
<div class="row">
	<h2 id='library-wishlist--header'></h2>
	<div class="my-library" id="mylibrary-wishlist"></div>
</div>
<div class="row">
	<h2 id='library-favourites--header'></h2>
	<div class="my-library" id="mylibrary-favorites"></div>
</div>
<div class="row">
	<h2 id='library-prologes--header'></h2>
	<div class="mylibrary-prologes" id="mylibrary-prologes">
		<div class="col-md-6" id="left-prologes"></div>
		<div class="col-md-6" id="right-prologes"></div>
	</div>
</div> -->
<script type="text/javascript">
	var retries = 0;
	
$(document).ready(function() {
	getMyLibraryView();

	$('#library-reading--header').text(getText('Currently reading'));
	$('#library-wishlist--header').text(getText('My wishlist'));
	$('#library-favourites--header').text(getText('My favourites'));
	$('#library-prologes--header').text(getText('My prologes'));
});

function getMyLibraryView(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getMyLibraryView.php',
	  success: function(data){ displayMyLibrary(data); },
	  error: function() { retries++; if(retries < 10) { setTimeout('getMyLibraryView()', 300); } }
	});
}

function displayMyLibrary(library) {
	/*printFavorites([]);
	printReadings([]);
	printWishlist([]);
	printProloges([]);*/
	debugger;
	
	printFavorites(library.favorited);
	printReadings(library.reading);
	printWishlist(library.wishlisted);
	printProloges(library.posdtas);
}

function printFavorites(books) {
	var holder = $('#favorite-library');
	printLibrarySection(books, holder, printEmptyFavorites);
}

function printReadings(books) {
	var holder = $('#reading-library');
	printLibrarySection(books, holder, printEmptyReading);
}

function printWishlist(books) {
	var holder = $('#wishlist-library');
	printLibrarySection(books, holder, printEmptyWishlist);
}

function printLibrarySection(books, holder, emptyCallback) {
	if(books.length == 0) {return emptyCallback(holder);}
	return printBooks(holder, books);
}

function printBooks(holder, books) {
	$(books).each(function(index, book) {
		printBook(holder, book);
	});
}

function printEmptyFavorites(holder) {
	var info = $('<div></div>', {class:'library-book--info text-center'});
	var infoTitle = $('<h3>No has agregado ningún libro a tus favoritos</h3>');
	var infoIconDiv = $('<div></div>', {class:'library-book--icon'});
	var infoIcon = $('<div class="icon-favorite text-center"></div>');
	infoIconDiv.append(infoIcon);
	info.append(infoTitle);
	info.append(infoIconDiv);
	printEmpty(holder, info);
}

function printEmptyReading(holder) {
	var info = $('<div></div>', {class:'library-book--info text-center'});
	var infoTitle = $('<h3>No estas leyendo ningún libro</h3>');
	var infoIconDiv = $('<div></div>', {class:'library-book--icon'});
	var infoIcon = $('<div class="icon-reading text-center"></div>');
	infoIconDiv.append(infoIcon);
	info.append(infoTitle);
	info.append(infoIconDiv);
	printEmpty(holder, info);
}

function printEmptyWishlist(holder) {
	var info = $('<div></div>', {class:'library-book--info text-center'});
	var infoTitle = $('<h3>No has agregado libros que quieras leer</h3>');
	var infoIconDiv = $('<div></div>', {class:'library-book--icon'});
	var infoIcon = $('<div class="icon-wishlist text-center"></div>');
	infoIconDiv.append(infoIcon);
	info.append(infoTitle);
	info.append(infoIconDiv);
	printEmpty(holder, info);
}

function printEmpty(holder, div) {
	var article = $('<article></article>', {class:'library-book'});
	article.append(div);
	holder.append(article);
}

function printBook(holder, book) {
	var bookCard = $('<article></article>', {class: 'book prlg-panel'});
	var bookThumbLink = $('<a></a>',{href: ROOT_PATH + 'book/' +book.id});
	var bookThumb = $('<div></div>', {class: 'icon'});
	
	var cover = book.thumbnail == null ? '../img/defaultthumb.png' : book.thumbnail;
	var thumb = $('<img>',{alt:'Book cover', src: cover});
	
	var bookInfo = $('<div></div>', {class: 'info'});
	var bookTitleLink = $('<a></a>',{href:ROOT_PATH + 'book/' +book.id}).append(book.title);
	var bookTitle = $('<div></div>', {class: 'title'}).append(bookTitleLink);
	// var bookTitle = $('<h5></h5>').text(book.title);
	// var bookAuthor = $('<h6></h6>').text(book.authorName);
	var authors = book.authors.reduce(function(linkArray, author) {
		// linkArray.push(author.name);
		linkArray.push("<a href='" + ROOT_PATH + "author/" + author.id + "' >" + author.name +"</a>");
		return linkArray;
	}, []);
	//authorHolder.append(authors.join(",&nbsp"));
	var bookAuthor = $('<div></div>', {class: 'author'}).html(authors.join(",&nbsp"));
	
	// var bookRating = $('<div></div>', {class: base + '--rating'});
	// var rating = book.rating != null ? book.rating.rating : 0;
	// bookRating = populateRatingDiv(bookRating, rating);
	
	bookThumb.append(thumb);
	bookThumbLink.append(bookThumb);
	bookCard.append(bookThumbLink);

	bookInfo.append(bookTitle);
	bookInfo.append(bookAuthor);
	bookCard.append(bookInfo);

	// bookCard.append(bookRating);
	// return bookCard;
	holder.append(bookCard);
}

function printProloges(prologes) {
	var holder = $('#prologe-library');
	if(prologes.length == 0) {
		printEmptyProloge(holder);
	} else {
		$(prologes).each(function(index, prologe) {
			//
			var getElement = function(prologe) {
				var getThumbnail = function(user) {
					var link = $('<a></a>', {href: ROOT_PATH + 'book/' +user.id});
					var img = $('<img>',{src: user.icon, alt:"user", onerror:'this.setAttribute("src", "' + ROOT_PATH +'img/defaultthumb.png");'});
					var holder = $('<div></div>',{class: 'icon'});
					link.append(img);
					holder.append(link);
					return holder;
				};

				var getContent = function(prologe) {
					var holder = $('<div></div>', {class: 'content'});
					holder.append(getBookTitle(prologe.book));
					holder.append(getProloge(prologe));
					holder.append(getRating(prologe.rating));
					return holder;
				};

				var getBookTitle = function(book) {
					var link = $('<a></a>', {href: ROOT_PATH + 'book/' + book.id}).append(book.title);
					var holder = $('<div></div>', {class: 'title'});
					return holder.append(link);
				};

				var getRating = function(userRating) {
					var rating = $('<div></div>', {class: 'rating'});
					rating = populateRatingDiv(rating, userRating);
					return rating;
				};

				var getProloge = function(prologe) {
					var holder = $('<div></div>', {class: 'prologue'}).append(prologe.posdta);
					return holder;
				};
				var holder = $('<section></section>',{class:'prologe prlg-panel'});
				holder.append(getThumbnail(prologe.book));
				holder.append(getContent(prologe));
				return holder;
			};

			holder.append(getElement(prologe));
		});
	}

	// if(prologes.length == 0) {
	// 	printEmptyProloge(holder);
	// } else {
	// 	var leftHolder = $('#left-prologes');
	// 	var rightHolder = $('#right-prologes');
	// 	$(prologes).each(function (index, prologe) {
	// 		if(index % 2 == 0) {
	// 			printProloge(leftHolder, prologe);
	// 		} else {
	// 			printProloge(rightHolder, prologe);
	// 		}
	// 	});
		
	// }
}

function printEmptyProloge(holder) {
	var info = $('<div></div>', {class:'library-book--info text-center'});
	var infoTitle = $('<h3>No has escrito ningún prólogo!</h3>');
	var infoIconDiv = $('<div></div>', {class:'library-book--icon'});
	var infoIcon = $('<div class="icon-prologe text-center"></div>');
	infoIconDiv.append(infoIcon);
	info.append(infoTitle);
	info.append(infoIconDiv);
	printEmpty(holder, info);
}

function printProloge(holder, prologe) {
	
	var book = prologe.book;
	
	var section = $('<section></section>',{class:'user-prologe'});
	var thumbnail = $('<div></div>',{class:'user-prologe--thumbnail'});
	var thumbnailLink = $('<a></a>',{href:'book/'+book.id});
	var thumb = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
	var thumbnailImg = $('<img>',{src: thumb, alt:"Cover"}).error(function(){this.src = 'img/defaultthumb.png';});
	thumbnailLink.append(thumbnailImg);
	thumbnail.append(thumbnailLink);
	section.append(thumbnail);
	var text = $('<div></div>', {class:'user-prologe--text'});
	var textTitle = $('<h4></h4>').append(book.title);
	var textLink = $('<a></a>',{href:'book/'+book.id});
	var textParagraph = $('<p></p>').html(prologe.posdta);
	textLink.append(textTitle);
	text.append(textLink);
	text.append(textParagraph);
	section.append(text);
	var rating = $('<div></div>', {class:'user-prologe--rating text-right'});
	var userRating = 0;
	if(prologe.rating != null) {userRating = prologe.rating;}
	rating = getRatingDiv(rating, userRating);
	section.append(rating);
	holder.append(section);
}

function getRatingDiv(ratingDiv, rating) {
	if(rating == null) rating = 0;
	var stars = Math.floor(rating);
	for(var i = 0; i < stars; i++) {
		ratingDiv.append('<span class="fas fa-star"></span>');
	}
	if(rating%1 > 0) {
		ratingDiv.append('<span class="fas fa-star-half-alt"></span>');
		stars++;
	}
	for(var i = stars; i < 5; i++) {
		ratingDiv.append('<span class="far fa-star"></span>');
	}
	return ratingDiv;
}


</script>