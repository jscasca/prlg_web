<?php
session_start();
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
	
	<!-- -->
	<div class="container">
		<h1 class="Section-title no-padding">Resultados de tu busqueda</h1>
		
		<div class="result-cards">
			<div class="row">
				<!-- Prologes Results -->
				<div class="col-md-8" id="prologesResults">
					<!--<article class="book-result">
							<div class="book-result--thumbnail">
								<img src="img/defaultthumb.png" alt="cover">
							</div>
							<div class="book-result--info">
								<h3>Titulo del Libro</h3>
								<h4>Author del Libro</h4>
								<div class="book-result--rating">
									<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
								</div>
							</div>
							<div class="book-result--actions text-right">
								TODO: put action buttons here (add to wishlist, favorite, etc..)
							</div>
					</article>
					
					<article class="author-result">
							<div class="author-result--thumbnail">
								<img src="img/defaultuser.jpg" alt="cover">
							</div>
							<div class="author-result--info">
								<h3>Nombre del Autor</h3>
							</div>
							<div class="author-result--actions text-right">
								TODO: put action buttons here (follow, or something else)
							</div>
					</article>-->
				</div>
				
				<!-- Google Results -->
				<div class="col-md-4">
				
				</div>
			</div>
			<div class="row">
				<div class="col-md-8" id="googleResults">
				
				</div>
			</div>
		</div>
		
		<!-- NOT READY YET -->
		<!--<h5 class="Results-subtitle">
			¿No encontraste el libro o escritor que buscabas?
				<button class="btn Results-button">Nuevo Libro</button>
				<button class="btn Results-button">Nuevo Autor</button>
		</h5>-->
		<div class="">
		
		</div>
		
		
	</div>
	
	<?php
	include("_footer.php");
	?>
	
</body>
</html>
<script type="text/javascript">
var searchText = "<?php echo $_REQUEST['q'];?>";
var waitingToDisplay = true;
var resultMap = [];

$(document).ready(function() {
	getResults(searchText);
	if(loggedIn) {
		getGoogleResults(searchText);
	}
});

function getResults(search) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/search.php',
	  data: {q: search},
	  success: function(data){
			displayResults(data);
		  },
	  error: function() {
		  console.log('something went wrong');
	  }
	});
}

function getGoogleResults(search) {
	$.ajax({
	  type: 'GET',
	  dataType: 'json',
	  url: 'php/ajax/gsearch.php',
	  data: {q: search},
	  success: function(data){
			displayProbableResults(data);
		  },
	  error: function() {
		  console.log('something went wrong');
	  }
	});
}

function displayProbableResults(results) {
	if(waitingToDisplay) {
		setTimeout('displayProbableResults('+results+')', 300);
	} else {
		//Show results against map
		var holder = $('#googleResults');
		holder.append("<h3>Sugerencias de Google Books</h3>");
		$(results).each(function(index, object) {
			console.log(object);
			printGoogleResult(holder, object);
		});
	}
}

function printGoogleResult(holder, result) {
	var author = result['author'] != undefined ? result['author'] : '';
	var title = result['title'] != undefined ? result['title'] : '';
	var lang = result['lang'] != undefined ? result['lang'] : '';
	var icon = result['icon'] != undefined ? result['icon'] : '';
	var thumbnail = result['thumbnail'] != undefined ? result['thumbnail'] : '';
	if(author == '' || title == '' || lang == '') { console.log(result); return 0;}
	var form = $('<form></form>',{action: 'php/submit/googleBookRequest.php'});
	form.append("<input type='hidden' name='author' value='"+author+"'>");
	form.append("<input type='hidden' name='title' value='"+title+"'>");
	form.append("<input type='hidden' name='language' value='"+lang+"'>");
	form.append("<input type='hidden' name='icon' value='"+icon+"'>");
	form.append("<input type='hidden' name='thumbnail' value='"+thumbnail+"'>");
	
	var article = $('<article></article>', {class:'google-result'});
	var resultCover = $('<img>', {src: thumbnail, alt:'Cover'}).error(function(){this.src='img/defaultthumb.png';});
	var resultImgSubmit = $('<button></button>', {type:'submit', class:'google-result--submit'}).append(resultCover);
	var resultDiv = $('<div></div>', {class:'google-result--thumbnail'}).append(resultImgSubmit);
	article.append(resultDiv);
	var resultTitle = $('<h4></h4>').html(title+" ("+lang+")");
	var resultAuthor = $('<h5></h5>').html(author);
	var resultInfo = $('<div></div>', {class: 'google-result--info'});
	resultInfo.append(resultTitle);
	resultInfo.append(resultAuthor);
	article.append(resultInfo);
	form.append(article);
	holder.append(form);
}

