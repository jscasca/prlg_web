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
	<title>Prologes</title>
</head>
<body>
	<header class="header">
		<?php
		include("_navbar.php");
		?>
	</header>
	
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-12">
				<section class="main-user">
					<div class="main-user--icon">
						<img src="../img/defaultuser.png" alt="Cover" id="user-icon" class="backup-user"/>
					</div>
					<div class="main-user--info">
						<h2 id="user-display"></h2>
						<h4 id="user-name"></h4>
					</div>
				</section>
				
			</div>
			
			<div class="col-md-4 col-sm-12" id="similar-books">
			</div>
		</div>

		<div class='row user-tabs'>
			<ul class='nav nav-tabs'>
				<li class='active'><a href='#tab-prologes' data-toggle='tab'>Prologues</a></li>
				<li><a href='#tab-reading' data-toggle='tab'>Reading</a></li>
				<li><a href='#tab-wishlist' data-toggle='tab'>Wishlisted</a></li>
				<li><a href='#tab-favorite' data-toggle='tab'>Favorites</a></li>
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
		
		<!--<div class="row">
			<div class="profile-library" id="profile-library">
			</div>
		</div>
		
		<div class="row">
			<div class="profile-prologes" id="profile-prologes">
				<div class="col-md-6" id="left-prologes"></div>
				<div class="col-md-6" id="right-prologes"></div>
			</div>
		</div>-->
		
	<!--ends container -->	
	</div>
	
	<?php
	include("_footer.php");
	?>
</body>
</html>
<script type="text/javascript">
	var userId = "<?php echo $_REQUEST['i'];?>";
	var retries = 0;
var p = new UserDataSource({});
var u = new UserHandler();
var library = new UserLibraryTemplate({base: 'library-book'});
var prologes = new UserPrologeTemplate({base: 'user-prologe'});
var readingHolder = new PrologesDataHolder($('#reading-library'), library);
var favoriteHolder = new PrologesDataHolder($('#favorite-library'), jQuery.extend({}, library));
var wishlistHolder = new PrologesDataHolder($('#wishlist-library'), jQuery.extend({}, library));
var prologeHolder = new PrologesDataHolder($('#prologe-library'), prologes);
$(document).ready(function() {
	//getUserInfo(userId);

	p.getUserInfo(userId).then(function(data){
		u.displayUser(data, $('#user-display'), $('#user-name'), $('#user-icon'));

	});

	p.getProloges(userId).then(function(prologes){
		prologeHolder.printCollection(prologes);
	});

	p.getBooksReading(userId).then(function(books){
		readingHolder.printCollection(books);
	});

	p.getBooksWishlisted(userId).then(function(books){
		wishlistHolder.printCollection(books);
	});

	p.getBooksFavorited(userId).then(function(books){
		favoriteHolder.printCollection(books);
	});
	if(loggedIn) {
		//getUserInteractions(userId);
	}
});

</script>
