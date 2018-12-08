<?php

?>

<div class="col-md-12">
<!--  -->
	<div id="book-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<h2 id="book-modal--body"></h2>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div id="login-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					Log in to write a prologue!
				</div>
				<div class="modal-body text-center">
					<a href="login.php"><button type="button" id="btn-to-review" class="btn Blue-button">Log In</button></a>
					<h5>New to the site?<a href="registration.php">Sign up!</a></h5>
				</div>
			</div>
		</div>
	</div>
	<!--  -->
	<div id="prologe-modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><span id="modal-title-placeholder">Write a prologue!</span></h3>
				</div>
				<div class="modal-body">
					<div class="prologe-modal--prologe text-center">
						<textarea id="prologe-modal--textarea" class="prologe-modal--textarea"></textarea>
						<div class="prologe-modal--feedback text-right" id="prologe-modal--feedback"></div>
					</div>
					<div class="prologe-modal--rating">
						<span id='modal-rating--label'>Rate</span>: <span id="prologe-modal--raty"></span>
					</div>
				</div>
				<div class="modal-footer">
					<div class="modal-footer--buttons text-center">
						<button type="button" class="btn Blue-button" id="prologe-modal--submit">Stamp!</button>
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
		<img alt="Cover" id="book-cover" class="backup-cover lazy"/>

			<!-- <img src="<?php echo $rootpath;?>img/default.png" alt="Cover" id="book-cover" class="backup-cover"/>
 -->		</div>
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
				<?php echo file_get_contents("img/svg/wishlist.svg");?>
			</div>
			<div class="icon-favorite--disabled" id="action-favorite" title="Add to your favroites">
				<?php echo file_get_contents("img/svg/favorite.svg");?>
			</div>
			<div class="icon-prologe--disabled" id="action-prologe" title="Rate this book and write a prologue">
				<?php echo file_get_contents("img/svg/prologe.svg");?>
			</div>
			<div class="icon-reading--disabled" id="action-reading" title="Add to your readings">
				<?php echo file_get_contents("img/svg/reading.svg");?>
			</div>
		</div>
	</section>

	<div class='row user-tabs'>
		<ul class='nav nav-tabs'>
			<li  class='active'><a href='#tab-prologues' data-toggle='tab' id='tab-prologues--anchor'>Prologues</a></li>
			<li><a href='#tab-comments' data-toggle='tab' id='tab-comments--anchor'>Comments</a></li>
			<li><a href='#tab-similar' data-toggle='tab' id='tab-similar--anchor'>Similar</a></li>
		</ul>
	</div>

	<div class='tab-content'>
		<!-- Prologes DIV -->
		<div id='tab-prologues' class='tab-pane fade in active'>
			<div class="main-prologes" id="main-prologes"></div>
		</div>

		<!-- Comments DIV -->
		<div id='tab-comments' class='tab-pane fade in'>
			<div class="book-comment--area" id="book-comment--area" >
				<div class="comment--form">
					<div class="comment--textarea-container">
						<textarea id="book-comment--textarea" class="comment--textarea" placeholder="Write a comment..."></textarea>
						<div class="comment--error-area" id="book-comment--error-area"></div>
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

		<!-- Similar DIV -->
		<div id='tab-similar' class='tab-pane fade in'>
			<!-- Existing similar -->
			<div class='similarities' id='main-similarities'>
				<!-- Example 1 -->
				<!-- <div class='similarity panel'>
					<div class='similarity--book'>
						<div class='book--icon similarity--icon'>
							<img src='/prologes/img/book_dark.png' class='book--icon'>
						</div>
						<div class='book-info book-info--right'>
							<span class='title'><a href=''>Long Book tile</a></span>
							<span class='authors'><a href=''>Author One</a>, <a href=''>Author Two</a></span>
						</div>
					</div>
					<div class='similarity--voting'>
						<div class='similairty--voting-up'>
							<i class='fas fa-chevron-up'></i>
						</div>
						<div class='similarity--voting-bar'>
							<div class='up' style='width:75%'></div>
						</div>
						<div class='similarity--voting-down'>
							<i class='fas fa-chevron-down'></i>
						</div>
					</div>
				</div> -->
				<!-- Example 2 -->
				<!-- <div class='similarity panel'>
					<div class='similarity--book'>
						<div class='book--icon similarity--icon'>
							<img src='/prologes/img/book_clear.png' class='book--icon'>
						</div>
						<div class='book-info book-info--right'>
							<span class='title'><a href=''>The lord of the rings: Two towers</a></span>
							<span class='authors'><a href=''>Author One</a>, <a href=''>Author Two</a>, <a href=''>Author Three</a></span>
						</div>
					</div>
					<div class='similarity--voting'>
						<div class='similairty--voting-up'></div>
						<div class='similarity--voting-bar'>
							<div class='up' style='width:75%'></div>
						</div>
						<div class='similarity--voting-down'></div>
					</div>
				</div> -->
				<!-- End examples -->
				<!-- <div class='similarity panel'>
					<div class='similarity--book'>
						<div class='book--icon similarity--icon'>
							<img src='/prologes/img/book_dark.png' class='book--icon'>
						</div>
						<div class='book-info book-info--right'>
							<span class='title'><a href=''>Long Book tile</a></span>
							<span class='authors'><a href=''>Author One</a>, <a href=''>Author Two</a></span>
						</div>
					</div>
					<div class='similarity--voting'>
						<div class='similairty--voting-up'>
							<i class='fas fa-chevron-up'></i>
						</div>
						<div class='similarity--voting-bar'>
							<div class='up' style='width:75%'></div>
						</div>
						<div class='similarity--voting-down'>
							<i class='fas fa-chevron-down'></i>
						</div>
					</div>
				</div>
				<div class='similarity panel'>
					<div class='similarity--book'>
						<div class='book--icon similarity--icon'>
							<img src='/prologes/img/book_dark.png' class='book--icon'>
						</div>
						<div class='book-info book-info--right'>
							<span class='title'><a href=''>Long Book tile</a></span>
							<span class='authors'><a href=''>Author One</a>, <a href=''>Author Two</a></span>
						</div>
					</div>
					<div class='similarity--voting'>
						<div class='similairty--voting-up'>
							<i class='fas fa-chevron-up'></i>
						</div>
						<div class='similarity--voting-bar empty'>
						</div>
						<div class='similarity--voting-down'>
							<i class='fas fa-chevron-down'></i>
						</div>
					</div>
				</div> -->
			</div>
			<!-- Add from your readings -->
			<?php if($loggedIn) { ?>
			<div class='row suggest-similar'>
				<div class='collapsible-button' data-toggle='collapse' data-target='#my-readings' tabindex='0' role='button' id='add-similar-book'>
					<i class='fas fa-plus'></i>
					<span class='' >Add a similar book</span>
				</div>
				<div class='collapse' id='my-readings'>
					<div class='filter'>
						<div class='instructions'>
							<span>Suggest a similar book from the ones you have read.</span>
						</div>
						<div class='filter-textfield'>
							<div class="input-group">
								<input type="text" class="form-control" id="suggest-similar--filter">
								<span class="input-group-addon">
									<i class="fas fa-filter"></i>
								</span>
							</div>
							<!-- <input type='text' id='suggest-similar--filter' class='filter-textfield' placeholder='Filter'/> -->
					</div>
					</div>
					<div class='my-readings'>
						<!-- List of books I have read -->
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>

<!-- <div class="col-md-4 col-sm-12" id="similar-books">
	<h2 class="Section-title no-padding">Similar books</h2>
</div> -->

<script type="text/javascript">
var bookId = '<?php echo $book; ?>';
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

var commentHandler = new CommentDataHolder($('#main-comments'), { translator: translator });

var interaction = new BookInteractionHandler({
	translator: translator,
	uiHandler: uiHelper
});

var similarBooks = {}; //map of ids of similar books

var myReads = null; // array of my books

function filterMyReads(filterString) {
	for(var i = 0; i < myReads.length; i++) {
		var book = myReads[i];
		if(book.title.includes(filterString)) {
			$('#mybook-' + book.id).removeClass('filter-out');
			// TODO: add highlighting
		} else {
			$('#mybook-' + book.id).addClass('filter-out');
		}
	}
}

function suggestionButtonClick(similarId) {
	return function() {
		console.log('similar:', similarId);
		suggestSimilar(similarId).then(function(similarity) {
			console.log('similarity:', similarity);
			similarBooks[similarity.similar.id] = true;
			$('#mybook-' + similarity.similar.id).remove();
			myReads.splice(myReads.map(function(e){e.id}).indexOf(similarity.similar.id), 1);
			var similarityElement = createSimilarityElement(similarity);
			$('#main-similarities').append(similarityElement);
		});
	};
}

function createSimilarityBar(upvotes, downvotes) {
	var similarityBar = $('<div></div>', {class: 'similairty--voting-bar'});
	if(upvotes > 0 && downvotes > 0) {
		var percentage = (upvotes*100) / (upvotes + downvotes);
		var upDiv = $('<div></div>', {class: 'up', style: 'width:' + percentage + '%;'});
		similarityBar.append(upDiv);
	} else {
		similarityBar.addClass('empty');
	}
	return similarityBar;
}

function authorsNode(authors) {
	var span = $('<span></span>');
	for(var i = 0; i < authors.length; i++) {
		var author = authors[i];
		var link = $('<a></a>', {href: ROOT_PATH + 'author/' + author.id})
			.append(document.createTextNode(author.name));
		if(i > 0) span.append(document.createTextNode(', '));
		span.append(link);
	}
	return span;
}

function createVoteOnClick(similarityId, vote, elementToUnbind) {
	return function() {
		// console.log('voting for: ', similarityId, vote);
		voteSimilar(similarityId, vote === true ? '1' : '0').then(function(data) {
			if(data.vote === true) {
				$('#similarity-' + similarityId).find('.similarity--voting-up').addClass('voted');
			} else {
				$('#similarity-' + similarityId).find('.similarity--voting-down').addClass('voted');
			}
		});
		unbind(elementToUnbind);
	}
}

function createVoteOnKeydown(similarityId, vote, elementToUnbind) {
	return function(e) {
		if(e.keyCode == 13 || e.keyCode == 32) {
			// console.log('voting for: ', similarityId, vote);
			voteSimilar(similarityId, vote === true ? '1' : '0').then(function(data) {
				if(data.vote === true) {
					$('#similarity-' + similarityId).find('.similarity--voting-up').addClass('voted');
				} else {
					$('#similarity-' + similarityId).find('.similarity--voting-down').addClass('voted');
				}
			});
			unbind(elementToUnbind);
		}
	}
}

function unbind(elementId) {
	var el = '#' + elementId;
	console.log('el:', $(el));
	$(el).find('.similarity--voting-up').off('click');
	$(el).find('.similarity--voting-down').off('click');
	$(el).find('.similarity--voting-up').off('keypress');
	$(el).find('.similarity--voting-down').off('keypress');
}

function createSimilarityElement(similarity) {
	//
	var elementId = 'similarity-' + similarity.id;
	var icon = $('<img>', {class: 'book--icon', src: similarity.similar.icon});
	var bookIconDiv = $('<div></div>', {class: 'book--icon similarity--icon'}).append(icon);

	var link = $('<a></a>', {class: '', href: ROOT_PATH + 'book/' + similarity.similar.id}).append(document.createTextNode(similarity.similar.title));
	var titleSpan = $('<span></span>', {class: 'title'}).append(link);
	var authors = authorsNode(similarity.similar.authors);
	var bookInfoDiv = $('<div></div>', {class: 'book-info book-info--right'}).append(titleSpan).append(authors);
	var bookDiv = $('<div></div>', {class: 'similarity--book'}).append(bookIconDiv).append(bookInfoDiv);
	var upvoteChevron = $('<i></i>', {class: 'fas fa-chevron-up'});
	var upvote = $('<div></div>', {class: 'similarity--voting-up', tabindex: '0', role: 'button'}).append(upvoteChevron);
	var downvoteChevron = $('<i></i>', {class: 'fas fa-chevron-down'});
	var downvote = $('<div></div>', {class: 'similarity--voting-down', tabindex: '0', role: 'button'}).append(downvoteChevron);
	var voteCounter = $('<div></div>', {class: 'similarity--voting-counter', tabindex: '0'}).append(document.createTextNode(similarity.upvotes - similarity.downvotes));
	console.log('printing votes:');
	var votingDiv = $('<div></div>', {class: 'similarity--voting'}).append(upvote).append(voteCounter).append(downvote);
	if(loggedIn && similarity.vote == null) {
		votingDiv.addClass('enabled');
		upvote.on('click', createVoteOnClick(similarity.id, true, elementId));
		downvote.on('click', createVoteOnClick(similarity.id, false, elementId));
		upvote.on('keypress', createVoteOnKeydown(similarity.id, true, elementId));
		downvote.on('keypress', createVoteOnKeydown(similarity.id, false, elementId));
	}
	if(similarity.vote === true) {
		upvote.addClass('voted');
	}
	if(similarity.vote === false) {
		downvote.addClass('voted');
	}
	var panel = $('<div></div>', {class: 'similarity panel', id: elementId}).append(bookDiv).append(votingDiv);
	return panel;
}

function getMyBooks() {
	if(myReads == null) {
		myReads = [];
		getMyReadings().then(function(books) {
			var holder = $('.my-readings');
			//print books
			for(var i = 0; i < books.length; i++) {
				//
				// check if book is in existing similatiries already
				var book = books[i];
				if(!similarBooks[book.id]) {
				// if not print it
					myReads.push({
						title: book.title.toLowerCase(),
						id: book.id
					});
					// print each
					var iconImg = $('<img/>', {src: book.icon, class: 'book--icon'});
					var iconDiv = $('<div></div>', {class: 'book-icon similarity--icon'}).append(iconImg);
					var titleSpan = $('<span></span>', {class: 'title'}).append(document.createTextNode(book.title));
					var authorSpan = $('<span></span>', {}).append(document.createTextNode(book.authors[0].name));
					var infoDiv = $('<div></div>', {class: 'book-info book-info--right'}).append(titleSpan).append(authorSpan);
					var bookDiv = $('<div></div>', {class: 'similarity--book'}).append(iconDiv).append(infoDiv);

					var button = $('<button></button>', {class: 'btn action-btn-green'}).append(document.createTextNode(getText('Suggest as similar'))).on('click', suggestionButtonClick(book.id));
					var buttonDiv = $('<div></div>', {class: ''}).append(button);
					var actionsDiv = $('<div></div>', {class: 'actions'}).append(buttonDiv);
					var myReadingDiv = $('<div></div>', {class:'similarity panel', id: 'mybook-' + book.id}).append(bookDiv).append(actionsDiv);

					holder.append(myReadingDiv);
				}
			}
		});
	}
}
	
$(document).ready(function() {

	if(loggedIn) {
		$('#add-similar-book').on('keypress', function(e) {
			if(e.keyCode == 13 || e.keyCode == 32) {
				$(this).click();
			}
		});

		$('#tab-similar--anchor').on('click', function(){
			getMyBooks();
		});

		$('#suggest-similar--filter').on('keyup', function(e) {
			filterMyReads($(this).val().toLowerCase());
		});
	}

  $('body').tooltip({placement: 'top', selector: '[data-toggle=tooltip]'});
  /* Set translated texts */
  $('#tab-prologues--anchor').html(getText('Prologues'));
  $('#tab-comments--anchor').html(getText('Comments'));
  $('#tab-similar--anchor').html(getText('Similar books'));
  $('#book-comment--textarea').attr('placeholder', getText('Write a comment...'));
  $('#action-wishlist').attr('title', getText('Add to your wishlist'));
  $('#action-favorite').attr('title', getText('Add to your favourites'));
  $('#action-prologe').attr('title', getText('Rate and leave a prologue'));
  $('#action-reading').attr('title', getText('Add to your readings'));
  $('#modal-title-placeholder').text(getText('Write a prologue!'));
  $('#modal-rating--label').text(getText('Rate'));
  $('#prologe-modal--submit').html(getText('Stamp'));

  //Print other books from the same author
	p.getBooksFromSameAuthor(bookId).then(
		function(data) {
			sameAuthorHandler.printCollection(data);
		}
	);

// Load the book info
	p.getBookInfo(bookId).then(function(bookInfo){
// 		coverHolder.error(function(){this.src=DEFAULT_COVER;});
// 		coverHolder.attr('src', bookInfo.book.icon);
		$('#book-cover').attr('src', bookInfo.book.icon);
		$('#book-title').text(bookInfo.book.title);
		var authors = bookInfo.book.authors.reduce(function(linkArray, author) {
			linkArray.push("<a href='" + ROOT_PATH + "author?i=" + author.id + "' >" + author.name +"</a>");
			return linkArray;
		}, []);
		$('#book-author').append(authors.join(",&nbsp"));
		$('#main-book--rated').raty({
			readOnly: true,
			size: 120,
			score : bookInfo.book.rating ? bookInfo.book.rating : 0,
			path: IMG_ROOT + 'img/',
			starHalf : 'star-half-big.png',
			starOff : 'star-off-big.png',
			starOn : 'star-on-big.png',
		})

	});

	// Print the prologes or the empty 'be the first' thing
	p.getBookProloges(bookId).then(function(data){
		prologesHandler.printCollection(data);
	});

	//getbookcomments
	//print comment tree
	p.getBookComments(bookId).then(function(data) {
		commentHandler.printCollection(data);
	});

	getSimilar(bookId).then(function(data){
		//print
		console.log(data);
		for(var i = 0; i < data.length; i++) {
			var similarity = data[i];
			similarBooks[similarity.similar.id] = true;
			var similarityElement = createSimilarityElement(similarity);
			$('#main-similarities').append(similarityElement);
		}
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
			//All the comment stuff
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
							$('#book-comment--error-area').html('<i>' + displayError + '</i>');
						});
					}

				}
			});
		}, 3000);
	}

	//This is all the code for the max text prologue text area
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
		path: IMG_ROOT + 'img/',
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

/* Similar books */
function getMyReadings() {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getMyReads.php'
	});
}

function getSimilar(bookId) {
	return ajaxPromise({
		type: 'GET',
		dataType: 'json',
		url: AJAX_DIR + 'getBookSimilarities.php',
		data: {book: bookId}
	});
}

function suggestSimilar(similarId) {
	//bookId
	return ajaxPromise({
		type: 'POST',
		dataType: 'json',
		url: AJAX_DIR + 'postSimilarBook.php',
		data: {original: bookId, similar: similarId}
	});
}

function voteSimilar(similarityId, vote) {
	return ajaxPromise({
		type: 'POST',
		dataType: 'json',
		url: AJAX_DIR + 'postSimilarityVote.php',
		data: {similarity: similarityId, vote: vote}
	});
}

</script>