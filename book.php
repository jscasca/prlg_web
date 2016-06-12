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
			<div id="book-modal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<h2 id="book-modal--body"></h2>
						</div>
					</div>
				</div>
			</div>
			<div id="login-modal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							Inicia sesión para escribir un prólogo!
						</div>
						<div class="modal-body text-center">
							<a href="login.php"><button type="button" id="btn-to-review" class="btn Blue-button">Inicia sesión</button></a>
							<h5>¿No tienes cuenta aún?<a href="registration.php">¡Registrate!</a></h5>
						</div>
					</div>
				</div>
			</div>
<div id="prologe-modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><span id="modal-title-placeholder">Escribe un prólogo!</span></h3>
			</div>
			<div class="modal-body">
				<div class="prologe-modal--prologe text-center">
					<textarea id="prologe-modal--textarea" class="prologe-modal--textarea"></textarea>
					<div class="prologe-modal--feedback text-right" id="prologe-modal--feedback"></div>
				</div>
				<div class="prologe-modal--rating">
					Calificar: <span id="prologe-modal--raty"></span>
				</div>
			</div>
			<div class="modal-footer">
				<div class="modal-footer--buttons text-center">
					<button type="button" class="btn Blue-button" id="prologe-modal--submit">Sellar</button>
				</div>
				<!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>-->
			</div>
		</div>
	</div>
</div>
		</div>
		<div class="col-md-8 col-sm-12">
			<section class="main-book">
				<div class="main-book--cover">
					<img src="img/default.png" alt="Cover" id="book-cover" class="backup-cover"/>
				</div>
				<div class="main-book--info">
					<h2 id="book-title"></h2>
					<a href="" id="book-author--link"><h3 id="book-author"></h3></a>
					<div class="main-book--rating">
						<!--<input id="bookRatingInput" type="number" class="rating" value="4" data-show-clear="false" data-show-caption="false" data-display-only="true">-->
						<div id="main-book--rated"></div>
					</div>
				</div>
				<div class="main-book--actions text-right">
					<div class="icon-wishlist--disabled" id="action-wishlist"></div>
					<div class="icon-favorite--disabled" id="action-favorite"></div>
					<div class="icon-prologe--disabled" id="action-prologe"></div>
					<div class="icon-reading--disabled" id="action-reading"></div>
				</div>
			</section>
			
			<div class="main-prologes" id="main-prologes">
				
				<!--<section class="main-prologe">
					<div class="main-prologe--thumbnail">
						<img src="img/defaultuser.png" alt="user">
					</div>
					<div class="main-prologe--text">
						<p>El señor de los anillos es narra el viaje desde la comarca hasta mount doom de sam y frodo con la tarea de destruir el anillo unico. Narrada en las palabras del ilustre Tolkien, es un libro que fascinara a cualquier integrante de la familia. Lo recomiendo ampliamente ya que es uno de mis favoritos. Siempre esta en mi lista de libros por leer. Asi que nada, a leerlo pedazos de piltrafas. :)</p>
					</div>
					<div class="main-prologe--rating text-right">
						<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
					</div>
					<div class="main-prologe--signature text-right">
						<a>TinKalzetin</a>
					</div>
				</section>-->
				
			</div>
		</div>
		
		<div class="col-md-4 col-sm-12" id="similar-books">
			<h2 class="Section-title no-padding">Otros titulos similares</h2>
			
			<!--<article class="similar-book">
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
	var bookId = "<?php echo $_REQUEST['i'];?>";
	var retries = 0;
	var maxProloge = 380;
	
$(document).ready(function() {
	$('#prologe-modal--feedback').html(maxProloge);
	$('#prologe-modal--textarea').val("");
	$('#prologe-modal--textarea').keyup(function() {
		var text = $('#prologe-modal--textarea').val();
		var chars = text.length;
		var charsRemaining = maxProloge - chars;
		if(chars > maxProloge) {
			var newText = text.substr(0, maxProloge);
			$('#prologe-modal--textarea').val(newText);
			charsRemaining = 0;
		}
		$('#prologe-modal--feedback').html(charsRemaining);
	});
	
	$('#prologe-modal--submit').click(function() {
		validateProloge();
	});
	
	$('#prologe-modal--raty').raty({
		size: 120,
		starHalf :'star-half-big.png',
		starOff :'star-off-big.png',
		starOn :'star-on-big.png'
	});
	getBookInfo(bookId);
	
	getBooksFromSameAuthor(bookId);
	if(loggedIn) {
		getBookInteractions(bookId);
		getBookPrologesWithVotes(bookId);
	} else {
		getBookPosdtas(bookId);
	}
	$('.backup-thumb').error(function() {
		$(this).attr('src', 'img/defaultthumb.png');
	});
	$('.backup-cover').error(function() {
		$(this).attr('src', 'img/default.png');
	});
});

