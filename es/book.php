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
					<h3 id="book-author"></h3>
					<div class="main-book--rating">
						<!--<input id="bookRatingInput" type="number" class="rating" value="4" data-show-clear="false" data-show-caption="false" data-display-only="true">-->
						<div id="main-book--rated"></div>
					</div>
				</div>
				<div class="main-book--actions text-right">
					<div class="icon-wishlist--disabled" id="action-wishlist" title="Add to your wishlist" data-toogle="tooltip">
						<?php echo file_get_contents("../img/svg/wishlist.svg");?>
					</div>
					<div class="icon-favorite--disabled" id="action-favorite" title="Add to your favroites">
						<?php echo file_get_contents("../img/svg/favorite.svg");?>
					</div>
					<div class="icon-prologe--disabled" id="action-prologe" title="Rate this book and write a prologue">
						<?php echo file_get_contents("../img/svg/prologe.svg");?>
					</div>
					<div class="icon-reading--disabled" id="action-reading" title="Add to your readings">
						<?php echo file_get_contents("../img/svg/reading.svg");?>
					</div>
				</div>
			</section>

			<div class='row user-tabs'>
				<ul class='nav nav-tabs'>
					<li class='active'><a href='#tab-prologes' data-toggle='tab'>Prologues</a></li>
					<li><a href='#tab-comments' data-toggle='tab'>Comentarios</a></li>
				</ul>
			</div>

			<div class='tab-content'>
				<!-- Prologes DIV -->
				<div id='tab-prologes' class='tab-pane fade in active'>
					<div class="main-prologes" id="main-prologes"></div>
				</div>

				<!-- Comments DIV -->
				<div id='tab-comments' class='tab-pane fade'>
					<div class="book-comment--area" id="book-comment--area" >
						<div class="book-comment--form">
							<div class="book-comment--textarea-container">
								<textarea id="book-comment--textarea" class="book-comment--textarea" placeholder="Escribe un comentario..."></textarea>
								<div class="book-comment--error-area" id="book-comment--error-area"></div>
							</div>
							<div class="reply-form--actions">
								<button type="button" class="btn Comment-button disabled" disabled="disabled" id="comment-book--submit">Post</button>
							</div>
							<!-- <div class="book-comment--feedback text-right" id="book-comment--feedback"></div> -->
						</div>
					</div>
					<div class="main-comments" id="main-comments">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4 col-sm-12" id="similar-books">
			<h2 class="Section-title no-padding">Otros titulos similares</h2>
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
var maxComment = 240;

var p = new PrologesDataSource({});
var h = new PrologesDataHandler({});
var translator = new Translator();
var sideBooks = new SideBookTemplate({base: 'book-card'});
var prologesTemplate = new BookPrologesTemplate({base: 'main-prologe', translator: translator});
var eventTemplate = new EventTemplate({base: 'event-card', translator: translator});

var sameAuthorHandler = new PrologesDataHolder($('#similar-books'), sideBooks);
var prologesHandler = new PrologesDataHolder($('#main-prologes'), prologesTemplate, {useHeader: true});
var uiHelper = new UiHelper($('#book-modal'), $('#book-modal--body'));

var mainBook = new BookHandler({});

var commentHandler = new CommentDataHolder($('#main-comments'), { translator: translator });

var interaction = new BookInteractionHandler({
	translator: translator,
	uiHandler: uiHelper
});
	
$(document).ready(function() {

    $('body').tooltip({placement: 'top', selector: '[data-toggle=tooltip]'});

	p.getBooksFromSameAuthor(bookId).then(
		function(data) {
			sameAuthorHandler.printCollection(data);
		}
	);

	p.getBookInfo(bookId).then(function(data){
		mainBook.displayBook(data, $('#book-title'), $('#book-cover'), $('#book-author'), $('#main-book--rated'));
	});

	p.getBookProloges(bookId).then(function(data){
		prologesHandler.printCollection(data);
	});

	//getbookcomments
	//print comment tree
	p.getBookComments(bookId).then(function(data) {
		commentHandler.printCollection(data);
	});

	if(loggedIn) {
		p.getBookInteractions(bookId).then(function(data){
			interaction.getFavoriteInteraction($('#action-favorite'), data, bookId);
			interaction.getReadingInteraction($('#action-reading'), data, bookId, $('#action-wishlist'));
			interaction.getWishlistInteraction($('#action-wishlist'), data, bookId);
			interaction.getPrologeInteraction($('#action-prologe'), data, bookId, function() {
				$("#prologe-modal").modal('show');
			});
		});
		setTimeout(function() {
			$('#comment-book--submit').removeClass('disabled').removeAttr('disabled');
			$('#comment-book--submit').on('click', function() {
				if($('#tab-comments').hasClass('active')) {
					var textarea = $('#book-comment--textarea');
					var commentText = textarea.val();
					if(commentText.length > 6400) {
						//alert and return 
						return 0;
					}
					if(commentText.trim() !== '') {
						$('#comment-book--submit').addClass('disabled').attr('disabled', 'disabled');
						$('#book-comment--error-area').html('');
						//post and show thread
						h.postBookComment(bookId, commentText).then(function(thread){
							console.log(thread);
							commentHandler.pushNew(thread);
							textarea.val('');
							$('#comment-book--submit').removeClass('disabled').removeAttr('disabled');
						}).catch(function(err) {
							console.log(err);
							var displayError = translator.getErrorMessage();
							switch(err.status) {
								case 401: displayError = translator.getErrorMessage('logInToPost'); break;
							}
							$('#book-comment--error-area').html('<i>' + displayError + '</i>')
			// 				var errorArea = form.find('.book-comment--error-area').first();
			// var error = translator.getErrorMessage();
			// if(e.status === 401) {
			// 	error = translator.getErrorMessage('logInToPost');
			// }
			// errorArea.append('<i>' + error + '</i>');
						});
					}

				}
			});
		}, 3000);
		//if logged in show the comment thingy
	}

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
		validateProloge(h);
	});
	
	$('#prologe-modal--raty').raty({
		size: 120,
		path: '../img/',
		starHalf :'star-half-big.png',
		starOff :'star-off-big.png',
		starOn :'star-on-big.png'
	});
});

function validateProloge() {
	var prologe = $('#prologe-modal--textarea').val();
	if(prologe.length > maxProloge) {
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
	h.postProloge(bookId, rating, prologe).then(function(prologe) {
		 console.log(prologe);
		 displaySubmittedProloge(prologe);
		 //easier to reload interactions :P
		}).catch(function(data){
			//
		});
}

function displaySubmittedProloge(prologe, id) {
	if($('#main-prologe--empty').length) {
		$('#main-prologe--empty').remove();
	}
	newProloge(prologe);
	$("#prologe-modal").modal('hide');
	$('#action-prologe').removeClass('icon-prologe--active').addClass('icon-prologe--active');
	$("#action-prologe").off();
}

function newProloge(prologe) {
	prologesHandler.printCollection(prologe);
}

</script>
