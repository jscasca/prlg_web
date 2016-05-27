<?php
session_start();
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Prologes: Mi biblioteca</title>
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
		<div class="row">
			<h2>Libros que estas leyendo</h2>
			<div class="my-library" id="mylibrary-reading"></div>
		</div>
		<div class="row">
			<h2>Libros que quieres leer</h2>
			<div class="my-library" id="mylibrary-wishlist"></div>
		</div>
		<div class="row">
			<h2>Tus libros favoritos</h2>
			<div class="my-library" id="mylibrary-favorites"></div>
		</div>
		<div class="row">
			<h2>Tus prólogos</h2>
			<div class="mylibrary-prologes" id="mylibrary-prologes">
				<div class="col-md-6" id="left-prologes"></div>
				<div class="col-md-6" id="right-prologes"></div>
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
	
$(document).ready(function() {
	getMyLibraryView();
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
	
	printFavorites(library.favorited);
	printReadings(library.reading);
	printWishlist(library.wishlisted);
	printProloges(library.posdtas);
}

function printFavorites(books) {
	var holder = $('#mylibrary-favorites');
	printLibrarySection(books, holder, printEmptyFavorites);
}

function printReadings(books) {
	var holder = $('#mylibrary-reading');
	printLibrarySection(books, holder, printEmptyReading);
}

function printWishlist(books) {
	var holder = $('#mylibrary-wishlist');
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
	var article = $('<article></article>', {class:'library-book'});
	var div = $('<div></div>', {class:'col-md-4'});
	var thumb = $('<div></div>', {class:'library-book--thumbnail'});
	var thumbLink = $('<a></a>', {href:'book.php?i='+book.id});
	thumbnail = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
	var thumbImg = $('<img>', {src:thumbnail, alt:'Cover'});
	thumbImg.error(function() {
		this.src = 'img/defaultthumb.png';
		});
	thumbLink.append(thumbImg);
	thumb.append(thumbLink);
	article.append(thumb);
	
	var info = $('<div></div>', {class:'library-book--info'});
	var infoLink = $('<a></a>', {href:'book.php?i='+book.id});
	var infoTitle = $('<h3>'+book.title+'</h3>');
	
	var infoRating = $('<div></div>', {class:'library-book--rating'});
	var rating = 0;
	if(book.rating != null) { rating = book.rating.rating; }
	infoRating = getRatingDiv(infoRating, rating);
	
	infoLink.append(infoTitle);
	info.append(infoLink);
	info.append(infoRating);
	article.append(info);
	div.append(article);
	holder.append(div);
}

function printProloges(prologes) {
	var holder = $('#mylibrary-prologes');
	if(prologes.length == 0) {
		printEmptyProloge(holder);
	} else {
		var leftHolder = $('#left-prologes');
		var rightHolder = $('#right-prologes');
		$(prologes).each(function (index, prologe) {
			if(index % 2 == 0) {
				printProloge(leftHolder, prologe);
			} else {
				printProloge(rightHolder, prologe);
			}
		});
		
	}
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
	var thumbnailLink = $('<a></a>',{href:'book.php?i='+book.id});
	var thumb = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
	var thumbnailImg = $('<img>',{src: thumb, alt:"Cover"}).error(function(){this.src = 'img/defaultthumb.png';});
	thumbnailLink.append(thumbnailImg);
	thumbnail.append(thumbnailLink);
	section.append(thumbnail);
	var text = $('<div></div>', {class:'user-prologe--text'});
	var textTitle = $('<h4></h4>').append(book.title);
	var textLink = $('<a></a>',{href:'book.php?i='+book.id});
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
