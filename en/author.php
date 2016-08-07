<?php
session_start();
//var_dump($_SESSION);
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
	
	<div class="container">
		<div class="col-md-12">
			<section class="main-author">
				<div class="main-author--pic">
					<img src="../img/defaultuser.png" alt="Author" id="author-pic" class="backup-pic" onerror='this.src="../img/defaultuser.png";'/>
				</div>
				<div class="main-author--info">
					<h2 id="author-name">Author Name</h2>
				</div>
			</section>
		</div>
		
		<div class="col-md-12 col-sm-12" id="author-books">
			<h2 class="Section-title no-padding">Books from this author</h2>
			
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
var author = new AuthorDataSource({});
var authorHandler = new AuthorHandler({});

var bookTemplate = new AuthorBooksTemplate({});
$(document).ready(function() {
	var authorBooksHandler = new PrologesDataHolder($('#author-books'), bookTemplate);

	author.getInfo(authorId).then(function(info) {
		authorHandler.displayAuthor(info, $('#author-name'), $('#author-pic'));
		console.log(info);
	});

	author.getBooks(authorId).then(function(books) {
		//
		authorBooksHandler.printCollection(books);
		console.log(books);
	});
});
</script>
