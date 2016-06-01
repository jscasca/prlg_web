<?php
session_start();
//if(!isset($_SESSION[SID]))die($_SESSION[SID]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Prologes</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
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
		<div id="index-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="search.php">
						<div class="modal-header text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h2 id="index-modal--header"></h2>
						</div>
						<div class="modal-body text-center">
							<div class="index-modal--info">
								<span id="index-modal--text"></span>
							</div>
							<div class="input-group index-modal--search">
								<input class="form-control" type="text" name="q" id="index-modal--field">
								<div class="input-group-btn">
									<button type="submit" class="btn search-button" id="index-modal--submit">
										<i class="glyphicon glyphicon-search"></i>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<?php
		if(!isset($_SESSION[SID])) {
		?>
		<div class="row">
			<div class="welcome">
				<!-- inicia sesion o registrate -->
				<div class="col-md-4">
					<div class="welcome-padding-top-left"></div>
					<div class="welcome-login text-center">
						<h5>¿No tienes cuenta aún?</h5>
						<a href="registration.php">Registrate</a>
						<h4>¿Ya eres miembro?</h4>
						<a href="login.php">¡Inicia sesión!</a>
					</div>
				</div>
				
				<!-- Que es Prologes -->
				<div class="col-md-4">
					<div class="welcome-whatis">
						<div class="welcome-whatis--header text-center">
							<h1><span>B</span>ienvenido</h1>
						</div>
						<div class="welcome-whatis--body">
							<p>Únete y descubre una nueva comunidad de lectores!</p>
							<p>Marca los libros que quieres leer, los que estas leyendo y escribe prólogos para convertirte en un lider de opinión en la comunidad!</p>
						</div>

					</div>
										
				</div>
				
				<!-- Algo random -->
				<div class="col-md-4">
					<div class="welcome-padding-top-right"></div>
					<div class="welcome-prologes">
						<p>Empieza a leer los prólogos que la comunidad ha escrito para ti!</p>
						<div class="welcome-prologes--prologes">
							<div class="icon-prologe-noeffect text-center"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?
		} else {
		?>
		<div class="row">
			
			<div class="index-buttons">
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--prologo">
						<div class="index-action--prologo">Escribe un prólogo</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--reading">
						<div class="index-action--reading">Comparte lo que lees</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--favorite">
						<div class="index-action--favorite">Encuentra tus favoritos</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--wishlist">
						<div class="index-action--wishlist">Agrega libros a tu lista</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">	
			<div class="index-search">
				<form class="" action="search.php">
					<div class="input-group">
						<input class="form-control" id="index-search--field" type="text" name="q" placeholder="Encuentra tu siguiente historia" />
						<div class="input-group-btn">
							<button class="btn btn-default" id="index-search--submit" type="submit">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
					
				</form>
				<!--<div class="index-search">
					<form class="" action="search.php">
						<div class="index-search--form">
							<input class="form-control" type="text" name="q" placeholder="Encuentra tu siguiente historia">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>-->
			</div>
		</div>
		<?php
		}
		?>
		
		
		
		
		<div class="main-page">
			<div class="row">
				<!-- Right scroll -->
				<div class="col-md-4 col-md-push-8">
					<h3 class="Section-title no-padding">Libros más leídos</h3>
					<div class="book-cards">
						<div class="row" id="mostReadBooks">
						</div>
					</div>
				</div>
				
				<!-- Main stuff -->
				<div class="col-md-8 col-md-pull-4">
					<h3 class="Section-title no-padding">Que esta pasando?</h3>
					<div class="event-cards" id="event-holder">
						
						
					</div>
					
					
				</div>
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
	
$(document).ready(function() {
	getMostReadBooks();
	getEvents();
	
	$('#index-action--prologo').click(function() { displayIndexModal("Escribe un Prólogo", "¿De que libro quieres escribir un prólogo?"); });
	$('#index-action--favorite').click(function() { displayIndexModal("Encuentra tus favoritos", "¿Cual es tu libro favorito?"); });
	$('#index-action--reading').click(function() { displayIndexModal("Comparte lo que estas leyendo", "¿Que libro estas leyendo?"); });
	$('#index-action--wishlist').click(function() { displayIndexModal("Agregalos a tu lista", "¿Que libro quieres agregar a tu lista de lectura?"); });
});

function displayIndexModal(header, message) {
	$('#index-modal--header').html(header);
	$('#index-modal--text').html(message);
	$('#index-modal').modal('show');
}
	
function getMostReadBooks() {
	//Ajax and stuff
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getMostRead.php',
	  data: {limit: 3},
	  success: function(data){ displayMostReadBooks(data); },
	  error: function() { console.log('something went wrong'); }
	});
}

function getEvents() {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getEvents.php',
	  success: function(data){ displayEvents(data); },
	  error: function() { console.log('something went wrong'); }
	});
}

function displayEvents(events) {
	var holder = $('#event-holder');
	$(events).each(function(index, event) {
		prepareEvent(holder, event);
	});
}

function prepareEvent(holder, event) {
	var type = event.eventType;
	var time = event.eventDate;
	switch(type) {
		case 'FAVORITED': printEventFavorite(holder, event); break;
		case 'STARTED_READING': printEventStarted(holder, event); break;
		case 'POSDTA': printEventProloge(holder, event); break;
		default: console.log(event); break;
	}
}

function printEvent(holder, subject, target, info) {
	var article = $('<article></article>', {class: 'event-card'});
	article.append(subject);
	article.append(target);
	article.append(info);
	holder.append(article);
}

