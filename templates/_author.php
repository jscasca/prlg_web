<?php

?>
<div class="col-md-12">
	<section class="main-author">
		<div class="main-author--pic">
			<!-- <img src="../img/defaultuser.png" alt="Author" id="author-pic" class="backup-pic" onerror='this.src="/img/defaultuser.png";'/> -->
			<img src='' alt="Author" id="author-pic" class="backup-pic" />
		</div>
		<div class="main-author--info">
			<h2 id="author-name">Author Name</h2>
		</div>
	</section>
</div>

<div class="col-md-12 col-sm-12" id="author-books">
	<h2 class="Section-title no-padding" id=''></h2>
	
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
<script type="text/javascript">
var authorId = '<?php echo $author; ?>';

var bookTemplate = new AuthorBooksTemplate({});
var externalTemplate = new AuthorExternalBooksTemplate({});
$(document).ready(function() {
	var authorBooksHandler = new PrologesDataHolder($('#author-books'), bookTemplate);
	var externalBooksHandler = new PrologesDataHolder($('#author-books'), externalTemplate);

	var authorBooks = getAuthorBooks(authorId);
	authorBooks.then(function(books) {
		authorBooksHandler.printCollection(books);
	});

	var authorInfo = getAuthorInfo(authorId);
	authorInfo.then(function(info) {
		$('#author-name').text(info.name);
		$('#author-pic').attr('src', info.icon);
		var externalBooks = getAuthorBooksExt(info.name);
		Promise.all([authorBooks, externalBooks]).then(function(values) {
			var existing = values[0].reduce(function(acc, x) {
				acc[x.title] = x.authors;
				return acc;
			}, {});
			var external = values[1].filter(function(x) {
				return existing[x.title] === undefined;
			});
			externalBooksHandler.printCollection(external);
		});
	});
});

function getAuthorInfo(id) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getAuthor.php',
		data: {author: id}
	});
}

function getAuthorBooks(id) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getAuthorBooks.php',
		data: {author: id}
	});
}

function getAuthorBooksExt(name) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'authorSearch.php',
		data: {author: name}
	});
}

</script>