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
			
		</div>
		<div class="col-md-8 col-sm-12">
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

	getProloges();
});

function getProloges() {
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
