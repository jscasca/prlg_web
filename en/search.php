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
		<h3 class="Section-title no-padding">Your search results</h1>
		<span id="search-title" class="search-title"></span>
		
		<div class="result-cards">
			<div class="row">
				<!-- Prologes Results -->
				<div class="col-md-8" id="search-results">
					<!--<article class="book-result">
							<div class="book-result--thumbnail">
								<img src="img/defalutthumb.png" alt="cover">
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
					<div id="not-found">
						<h5>Not what you are looking for?</h5>
						<button class="btn Results-button" onclick="(function(){$('#book-request-modal').modal('show');})()";>Add book</button>
						<!--<button class="btn Results-button">Add author</button>-->
					</div>
				</div>
			</div>
			<!-- Modal dialog for book request-->
			<div id="book-request-modal" class="modal fade">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<form action="../php/submit/customBookRequest.php" method="POST" class="book-request-form" id="book-request-form">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 class="modal-title"><span id="modal-title-placeholder">Request a book!</span></h3>
						</div>
						<div class="modal-body">
						<div class="form-group">
							<div class="form-group">
								<label for="requestTitle">Title</label>
								<input type="text" class="form-control" id="requestTitle" name="title" placeholder="Title" />
							</div>
							<div class="form-group">
								<label for="requestAuthors">Authors</label>
								<div id="requestAuthors">
									<div class="form-group">
										<input type="text" class="form-control request-author" id="requestAuthors" name="author[]" placeholder="Author" />
									</div>
									<div class="form-group">
										<input type="text" class="form-control request-author" id="requestAuthors" name="author[]" placeholder="Author" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>
								Language 
									<select name="language" >
										<option value="en">ENG</option>
										<option value="es">ESP</option>
										<option value="fr">ITA</option>
										<option value="it">FRA</option>
										<option value="jp">JAP</option>
									</select>
								</label>
							</div>
						</div>
							<!--
								<div>
									<h5>Title</h5>
									<input name="title" class="request-form-title">
									<h5>Authors</h5>
									<div>
										<div class="">
											<input name="author[]" class="request-form-author">
										</div>
										<div class="">
											<input name="author[]" class="request-form-author">
										</div>
									</div>
									<div>
										<h5>Language</h5>
										<select name="language">
											<option value="en">ENG</option>
											<option value="es">ESP</option>
											<option value="fr">ITA</option>
											<option value="it">FRA</option>
											<option value="jp">JAP</option>
										</select>
									</div>
								</div>-->
							<!--<div class="prologe-modal--prologe text-center">
								<textarea id="prologe-modal--textarea" class="prologe-modal--textarea"></textarea>
								<div class="prologe-modal--feedback texformt-right" id="prologe-modal--feedback"></div>
							</div>
							<div class="prologe-modal--rating">
								Rate: <span id="prologe-modal--raty"></span>
							</div>-->
						</div>
						<div class="modal-footer">
							<div class="modal-footer--buttons text-center">
								<button type="submit" class="btn Blue-button" id="custom-request--submit">Request!</button>
							</div>
							<!--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>-->
						</div>
						</form>
					</div>
				</div>
			</div>
			<!--<div class="row">
				<div class="col-md-8" id="google-results">
				
				</div>
			</div>-->
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
var resultMap = {};

var ds = new SearchDataSource({});
var searchTemplate = new SearchTemplate({});
var gsearchTemplate = new GoogleSearchTemplate({});

$(document).ready(function() {
	if(searchText == "") return;
	$('#search-title').html(searchText);

	var searchHandler = new PrologesDataHolder($('#search-results'), searchTemplate);
	var gsearchHandler = new PrologesDataHolder($('#search-results'), gsearchTemplate);

	var search = ds.search(searchText);
	search.then(function(data){
		searchHandler.printCollection(data);
		$.each(data, function(i, r){
			resultMap[r.title] = 1;
		});
	});

	//if(loggedIn) {
		var gsearch = ds.googleSearch(searchText);
		Promise.all([search, gsearch]).then(function(values){
			//values[0] has the Prologes Search Results
			//values[1] has the google search results
			var gresults  = values[1].filter(function(r){
				return resultMap[r.title] === undefined;
			});
			gsearchHandler.printCollection(gresults);
			//TODO: After show a link to submit own
		});
	//}
});

$('#custom-request--submit').click(function(){
	$('#error-msg').empty();
	var titleInput = $('#request-title');
	var title = titleInput.val().trim();
	if(title == '') {
		displayFormViolation(titleInput, 'Type the book title');
		return false;
	}
	removeFormViolation(titleInput);
	var firstAuthor = $('.request-author')[0];
	if(areEmpty($('.request-author'))) {
		displayHtmlFormViolation($('.request-author')[0], 'At least type one author');
		return false
	}
	removeHtmlFormViolation(firstAuthor);
	//return false;
	//submit that stuff
	$("#book-request-form").submit();
});

function areEmpty(inputs) {
	var empty = true;
	inputs.each(function(i, e) {
		if(e.value.trim() !== '') {
			empty = false;
		}
	});
	return empty;
};

function isEmpty(input) {
	return input.val().trim() == '';
}

function removeHtmlFormViolation(input) {
	input.style.border = '1px solid #3fb0ac';
	input.style.boxShadow = '0 0 5px #3fb0ac';
}

function removeFormViolation(input) {
	input.css({border: '1px solid #3fb0ac', 'box-shadow':'0 0 5px #3fb0ac'});
}

function displayHtmlFormViolation(input, msg) {
	$('#error-msg').append("<p>"+msg+"</p>");
	input.style.border = '1px solid red';
	input.style.boxShadow = '0 0 5px red';
	input.focus();
}

function displayFormViolation(input, msg) {
	$('#error-msg').append("<p>"+msg+"</p>");
	input.css({border: '1px solid red', 'box-shadow': '0 0 5px red'});
	input.focus();
}

</script>
