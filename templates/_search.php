<?php

?>
<div class="row">	
	<div class="index-search">
		<form role="search" action="search">
			<div class="input-group">
				<input class="form-control" id="search-input--field" type="text" name="q"/>
				<div class="input-group-btn">
					<button class="btn btn-default" disabled="disabled" id="search-input--submit" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
<h1 class="Section-title no-padding" id="search-results--title"></h1>
<span id="search-title" class="search-title"></span>

<div class="result-cards">
	<div class="row">
		<!-- Prologes Results -->
		<div class="col-md-8" id="search-results">
		<!-- Search results here -->
		</div>

		<!-- Google Results -->
		<div class="col-md-4">
			<div id="not-found" style="display:none;">
				<h5 id="not-found--span"></h5>
				<button id="not-found--action" class="btn Results-button" onclick="(function(){$('#book-request-modal').modal('show');})()";></button>
				<!--<button class="btn Results-button">Add author</button>-->
			</div>
		</div>
	</div>
<!-- Modal dialog for book request-->
<div id="book-request-modal" class="modal fade">
<div class="modal-dialog modal-sm">
	<div class="modal-content">
		<form action="<?php echo $rootpath;?>php/submit/customBookRequest.php" method="POST" class="book-request-form" id="book-request-form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title"><span id="modal-title-placeholder"><?php echo getTranslation('Add a new book!'); ?></span></h3>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<div class="form-group">
						<label for="requestTitle" id="request-title--label"></label>
						<input type="text" class="form-control" id="request-title" name="title" placeholder="" />
					</div>
					<div class="form-group">
						<label for="request-authors" id="request-authors--label"></label>
						<div id="request-authors">
						<div class="form-group">
						<input type="text" class="form-control request-author" name="author[]" placeholder="Autor" />
						</div>
						<div class="form-group">
						<input type="text" class="form-control request-author" name="author[]" placeholder="Autor" />
						</div>
						</div>
					</div>
					<div class="form-group">
						<label id="request-language--label"></label>
						<select name="language" >
							<option value="en">English</option>
							<option value="es">Español</option>
							<option value="fr">Italiano</option>
							<option value="it">Français</option>
							<!-- <option value="jp">JAP</option> -->
						</select>
					</div>
					<div id="error-msg"></div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="modal-footer--buttons text-center">
					<button type="button" class="btn Blue-button" id="custom-request--submit"></button>
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
<script type="text/javascript">
var searchQuery = '<?php echo $search; ?>';
var translator = new Translator();

var getText = function(text) {
	return translator.getText(text);
}

var ds = new SearchDataSource({});
var searchTemplate = new SearchTemplate({});
var gsearchTemplate = new GoogleSearchTemplate({});

var addCustomRequest = function() {
	$('#not-found--span').html(translator.getText('Could not find what you were looking for?'));
	$('#not-found--action').html(translator.getText('Add a book'));
	$('#not-found').css('display', 'block');
};
//Cache the result after the book query
$(document).ready(function() {
	$('#search-input--field').attr('placeholder', translator.getText('Search')).val(searchQuery);
	/*Start filling the text from the translator*/
	if(searchQuery !== '') {
		$('#search-results--title').html(translator.getText('Search results'));
		var resultMap = {};
		var searchHandler = new PrologesDataHolder($('#search-results'), searchTemplate);
		var gsearchHandler = new PrologesDataHolder($('#search-results'), gsearchTemplate);

		var dataFromStorage = localStorage.getItem(searchQuery);
		if(dataFromStorage) {
			var data = JSON.parse(dataFromStorage);
			searchHandler.printCollection(data.local);
			gsearchHandler.printCollection(data.external);
			$('#search-input--submit').removeAttr('disabled');
			setTimeout(function() {
				addCustomRequest();
			}, 5000);
			//add event listener and stuff to handle this in page instead of reloading
		} else {
			var search = ds.search(searchQuery);
			search.then(function(data){
				searchHandler.printCollection(data);
				$.each(data, function(i, r){
					resultMap[r.title] = 1;
				});
			});
			var gsearch = ds.googleSearch(searchQuery);
			Promise.all([search, gsearch]).then(function(values){
				//values[0] has the Prologes Search Results
				//values[1] has the google search results
				var presults = values[0];
				var gresults  = values[1].filter(function(r){
					return resultMap[r.title] === undefined;
				});
				gsearchHandler.printCollection(gresults);
				localStorage.setItem(searchQuery, JSON.stringify({local: presults, external: gresults}));
				$('#search-input--submit').removeAttr('disabled');
				setTimeout(function() {
					addCustomRequest();
				}, 5000);
				//TODO: After show a link to submit own
			});
		}
	} else {
		$('#search-input--submit').removeAttr('disabled');
	}

	/* Modal text set */
	$('#modal-title-placeholder').html(translator.getText('Add book'));
	$('#request-title--label').html(translator.getText('Title'));
	$('#request-title').attr('placeholder', translator.getText('Title'));
	$('#request-authors--label').html(translator.getText('Authors'));
	$('#request-authors input').attr('placeholder', translator.getText('Author'));
	$('#request-language--label').html(getText('Language'));
	$('#custom-request--submit').html(getText('Submit book'));
});

$('#custom-request--submit').click(function(){
	$('#error-msg').empty();
	var titleInput = $('#request-title');
	var title = titleInput.val().trim();
	if(title == '') {
		displayFormViolation(titleInput, getText('Select a title'));
		return false;
	}
	removeFormViolation(titleInput);
	var firstAuthor = $('.request-author')[0];
	if(areEmpty($('.request-author'))) {
		displayHtmlFormViolation($('.request-author')[0], getText('Select one author'));
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
	$('#error-msg').append("<p><i>"+msg+"</i></p>");
	input.style.border = '1px solid red';
	input.style.boxShadow = '0 0 5px red';
	input.focus();
}

function displayFormViolation(input, msg) {
	$('#error-msg').append("<p><i>"+msg+"</i></p>");
	input.css({border: '1px solid red', 'box-shadow': '0 0 5px red'});
	input.focus();
}
</script>