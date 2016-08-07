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
	<title>Prologes: My Library</title>
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
				<li class='active'><a href='#tab-prologes' data-toggle='tab'>My Prologues</a></li>
				<li><a href='#tab-reading' data-toggle='tab'>My Readings</a></li>
				<li><a href='#tab-wishlist' data-toggle='tab'>My Wishlist</a></li>
				<li><a href='#tab-favorite' data-toggle='tab'>My Favorites</a></li>
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
</script>