function getEventUserThumbnail(user) {
	var thumbnail = $('<div></div>', {class:'event-card--thumbnail'});
	var thumbnailImg = $('<img>', {class:'backup-user', alt:'user', src: user.icon});
	var thumbnailLink = $('<a></a>', {href: 'user.php?i='+user.id});
	thumbnailLink.append(thumbnailImg);
	thumbnail.append(thumbnailLink);
	return thumbnail;
}

function getEventBookTarget(book) {
	var targetImgSrc = book.thumbnail == null ? "img/defaultthumb.png" : book.thumbnail;
	var target = $('<div></div>', {class:'event-card--target'});
	var targetImg = 
		$('<img>', 
			{alt:'Cover', 
				src: targetImgSrc}).error(function() {
					this.src = 'img/defaultthumb.png';
				});
	var targetLink = $('<a></a>', {href: 'book.php?i='+book.id});
	targetLink.append(targetImg);
	target.append(targetLink);
	return target;
}

function printEventStarted(holder, event) {
	var user = event.user;
	var book = event.book;
	var thumbnail = getEventUserThumbnail(user);
	var target = getEventBookTarget(book);
	
	var info = $('<div></div>', {class:'event-card--info'});
	var userLink = $('<a></a>', {href:'user.php?i='+user.id}).append(user.displayName);
	var targetLink = $('<a></a>', {href:'book.php?i='+book.id}).append(book.title);
	var paragraph = $('<p></p>').append(userLink).append(" esta leyendo ").append(targetLink);
	info.append(paragraph);
	
	printEvent(holder, thumbnail, target, info);
}

function printEventProloge(holder, event) {
	var user = event.user;
	var book = event.book;
	var thumbnail = getEventUserThumbnail(user);
	var target = getEventBookTarget(book);
	var info = $('<div></div>', {class:'event-card--info'});
	var userLink = $('<a></a>', {href:'user.php?i='+user.id}).append(user.displayName);
	var targetLink = $('<a></a>', {href:'book.php?i='+book.id}).append(book.title);
	var paragraph = $('<p></p>').append(userLink).append(" ha escrito un prólogo de ").append(targetLink);
	info.append(paragraph);
	printEvent(holder, thumbnail, target, info);
}

function printEventFavorite(holder, event) {
	var user = event.user;
	var book = event.book;
	var thumbnail = getEventUserThumbnail(user);
	var target = getEventBookTarget(book);
	var info = $('<div></div>', {class:'event-card--info'});
	var userLink = $('<a></a>', {href:'user.php?i='+user.id}).append(user.displayName);
	var targetLink = $('<a></a>', {href:'book.php?i='+book.id}).append(book.title);
	var paragraph = $('<p></p>').append(userLink).append(" ha agregado ").append(targetLink).append(" a sus favoritos.");
	info.append(paragraph);
	printEvent(holder, thumbnail, target, info);
}

/*
<article class="event-card">
		<div class="event-card--thumbnail">
	<img src="img/defaultuser.jpg" alt="user" />
</div>

<div class="event-card--target">
	<img src="img/defaultthumb.png" alt="Book cover" />
</div>

<div class="event-card--info">
	<p><a>tinInFullHD</a> esta leyendo <a>El señor de los anillos: la segunda parte</a></p>
</div>
</article>
*/

function printMostReadBooks() {
	//For each book do stuff
	var mostReadBooksHolder = $('#mostReadBooks');
	for(var i = 0; i < 3; i++) {
		var book = {id: 1,title: "Random", author:"random", rating:3.5, cover:"img/defaultthumb.png"}
		printBookCard(mostReadBooksHolder, book);
	}
}

function displayMostReadBooks(books) {
	var holder = $('#mostReadBooks');
	$(books).each(function(index, book) {
		printMostReadBook(holder, book);
	});
}

function printMostReadBook(holder, book) {
	
	var div = $('<div></div>',{class:'col-md-12 col-sm-4'});
	var bookCard = $('<article></article>', {class:'book-card'});
	var bookLink = $('<a></a>',{href:'book.php?i='+book.id});
	var bookThumb = $('<div></div>', {class: 'book-card--thumbnail'});
	var cover = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
	var thumb = $('<img>',{alt:'Book cover', src: cover});
	var bookInfo = $('<div></div>', {class: 'book-card--info'});
	var bookTitle = $('<h5></h5>').html(book.title);
	var bookAuthor = $('<h6></h6>').html(book.author);
	var bookRating = $('<div></div>', {class: 'book-card--rating'});
	
	var rating = 0;
	if(book.rating != null) {
		rating = book.rating.rating;
	}
	bookRating = getRatingDiv(bookRating, rating);
	bookCard.append(bookThumb.append(bookLink.append(thumb)))
		.append(bookInfo.append(bookTitle).append(bookAuthor).append(bookRating));
	div.append(bookCard);
	
	holder.append(div);
	//return div;
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
/*
<div class="col-md-4">
					<article class="book-card">
						<div class="book-card--thumbnail">
							<img src="img/defaultthumb.png" alt="Book cover">
						</div>
						<div class="book-card--info">
							<h5>Titulo del Libro: un libro muy largo para leer y algunas otras historias cortas</h5>
							<h6>Autor del libro</h6>
							<div class="book-card--rating">
								<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
							</div>
							<div class="book-card--actions text-right">
							
							</div>
						</div>
					</article>
				</div>
*/
</script>