function validateProloge() {
	var prologe = $('#prologe-modal--textarea').val();
	if(prologe.length == 0 || prologe.length > maxProloge) {
		$('.prologe-modal--textarea').css({'border-color':'red'});
		return 0;
	} else {
		$('.prologe-modal--textarea').css({'border-color' : '#3fb0ac'});
	}
	var rating = $('#prologe-modal--raty').raty('score');
	if(rating == undefined || rating < 0 || rating > 5) {
		$('.prologe-modal--rating').css({'color':'red'});
		return 0;
	} else {
		$('.prologe-modal--rating').css({'color':'#173e43'});
	}
	$('#prologe-modal--submit').prop('disable', true);
	submitProloge(bookId, rating, prologe);
}

function getBookInteractions(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getInteractionsWithBook.php',
	  data: {book: id},
	  success: function(data){
			displayInteractions(data, id);
		  },
	  error: function() {
		  retries++;
		  if(retries < 10)
			setTimeout('getBookInteractions('+id+')', 300);
	  }
	});
}

function displayInteractions(interactions, id) {
	if(interactions.favorite == true) {
		$('#action-favorite').removeClass('icon-favorite--disabled').addClass('icon-favorite--active');
		$('#action-favorite').click(function(){removeFromFavorites(id);});
	} else {
		$('#action-favorite').removeClass('icon-favorite--disabled').addClass('icon-favorite');
		$('#action-favorite').click(function(){addToFavorites(id);});
	}
	if(interactions.wishlisted == true) {
		$('#action-wishlist').removeClass('icon-wishlist--disabled').addClass('icon-wishlist--active');
		$('#action-wishlist').click(function(){removeFromWishlist(id);});
	} else {
		$('#action-wishlist').removeClass('icon-wishlist--disabled').addClass('icon-wishlist');
		$('#action-wishlist').click(function(){addToWishlist(id);});
	}
	if(interactions.reading == true) {
		$('#action-reading').removeClass('icon-reading--disabled').addClass('icon-reading--active');
		$('#action-reading').click(function(){removeFromReading(id);});
		//Remove actions from wishlist since you are reading this
		$('#action-wishlist').removeClass().addClass('icon-wishlist--disabled');
		$('#action-wishlist').off();
	} else {
		$('#action-reading').removeClass('icon-reading--disabled').addClass('icon-reading');
		$('#action-reading').click(function(){addToReading(id);});
	}
	if(interactions.posdta == true) {
		$('#action-prologe').removeClass('icon-prologe--active').addClass('icon-prologe--active');
	} else {
		$('#action-prologe').removeClass('icon-prologe--disabled').addClass('icon-prologe');
		$("#action-prologe").click(function(){
			$("#prologe-modal").modal('show');
		});
	}
}

function addToReading(id) {
	interactWithBook('php/ajax/addToReading.php', id, markAsReading, 'Se agrego a los libros que estas leyendo!');
}

function removeFromReading(id) {
	interactWithBook('php/ajax/deleteFromReadings.php', id, unmarkAsReading, 'Se removio de los libros que estas leyendo.');
}

function removeFromWishlist(id) {
	interactWithBook('php/ajax/deleteFromWishlist.php', id, unmarkAsWishlist, 'Se removio de tus libros por leer.');
}

function addToWishlist(id) {
	interactWithBook('php/ajax/addToWishlist.php', id, markAsWishlist, 'Se agrego a tu lista de libros por leer!');
}

function removeFromFavorites(id) {
	interactWithBook('php/ajax/deleteFromFavorites.php', id, unmarkAsFavorite, 'Se removio de tus favoritos.');
}

function addToFavorites(id) {
	interactWithBook('php/ajax/addToFavorites.php', id, markAsFavorite, 'Se agrego a tus libros favoritos!');
}

function markAsFavorite(book) {
	$('#action-favorite').removeClass().addClass('icon-favorite--active');
	$('#action-favorite').off().click(function(){removeFromFavorites(book);});
}

function unmarkAsFavorite(book) {
	$('#action-favorite').removeClass().addClass('icon-favorite');
	$('#action-favorite').off().click(function(){addToFavorites(book);});
}

function markAsWishlist(book) {
	$('#action-wishlist').removeClass().addClass('icon-wishlist--active');
	$('#action-wishlist').off().click(function(){removeFromWishlist(book);});
}

function unmarkAsWishlist(book) {
	$('#action-wishlist').removeClass().addClass('icon-wishlist');
	$('#action-wishlist').off().click(function(){addToWishlist(book);});
}