function displayResults(results) {
	$(results).each(function(index, object) {
		var holder = $("#prologesResults");
		if(object.className == "Book") {
			printBookResultCard(holder, object);
			resultMap.push(object.title);
		} else if(object.className == "Author") {
			printAuthorResultCard(holder, object);
			resultMap.push(object.name);
		} else {
			//Soemthing weird happened
		}
	});
	waitingToDisplay = false;
}

function printAuthorResultCard(holder, result) {
	var thumb = result.icon == null ? 'img/defaultuser.png' : result.icon;
	var resultCard = $('<article></article>',{class: 'author-result'});
	var authorCover = $('<img>',{src:thumb, alt:'Cover'});
	var authorLink = $('<a></a>',{href:'author.php?i='+result.id}).append(authorCover);
	var authorThumb = $('<div></div>', {class:'author-result--thumbnail'}).append(authorLink);
	resultCard.append(authorThumb);
	var authorName = $('<h3></h3>').html(result.name);
	var authorInfo = $('<div></div>', {class: 'author-result--info'}).append(authorName);
	resultCard.append(authorInfo);
	var authorActions = $('<div></div>', {class: 'author-result--actions text-right'});
	resultCard.append(authorActions);
	holder.append(resultCard);
}

/*
<article class="author-result">
		<div class="author-result--thumbnail">
			<img src="img/defaultthumb.png" alt="cover">
		</div>
		<div class="author-result--info">
			<h3>Nombre del Autor</h3>
		</div>
		<div class="author-result--actions text-right">
			<!--Actions-->
		</div>
</article>
*/

function printBookResultCard(holder, result) {
	var thumb = result.thumbnail == null ? 'img/defaultthumb.png' : result.thumbnail;
	var resultCard = $('<article></article>',{class: 'book-result'});
	var bookCover = $('<img>',{src:thumb, alt:'Cover'});
	var bookLink = $('<a></a>',{href:'book.php?i='+result.id}).append(bookCover);
	var bookThumb = $('<div></div>', {class:'book-result--thumbnail'}).append(bookLink);
	resultCard.append(bookThumb);
	var title = $('<h4></h4>').html(result.title);
	var author = $('<h5></h5>').html(result.authorName);
	var bookRating = $('<div></div>', {class: 'book-card--rating'});
	var rating = 0;
	if(result.rating != null) {
		rating = result.rating.rating;
	}
	bookRating = getRatingDiv(bookRating, rating);
	var bookInfo = $('<div></div>', {class: 'book-result--info'}).append(title).append(author).append(bookRating);
	resultCard.append(bookInfo);
	//TODO: create actions
	var bookActions = $('<div></div>', {class: 'book-result--actions text-right'});
	resultCard.append(bookActions);
	holder.append(resultCard);
}

/**
<article class="book-result">
		<div class="book-result--thumbnail">
			<img src="img/defaultthumb.png" alt="cover">
		</div>
		<div class="book-result--info">
			<h3>Titulo del Libro</h3>
			<h4>Author del Libro</h4>
			<div class="book-result--rating">
				<span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span>
			</div>
		</div>
		<div class="book-result--actions text-right">
			<!--Actions-->
		</div>
</article>
*/

function getRatingDiv(ratingDiv, rating) {
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
