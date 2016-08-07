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
	<title>Prologes: Mi biblioteca</title>
</head>
<body>
	<header class="header">
		<?php
		include("_navbar.php");
		?>
	</header>
	
	<div class="container">
		

		<div class='row user-tabs'>
			<ul class='nav nav-tabs'>
				<li class='active'><a href='#tab-prologes' data-toggle='tab'>Mis Prologos</a></li>
				<li><a href='#tab-reading' data-toggle='tab'>Mis lecturas</a></li>
				<li><a href='#tab-wishlist' data-toggle='tab'>Quiero Leer</a></li>
				<li><a href='#tab-favorite' data-toggle='tab'>Mis favoritos</a></li>
			</ul>
		</div>

		<div class='tab-content'>
			<!-- Prologes DIV -->
			<div id='tab-prologes' class='tab-pane fade in active'>
				<div class='profile-library' id='prologe-library'></div>
			</div>

			<!-- Reading DIV -->
			<div id='tab-reading' class='tab-pane fade'>
				<div class='profile-library' id='reading-library'></div>
			</div>

			<!-- Wishlist DIV -->
			<div id='tab-wishlist' class='tab-pane fade'>
				<div class='profile-library' id='wishlist-library'></div>
			</div>

			<!-- Favorite DIV -->
			<div id='tab-favorite' class='tab-pane fade'>
				<div class='profile-library' id='favorite-library'></div>
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
var p = new MyDataSource({});
var library = new UserLibraryTemplate({base: 'library-book'});
var prologes = new UserPrologeTemplate({base: 'user-prologe'});
var readingHolder = new PrologesDataHolder($('#reading-library'), library);
var favoriteHolder = new PrologesDataHolder($('#favorite-library'), jQuery.extend({}, library));
var wishlistHolder = new PrologesDataHolder($('#wishlist-library'), jQuery.extend({}, library));
var prologeHolder = new PrologesDataHolder($('#prologe-library'), prologes);
	
$(document).ready(function() {
	//getMyLibraryView();
	p.getLibraryView().then(function(library){
		//Print here
		prologeHolder.printCollection(library.posdtas);
		readingHolder.printCollection(library.reading);
		wishlistHolder.printCollection(library.wishlisted);
		favoriteHolder.printCollection(library.favorited);
		console.log(library);
	});
});

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
</script>