function markAsReading(book) {
	$('#action-reading').removeClass().addClass('icon-reading--active');
	$('#action-reading').off().click(function(){removeFromReading(book);});
	//Remove actions from wishlist since you are reading this
	$('#action-wishlist').removeClass().addClass('icon-wishlist--disabled');
	$('#action-wishlist').off();
}

function unmarkAsReading(book) {
	$('#action-reading').removeClass().addClass('icon-reading');
	$('#action-reading').off().click(function(){addToReading(book);});
	//Remove actions from wishlist since you are reading this
	$('#action-wishlist').removeClass().addClass('icon-wishlist');
	$('#action-wishlist').off().click(function(){addToWishlist(book);});
}

function interactWithBook(url, book, callback, message, errorCallback) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: url,
	  data: {book: book},
	  success: function(data){
		  callback(book);
		  if(message != undefined)
			displayModalAlert(message);
	  },
	  error: function() {
		  console.log();
	  }
	});
}

function disableWishlisting(message) {
	displayModalAlert(message);
	$('#action-wishlist').removeClass().addClass('icon-wishlist--disabled');
	$('#action-wishlist').click(function(){});
}

function displayModalAlert(message) {
	$('#book-modal--body').html(message);
	$('#book-modal').modal('show');
}

function submitProloge(book, rating, prologe) {
	//Send book, rating, posdta
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/postPosdta.php',
	  data: {book: book, rating: rating, posdta: prologe},
	  success: function(prologe){
		  displaySubmittedProloge(prologe, book);
	  },
	  error: function() {
		  //refresh until we find out the problem
		  location.reload();
	  }
	});
}

function displaySubmittedProloge(prologe, id) {
	//Check if there is an mpety prologe and remove
	if($('#main-prologe--empty').length) {
		$('#main-prologe--empty').remove();
	}
	newProloge(prologe);
	$("#prologe-modal").modal('hide');
	$('#action-prologe').removeClass('icon-prologe--active').addClass('icon-prologe--active');
	$("#action-prologe").off();
	
	//Reset reading
	unmarkAsReading(id);
}

function newProloge(prologe) {
	var holder = $('#main-prologes');
	printProloge(holder, prologe);
}

function getBookPrologesWithVotes(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getBookPosdtas.php',
	  data: {book: id},
	  success: function(data){
			if($(data).length == 0) {
				displayEmptyProloge();
			} else {
				console.log(data);
				displayProloges(data);
			}
		  },
	  error: function() {
		  retries++;
		  if(retries < 10)
			setTimeout('getBookPosdtas('+id+')', 300);
	  }
	});
}


function getBookPosdtas(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getBookPosdtas.php',
	  data: {book: id},
	  success: function(data){
			if($(data).length == 0) {
				displayEmptyProloge();
			} else {
				displayProloges(data);
			}
		  },
	  error: function() {
		  retries++;
		  if(retries < 10)
			setTimeout('getBookPosdtas('+id+')', 300);
	  }
	});
}

function displayEmptyProloge() {
	var holder = $('#main-prologes');
	//TODO: edit to create the element properly
	holder.append('<section class="main-prologe" id="main-prologe--empty" display="none"><div class="main-prologe--empty text-center"><h3>Nadie ha escrito un prologo sobre este libro. </h3><h2>Se el primero!</h2></div><div class="main-prologe--prologe"><div class="icon-prologe text-center" id="first-prologe"></div></div></section>');
	$("#first-prologe").click(function(){
		//depending on
		if(loggedIn) {
			$("#prologe-modal").modal('show');
		} else {
			$("#login-modal").modal('show');
		}
	});
}

function displayProloges(prologes, enabled) {
	console.log(prologes);
	var holder = $('#main-prologes');
	$(prologes).each(function(index, prologe) {
		if(prologe.length == 2) { //Contains the prologe and the user interaction obj
			printProloge(holder, prologe[0], true, prologe[1]);
		} else {
			printProloge(holder, prologe, false);
		}
	});
	holder.prepend('<h2>Lee lo que la comunidad opina</h2>');
}

