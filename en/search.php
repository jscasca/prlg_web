<?php
session_start();
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
	
	<!-- -->
	<div class="container">
		<h1 class="Section-title no-padding">Your search results</h1>
		<span id="search-title" class="search-title"></span>
		
		<div class="result-cards">
			<div class="row">
				<!-- Prologes Results -->
				<div class="col-md-8" id="search-results">
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
				<div class="col-md-8" id="google-results">
				
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

var ds = new SearchDataSource({});
var searchTemplate = new SearchTemplate({});
var gsearchTemplate = new GoogleSearchTemplate({});

$(document).ready(function() {
	if(searchText == "") return;
	$('#search-title').html(searchText);

	var searchHandler = new PrologesDataHolder($('#search-results'), searchTemplate);
	var gsearchHandler = new PrologesDataHolder($('#google-results'), gsearchTemplate);

	var search = ds.search(searchText);
	search.then(function(data){
		searchHandler.printCollection(data);
	});

	if(loggedIn) {
		var gsearch = ds.googleSearch(searchText);
		Promise.all([search, gsearch]).then(function(values){
			//values[0] has the Prologes Search Results
			//values[1] has the google search results
			//TODO: Traverse the first and map, print the second
			gsearchHandler.printCollection(values[1]);
			//TODO: After show a link to submit own
		});
	}
});

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
	var resultTitleSubmit = $('<a></a>', {}).append(resultTitle);
	var resultAuthor = $('<h5></h5>').html(author);
	var resultInfo = $('<div></div>', {class: 'google-result--info'});
	resultInfo.append(resultTitleSubmit.click(function(){$(this).closest('form').submit();}));
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
</script>
