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
		<div class="col-md-12">
			<section class="main-author">
				<div class="main-author--pic">
					<img src="img/defaultuser.png" alt="Author" id="author-pic" class="backup-pic"/>
				</div>
				<div class="main-author--info">
					<h2 id="author-name">Nombre del Autor</h2>
				</div>
			</section>
		</div>
		
		<div class="col-md-12 col-sm-12" id="authorBooks">
			<h2 class="Section-title no-padding">Libros de este autor</h2>
			
			<!--
			<article class="similar-book">
				<figure class="similar-book--thumbnail">
					<img src="img/defaultthumb.png" alt="Cover">
				</figure>
				<div class="similar-book--info">
					<h3>Titulo del Libro: la venganza de los titulos largos</h3>
					<div class="similar-book--rating">
						<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
					</div>
				</div>
				<div class="similar-book--actions text-right">
					actions
				</div>
			</article>-->
		</div>
		
	<!--ends container -->	
	</div>
	
	<?php
	include("_footer.php");
	?>
</body>
</html>
<script type="text/javascript">
	var authorId = "<?php echo $_REQUEST['i'];?>";
	
$(document).ready(function() {
	getAuthorInfo(authorId);
	getAuthorBooks(authorId);
	$('.backup-thumb').error(function() {
		console.log("img error");
		$(this).attr('src', 'img/defaultthumb.png');
	});
	$('.backup-pic').error(function() {
		$(this).attr('src', 'img/defaultuser.png');
	});
});

function getAuthorInfo(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getAuthor.php',
	  data: {author: id},
	  success: function(data){ displayAuthor(data); },
	  error: function() { console.log('something went wrong'); }
	});
}

function getAuthorBooks(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getAuthorBooks.php',
	  data: {author: id},
	  success: function(data){ displayAuthorBooks(data); },
	  error: function() { console.log('something went wrong'); }
	});
}

function displayAuthor(author) {
	
	var authorPic = author.icon;
	if(authorPic != null && authorPic != '')
		$('#author-pic').attr('src', bookCover);
	var authorName = author.name;
	$('#author-name').html(authorName);
}

function displayAuthorBooks(books) {
	$(books).each(function(index, book) {
		console.log(book);
		
		var thumb = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
		var holder = $("#authorBooks");
		var div = $('<div></div>', {class:'col-md-4 col-sm-6'});
		var article = $('<article></article>', {class:'similar-book'});
		var divThumb = $('<div></div>', {class:'similar-book--thumbnail'});
		var bookLink = $('<a></a>',{href:'book.php?i='+book.id});
		var divThumbImg = $('<img>', {src:thumb, alt:'Cover', class:'backup-thumb'});
		bookLink.append(divThumbImg);
		divThumb.append(bookLink);
		article.append(divThumb);
		
		var titleLink = $('<a></a>',{href:'book.php?i='+book.id});
		var divInfo = $('<div></div>', {class:'similar-book--info'});
		var divInfoTitle = $('<h3>'+book.title+'</h3>');
		divInfo.append(titleLink.append(divInfoTitle));
		var bookRating = $('<div></div>', {class: 'similar-book--rating'});
		
		var rating = 0;
		if(book.rating != null) {
			rating = book.rating.rating;
		}
		bookRating = getRatingDiv(bookRating, rating);
		divInfo.append(bookRating);
		article.append(divInfo);
		div.append(article);
		holder.append(div);
		
	});
}
/*
<div class="col-md-4 col-sm-6">
				<article class="similar-book">
					<div class="similar-book--thumbnail">
						<img src="img/defaultthumb.png" alt="Cover">
					</div>
					<div class="similar-book--info">
						<h3>Titulo del Libro</h3>
						<div class="similar-book--rating">
							<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
						</div>
					</div>
				</article>
			</div>
*/

function getBookCard(id, title, author, rating, cover) {
	var div = $('<div></div>',{class:'col-md-4'});
	var bookCard = $('<article></article>', {class:'book-card'});
	var bookLink = $('<a></a>',{href:'book.php?i='+id});
	var bookThumb = $('<div></div>', {class: 'book-card--thumbnail'});
	var thumb = $('<img>',{alt:'Book cover', src: cover});
	var bookInfo = $('<div></div>', {class: 'book-card--info'});
	var bookTitle = $('<h5></h5>').html(title);
	var bookAuthor = $('<h6></h6>').html(author);
	var bookRating = $('<div></div>', {class: 'book-card--rating'});
	bookRating = getRatingDiv(bookRating, rating);
	bookCard.append(bookThumb.append(bookLink.append(thumb)))
		.append(bookInfo.append(bookTitle).append(bookAuthor).append(bookRating));
	div.append(bookCard);
	return div;
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