function printProloge(holder, prologe, enabled, userVote) {
	var user = prologe.user;
	var section = $('<section></section>',{class:'main-prologe'});
	var thumbnail = $('<div></div>',{class:'main-prologe--thumbnail'});
	var thumbnailImg = $('<img>',{src: user.icon, alt:"user"});
	thumbnail.append(thumbnailImg);
	section.append(thumbnail);
	var text = $('<div></div>', {class:'main-prologe--text'});
	var textParagraph = $('<p></p>');
	textParagraph.html(prologe.posdta);
	text.append(textParagraph);
	section.append(text);
	var rating = $('<div></div>', {class:'main-prologe--rating text-right'});
	var userRating = 0;
	if(prologe.rating != null) {userRating = prologe.rating;}
	rating = getRatingDiv(rating, userRating);
	section.append(rating);
	var signature = $('<div></div>', {class:'main-prologe--signature text-right'});
	var signatureLink = $('<a></a>', {href:'user.php?i='+user.id});
	signatureLink.html(user.displayName);
	signature.append(signatureLink);
	
	//Here the voting part
	var votes = $('<div></div>', {class:'main-prologe--voting text-right'});
	var prologeVotes = "";
	if(prologe.votes != null) prologeVotes = (prologe.votes.upvotes - prologe.votes.downvotes);
	var counter = $('<div></div>', {class:'main-prologe--counter', id:'counter_'+prologe.id}).append(prologeVotes);
	var upvote;
	var downvote;
	if(enabled) {
		if(userVote != null) {
			if(userVote.vote === true) {
				upvote = $('<div></div>', {class:'prologe-upvote--active'});
				downvote = $('<div></div>', {class:'prologe-downvote--disabled'});
			} else {
				upvote = $('<div></div>', {class:'prologe-upvote--disabled'});
				downvote = $('<div></div>', {class:'prologe-downvote--active'});
			}
		} else {
			upvote = $('<div></div>', {class:'prologe-upvote', id:'upvote_'+prologe.id}).on('click', function(){upvoteProloge(prologe.id, counter);});
			downvote = $('<div></div>', {class:'prologe-downvote', id:'downvote_'+prologe.id}).on('click', function(){downvoteProloge(prologe.id, counter);});
		}
		
	} else {
		upvote = $('<div></div>', {class:'prologe-upvote--disabled'});
		downvote = $('<div></div>', {class:'prologe-downvote--disabled'});
	}
	var clear = $('<span></span>', {class:'clear-float'});
	
	votes.append(downvote).append(upvote).append(counter).append(clear);
	section.append(signature);
	section.append(votes);
	holder.append(section);
}

function upvoteProloge(prologe, counterHolder) {
	//console.log(prologe);
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/postUpvote.php',
	  data: {prologe: prologe},
	  success: function(data){
			$('#upvote_'+prologe).off().removeClass().addClass('prologe-upvote--active');
			$('#downvote_'+prologe).off().removeClass().addClass('prologe-downvote--disabled');
			counterHolder.html(" "+(data.upvotes-data.downvotes));
		  }
	});
}

function downvoteProloge(prologe, counterHolder) {
	//console.log(prologe);
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/postDownvote.php',
	  data: {prologe: prologe},
	  success: function(data){
			$('#upvote_'+prologe).off().removeClass().addClass('prologe-upvote--disabled');
			$('#downvote_'+prologe).off().removeClass().addClass('prologe-downvote--active');
			counterHolder.html(" "+(data.upvotes-data.downvotes));
		  }
	});
}

function getBookInfo(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getBookInfo.php',
	  data: {book: id},
	  success: function(data){
			displayBook(data);
		  },
	  error: function() {
		  retries++;
		  if(retries < 10)
			setTimeout('getBookInfo('+id+')', 300);
	  }
	});
}

function displayBook(bookInfo) {
	var book = bookInfo.book;
	var bookCover = book.icon;
	if(bookCover != null && bookCover != '')
		$('#book-cover').attr('src', bookCover);
	var bookTitle = book.title;
	$('#book-title').html(bookTitle);
	var author = book.author;
	var authorId = author.id;
	$('#book-author--link').attr('href','author.php?i=' + authorId);
	var authorName = author.name;
	$('#book-author').html(authorName);
	var bookRating = book.rating;
	var ratingValue = bookRating.rating;
	$('#main-book--rated').raty({
		readOnly: true,
		score : ratingValue,
		size: 120,
		starHalf :'star-half-big.png',
		starOff :'star-off-big.png',
		starOn :'star-on-big.png',
	});
}

function getBooksFromSameAuthor(id) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/getBooksFromSameAuthor.php',
	  data: {book: id},
	  success: function(data){
			displaySameAuthorBooks(data);
		  },
	  error: function() {
		  console.log('something went wrong');
	  }
	});
}

function displaySameAuthorBooks(books) {
	$(books).each(function(index, book) {
		var holder = $('#similar-books');
		printSimilarBook(holder, book);
	});
}

function printSimilarBook(holder, book) {
	var thumb = book.thumbnail == null ? 'img/defaultthumb.png' : book.thumbnail;
	var div = $('<div></div>');
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
}

/**
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
	
	<div class="similar-book--actions text-right">
		actions
	</div>
</article>
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
