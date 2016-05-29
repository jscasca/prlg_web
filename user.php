<?php
session_start();
//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Prologes</title>
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
			<div class="col-md-8 col-sm-12">
				<section class="main-user">
					<div class="main-user--icon">
						<img src="img/defaultuser.png" alt="Cover" id="user-icon" class="backup-user"/>
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
		
		<div class="row">
			<div class="profile-library" id="profile-library">
			</div>
		</div>
		
		<div class="row">
			<div class="profile-prologes" id="profile-prologes">
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
	var userId = "<?php echo $_REQUEST['i'];?>";
	var retries = 0;
	
$(document).ready(function() {
	getUserInfo(userId);
	if(loggedIn) {
		getUserInteractions(userId);
	}
	$('.backup-thumb').error(function() {
		$(this).attr('src', 'img/default.png');
	});
	$('.backup-cover').error(function() {
		$(this).attr('src', 'img/default.png');
	});
	$('#user-icon').error(function(){this.src='img/defaultuser.png';});
});

function getUserInteractions(id) {
	
}

function getUserInfo(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getUserInfo.php',
	  data: {user: id},
	  success: function(data){
			displayUserInfo(data);
		  },
	  error: function() {
		  retries++;
		  if(retries < 10)
			setTimeout('getBookInfo('+id+')', 300);
	  }
	});
}

function displayUserInfo(info) {
	var user = info.user;
	printUserDetails(user);
	var favoriteBooks = info.booksFavorited;
	printUserFavorites(favoriteBooks);
	var readingBooks = info.booksReading;
	printUserReading(readingBooks);
	var wishlistedBooks = info.booksWishlisted;
	printUserWishlist(wishlistedBooks);
	var prologes = info.posdtas;
	printUserProloges(prologes);
}

function printUserDetails(user) {
	$('#user-display').text(user.displayName);
	$('#user-name').html(user.userName);
	if(user.icon == null || user.icon == '')user.icon = 'img/defaultuser.png';
	$('#user-icon').attr('src', user.icon);
}

function printUserFavorites(books) {
	if(books.length == 0) {
		
	} else {
		var holder = $('#profile-library');
		var section = $('<h2></h2>').append('Libros favoritos');
		holder.append(section);
		var row = $('<div></div>',{class:'row'});
		holder.append(row);
		$(books).each(function(index, book) {
			if(index % 3 == 0) {
				row = $('<div></div>', {class:'row'});
				holder.append(row);
			}
			printBook(row, book);
		});
	}
		
}

function printUserReading(books) {
	if(books.length == 0) {
		
	} else {
		var holder = $('#profile-library');
		var section = $('<h2></h2>').append('Libros que esta leyendo');
		holder.append(section);
		var row = $('<div></div>',{class:'row'});
		holder.append(row);
		$(books).each(function(index, book) {
			if(index % 3 == 0) {
				row = $('<div></div>', {class:'row'});
				holder.append(row);
			}
			printBook(row, book);
		});
	}
}

function printUserWishlist(books) {
	if(books.length == 0) {
		
	} else {
		var holder = $('#profile-library');
		var section = $('<h2></h2>').append('Libros que quiere leer');
		holder.append(section);
		var row = $('<div></div>',{class:'row'});
		holder.append(row);
		$(books).each(function(index, book) {
			if(index % 3 == 0) {
				row = $('<div></div>', {class:'row'});
				holder.append(row);
			}
			printBook(row, book);
		});
	}
		
}

function printBook(holder, book) {
	var article = $('<article></article>', {class:'library-book'});
	var div = $('<div></div>', {class:'col-md-4'});
	var thumb = $('<div></div>', {class:'library-book--thumbnail'});
	var thumbLink = $('<a></a>', {href:'book.php?i='+book.id});
	var thumbnailSrc = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
	var thumbImg = $('<img>', {src:thumbnailSrc, alt:'Cover', class:'backup-thumb'});
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
	
	//var clearfix = $('<div></div>', {class:'clearfix'});
	//holder.append(clearfix);
}

function printUserProloges(prologes) {
	var holder = $('#profile-prologes');
	if(prologes.length == 0) {
		
	} else {
		holder.prepend("<h2>Prólogos</h2>");
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

function printProloge(holder, prologe) {
	
	var book = prologe.book;
	
	var section = $('<section></section>',{class:'user-prologe'});
	var thumbnail = $('<div></div>',{class:'user-prologe--thumbnail'});
	var thumbnailLink = $('<a></a>',{href:'book.php?i='+book.id});
	var thumbnailSrc = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
	var thumbnailImg = $('<img>', {src:thumbnailSrc, alt:'Cover', class:'backup-thumb'});
	thumbnailImg.error(function() {
		this.src = 'img/defaultthumb.png';
	});
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
