/**
 * Read the url values and return the specified parameter 
*/
var ajaxDir = '../php/ajax/';

function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
}

function populateRatingDiv(ratingDiv, rating) {
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

function ajax(options) {
	return new Promise(function(resolve, reject) {
		$.ajax(options).done(resolve).fail(reject);
	});
}


function UiHelper(modal, placeholder) {
	var box = modal;
	var body = placeholder;

	var displayAlert = function(message) {
		body.html(message);
		box.modal('show');
	};

	return {
		displayAlert: displayAlert
	};
}

function PrologesDataHolder(node, template, options) {
	var holder = node;
	var header = options == null ? false : options.useHeader || false;
	var defaultEmptyElement = options == null ? false : (options.defaultEmptyElement || false);

	var printCollection = function(elements) {
		if(elements.length != 0) {
			if(header) {
				holder.append(template.getHeader());
			}
			$(elements).each(function(index, element) {
				holder.append(template.getElement(element));
			});
		} else {
			if(defaultEmptyElement === false) {
				holder.append(template.getEmpty());
			} else {
				holder.append(defaultEmptyElement);
			}
		}		
	}

	return {
		printCollection: printCollection
	};
}

function AuthorBooksTemplate(cfg) {
	var base = cfg.base || 'similar-book';
	//
	var getEmpty = function(book) {
		//
	};

	var getElement = function(book) {
		var holder  = $('<div></div>', {class:'col-md-4 col-sm-6'}); 
		var article = $('<article></article>', {class: base});
		var icon = $('<div></div>', {class: base + '--thumbnail'});
		icon.append(getThumb(book));
		var info = $('<div></div>', {class: base + '--info'});
		info.append(getBookName(book));
		info.append(getRating(book.rating));
		article.append(icon);
		article.append(info);
		holder.append(article);
		return holder;
	};

	var getThumb = function(book) {
		var link = $('<a></a>',{href:'book.php?i='+book.id});
		var icon = $('<img>', {src:book.icon, alt:'Cover', class:'backup-thumb'});
		return link.append(icon);
	}

	var getBookName = function(book) {
		var link = $('<a></a>',{href:'book.php?i='+book.id});
		var title = $('<h3>').text(book.title);
		return link.append(title);
	}

	var getRating = function(bookRating) {
		var rating = $('<div></div>', {class: base + '--rating'});
		rating = populateRatingDiv(rating, bookRating);
		return rating;
	};

	return {
		getElement: getElement,
		getEmpty: getEmpty
	};
}

function UserPrologeTemplate(cfg) {
	var base = cfg.base || 'user-prologe';

	var getElement = function(element) {
		var prologe;
		var userVoting = null;
		var enableVoting = false;
		if(element.length == 2) {
			prologe = element[0];
			userVoting = element[1];
			enableVoting = true;
		} else {
			prologe = element;
		}
		//code to create a prologe
		var div = $('<div></div>',{class:'col-md-6'});
		var holder = $('<section></section>',{class:'user-prologe'});
		holder.append(getThumbnail(prologe.book));
		holder.append(getProloge(prologe));
		holder.append(getRating(prologe.rating));
		holder.append(getVoting(prologe.votes));
		return div.append(holder);
	};

	var getThumbnail = function(user) {
		var link = $('<a></a>', {href:'book.php?i='+user.id});
		var img = $('<img>',{src: user.icon, alt:"user", onerror:'this.setAttribute("src", "../img/defaultthumb.png");'});
		var holder = $('<div></div>',{class: base + '--thumbnail'});
		link.append(img);
		holder.append(link);
		return holder;
	};

	var getRating = function(userRating) {
		var rating = $('<div></div>', {class: base + '--rating text-right'});
		rating = populateRatingDiv(rating, userRating);
		return rating;
	};

	var getProloge = function(prologe) {
		var paragraph = $('<p></p>');
		var link = $('<a></a>', {href:'book.php?i=' + prologe.book.id});
		var title = $('<h4></h4>').append(prologe.book.title);
		var holder = $('<div></div>', {class:base + '--text'});
		link.append(title);
		paragraph.text(prologe.posdta);
		holder.append(link);
		holder.append(paragraph);
		return holder;
	};

	var getVoting = function(votes) {
		var holder = $('<div></div>', {class: base + '--voting text-right'});
		var total = 0;
		if(votes != null) total = (votes.upvotes - votes.downvotes);
		var counter = $('<div></div>', {class: base + '--counter'});
		if(total !== 0) {
			if(total > 0 ) {
				//pos
				counter.addClass(base + '--counter-positive').append('+' + total);
			} else {
				//negative
				counter.addClass(base + '--counter-negative').append(total);
			}
		}
		holder.append(counter);
		return holder;
	};

	var getEmpty = function() {};

	return {
		getElement: getElement,
		getEmpty: getEmpty
	};
}

function BookPrologesTemplate(cfg) {
	var base = cfg.base || 'main-prologe';
	var translator = cfg.translator;
	
	var getHeader = function() {
		return translator.getPrologesHeader();
	};

	var getEmpty = function() {
		return translator.getEmptyPrologeList();
	};

	var getElement = function(element) {
		var prologe;
		var userVoting = null;
		var enableVoting = false;
		if(element.length == 2) {
			prologe = element[0];
			userVoting = element[1];
			enableVoting = true;
		} else {
			prologe = element;
		}
		//code to create a prologe
		var holder = $('<section></section>',{class:'main-prologe'});
		holder.append(getThumbnail(prologe.user));
		holder.append(getProloge(prologe));
		holder.append(getRating(prologe.rating));
		holder.append(getSignature(prologe.user));
		holder.append(getVoting(enableVoting, prologe.votes, userVoting, prologe.id));
		return holder;
	};

	var getThumbnail = function(user) {
		var link = $('<a></a>', {href:'user.php?i='+user.id});
		var img = $('<img>',{src: user.icon, alt:"user", onerror:'this.setAttribute("src", "../img/defaultuser.png");'});
		var holder = $('<div></div>',{class: base + '--thumbnail'});
		link.append(img);
		holder.append(link);
		return holder;
	};

	var getProloge = function(prologe) {
		var paragraph = $('<p></p>');
		paragraph.text(prologe.posdta);
		var holder = $('<div></div>', {class:base + '--text'});
		holder.append(paragraph);
		return holder;
	};

	var getSignature = function(user) {
		//
		var link = $('<a></a>', {href:'user.php?i=' + user.id});
		var signature = $('<div></div>', {class: base + '--signature text-right'});
		link.text(user.displayName);
		signature.append(link);
		return signature;
	};

	var getRating = function(userRating) {
		var rating = $('<div></div>', {class: base + '--rating text-right'});
		rating = populateRatingDiv(rating, userRating);
		return rating;
	};

	var getVoting = function(enabled, votes, userVote, id) {
		console.log(enabled);
		console.log(votes);
		console.log(userVote);
		var holder = $('<div></div>', {class: base + '--voting text-right'});
		var prologeVotes = "";
		if(votes != null) prologeVotes = (votes.upvotes - votes.downvotes);
		var counter = $('<div></div>', {class: base + '--counter', id:'counter_' + id}).append(prologeVotes);
		var upvote = getUpvote(enabled, userVote, id, counter);
		var downvote = getDownvote(enabled, userVote, id, counter);
		var clear = $('<span></span>', {class:'clear-float'});
		holder.append(upvote).append(downvote).append(counter).append(clear);
		//votes.append(downvote).append(upvote).append(counter).append(clear);
		return holder;
	};

	var upvoteProloge = function(id, counter) {
		//TODO: implement nicely
		$.ajax({
		  type: 'GET',
		  dataType: 'json',
		  url: '../php/ajax/postUpvote.php',
		  data: {prologe: id},
		  success: function(data){
				$('#upvote_' + id).off().removeClass().addClass('prologe-upvote--active');
				$('#downvote_' + id).off().removeClass().addClass('prologe-downvote--disabled');
				counter.html(" "+(data.upvotes - data.downvotes));
			  }
		});
	};

	var downvoteProloge = function(id, counter) {
		//TODO: implement nicely
		$.ajax({
		  type: 'GET',
		  dataType: 'json',
		  url: '../php/ajax/postDownvote.php',
		  data: {prologe: id},
		  success: function(data){
				$('#upvote_'+ id).off().removeClass().addClass('prologe-upvote--disabled');
				$('#downvote_'+ id).off().removeClass().addClass('prologe-downvote--active');
				counter.html(" "+(data.upvotes-data.downvotes));
			  }
		});
	};

	var getUpvote = function(enabled, vote, id, counter) {
		var voteUI = $('<div></div>');
		voteUI.append($('<span>', {class: 'fa fa-chevron-up vote-icon'}))
		if(enabled) {//fa chevron-up
			if(vote == null) { /* havent voted */
				voteUI.id = 'upvote_' + id;
				voteUI.addClass('prologe-upvote');
				voteUI.on('click', function(){
					upvoteProloge(id, counter);
				})
				/*voteUI = $('<div></div>', {class:'prologe-upvote', id:'upvote_' + id})
					.on('click', function(){
						upvoteProloge(id, counter);
					});*/
			} else if(vote.upvote) { /* upvoted already */
				voteUI.addClass('prologe-upvote--active');
				//voteUI = $('<div></div>', {class:'prologe-upvote--active'});
			} else { /* downvoted already */
				voteUI.addClass('prologe-upvote--disabled');
				//voteUI = $('<div></div>', {class:'prologe-upvote--disabled'});
			}
		} else { /* only display */
			voteUI.addClass('prologe-upvote--disabled');
			//voteUI = $('<div></div>', {class:'prologe-upvote--disabled'});
		}
		return voteUI;
	};

	var getDownvote = function(enabled, vote, id, counter) {
		var voteUI = $('<div></div>');
		voteUI.append($('<span>', {class: 'fa fa-chevron-down vote-icon'}))
		if(enabled) {//fa chevron-up
			if(vote == null) { /* havent voted */
				voteUI.id = 'downvote_' + id;
				voteUI.addClass('prologe-downvote');
				voteUI.on('click', function(){
					downvoteProloge(id, counter);
				})
				/*voteUI = $('<div></div>', {class:'prologe-downvote', id:'downvote_' + id})
					.on('click', function(){
						downvoteProloge(id, counter);
					});*/
			} else if(vote.downvote) { /* downvoted already */
				voteUI.addClass('prologe-downvote--active');
				//voteUI = $('<div></div>', {class:'prologe-downvote--active'});
			} else { /* downvoted already */
				voteUI.addClass('prologe-downvote--disabled');
				//voteUI = $('<div></div>', {class:'prologe-downvote--disabled'});
			}
		} else { /* only display */
			voteUI.addClass('prologe-downvote--disabled');
			//voteUI = $('<div></div>', {class:'prologe-downvote--disabled'});
		}
		return voteUI;
	};

	return {
		getHeader: getHeader,
		getElement: getElement,
		getEmpty: getEmpty
	};
}

function EventTemplate(cfg) {
	var base = cfg.base || 'event-card';
	var translator = cfg.translator;
	var getEmpty = function(){};
	var getElement = function(event) {
		var type = event.eventType;
		var eventHolder = '';
		switch(type) {
			case 'FAVORITED': eventHolder = favorite(event); break;
			case 'WISHLISTED': eventHolder = wishlisted(event); break;
			case 'STARTED_READING': eventHolder = reading(event); break;
			case 'POSDTA': eventHolder = prologe(event); break;
			case 'STARTED_FOLLOWING': eventHolder = following(event); break;
			default: console.log('unmatched type of event:' + type); break;
		}
		return eventHolder;
	};

	var prologe = function(event) {
		var subject = getSubjectUser(event.user);
		var target = getTargetBook(event.book);
		var info = translator.getPrologeParagraph(getSubjectUserName(event.user), getTargetBookName(event.book), base);
		return getEvent(subject, target, info);
	}

	var reading = function(event) {
		var subject = getSubjectUser(event.user);
		var target = getTargetBook(event.book);
		var info = translator.getReadingParagraph(getSubjectUserName(event.user), getTargetBookName(event.book), base);
		return getEvent(subject, target, info);
	}

	var wishlisted = function(event) {
		var subject = getSubjectUser(event.user);
		var target = getTargetBook(event.book);
		var info = translator.getWishlistedParagraph(getSubjectUserName(event.user), getTargetBookName(event.book), base);
		return getEvent(subject, target, info);
	};

	var favorite = function(event) {
		var subject = getSubjectUser(event.user);
		var target = getTargetBook(event.book);
		var info = translator.getFavoriteParagraph(getSubjectUserName(event.user), getTargetBookName(event.book), base);
		return getEvent(subject, target, info);
	};

	var following = function(event) {
		var subject = getSubjectUser(event.user);
		var target = getTargetUser(event.target);
		var info = translator.getFollowingParagraph(getSubjectUserName(event.user), getTargetUserName(event.target), base);
		return getEvent(subject, target, info);
	};

	var getTargetUserName = function(user) {
		return $('<a></a>', {href:'user.php?i=' + user.id}).append(user.displayName);
	};

	var getSubjectUserName = function(user) {
		return $('<a></a>', {href:'user.php?i=' + user.id}).append(user.displayName);
	};

	var getTargetBookName = function(book) {
		return $('<a></a>', {href:'book.php?i=' + book.id}).append(book.title);
	};

	var getTargetUser = function(user) {
		var holder = $('<div></div>', {class: base + '--target-thumb'});
		var link = $('<a></a>', {href: 'user.php?i='+user.id});
		var img = $('<img>', {class:'backup-user', alt:'user', src: user.icon, onerror:'this.setAttribute("src", "../img/defaultuser.png");'});
		link.append(img);
		holder.append(link);
		return holder;
	};

	var getSubjectUser = function(user) {
		var holder = $('<div></div>', {class: base + '--thumbnail'});
		var link = $('<a></a>', {href: 'user.php?i='+user.id});
		var img = $('<img>', {class:'backup-user', alt:'user', src: user.icon, onerror:'this.setAttribute("src", "../img/defaultuser.png");'});
		link.append(img);
		holder.append(link);
		return holder;
	};

	//TODO: Apply error method to all images
	var getTargetBook = function(book) {
		var holder = $('<div></div>', {class:base + '--target'});
		var link = $('<a></a>', {href: 'book.php?i='+book.id});
		var img = $('<img>', {
			alt:'Cover', 
			src: book.thumbnail});
		link.append(img);
		holder.append(link);
		return holder;
	};

	var getEvent = function(subject, info, target) {
		var eventHolder = $('<article></article>', {class: base});
		eventHolder.append(subject);
		eventHolder.append(info);
		eventHolder.append(target);
		return eventHolder;
	};
	return {
		getElement: getElement,
		getEmpty: getEmpty
	};
}

function UserPrologesTemplate(cfg) {
	var base = cfg.base || 'library-prologe';

	var getEmpty = function() {
		//
	};

	var getElement = function(prologe) {
		//
	};

	return {
		getEmpty: getEmpty,
		getElement: getElement
	};
}

function UserLibraryTemplate(cfg) {
	var base = cfg.base || 'library-book';

	var getEmpty = function() {

	};

	var getElement = function(book) {
		var bookHolder = $('<div></div>',{class:'col-md-4'});
		var bookCard = $('<article></article>', {class:base});
		var bookThumbLink = $('<a></a>',{href:'book.php?i='+book.id});
		var bookThumb = $('<div></div>', {class: base + '--thumbnail'});
		
		var cover = book.thumbnail == null ? '../img/defaultthumb.png' : book.thumbnail;
		var thumb = $('<img>',{alt:'Book cover', src: cover});
		
		var bookInfo = $('<div></div>', {class: base + '--info'});
		var bookTitleLink = $('<a></a>',{href:'book.php?i='+book.id});
		var bookTitle = $('<h5></h5>').text(book.title);
		var bookAuthor = $('<h6></h6>').text(book.authorName);
		
		var bookRating = $('<div></div>', {class: base + '--rating'});
		var rating = book.rating != null ? book.rating.rating : 0;
		bookRating = populateRatingDiv(bookRating, rating);
		
		bookThumb.append(thumb);
		bookThumbLink.append(bookThumb);
		bookCard.append(bookThumbLink);

		bookTitleLink.append(bookTitle);
		bookInfo.append(bookTitleLink);
		bookInfo.append(bookAuthor);
		bookCard.append(bookInfo);

		bookCard.append(bookRating);
		return bookHolder.append(bookCard);
	};

	return {
		getEmpty: getEmpty,
		getElement: getElement
	};
}

//TODO: REFACTOR THIS FUNC
function GoogleSearchTemplate(cfg) {
	var base = cfg.base || 'google-result';
	var getEmpty = function(){};
	var getElement = function(result) {
		var holder = $('<article></article>', {class: base});
		console.log(result);
		//GET VARIABLES
		var authors = result['authors'] != undefined ? result['authors'] : [];
		//var author = result['author'] != undefined ? result['author'] : '';
		var title = result['title'] != undefined ? result['title'] : '';
		var lang = result['lang'] != undefined ? result['lang'] : '';
		var icon = result['icon'] != undefined ? result['icon'] : '';
		var thumbnail = result['thumbnail'] != undefined ? result['thumbnail'] : '';
		//BREAK HERE IF MISSING ATTR
		if(authors == [] || title == '' || lang == '') { console.log(result); return '';}
		var form = $('<form></form>',{action: '../php/submit/googleBookRequest.php'});
		form.append($('<input>', {type: 'hidden', name: 'authors', value: authors.join(';')}));
		form.append($('<input>', {type: 'hidden', name: 'title', value: title}));
		form.append($('<input>', {type: 'hidden', name: 'language', value: lang}));
		form.append($('<input>', {type: 'hidden', name: 'icon', value: icon}));
		form.append($('<input>', {type: 'hidden', name: 'thumbnail', value: thumbnail}));
		
		var resultCover = $('<img>', {src: thumbnail, alt:'Cover'}).error(function(){this.src='../img/defaultthumb.png';});
		var resultImgSubmit = $('<button></button>', {type:'submit', class:'google-result--submit'}).append(resultCover);
		var resultDiv = $('<div></div>', {class:'google-result--thumbnail'}).append(resultImgSubmit);
		holder.append(resultDiv);
		var resultTitle = $('<h4></h4>').html(title+" ("+lang+")");
		var resultTitleSubmit = $('<a></a>', {}).append(resultTitle);
		var resultAuthor = $('<h5></h5>').html(authors.join(', '));
		var resultInfo = $('<div></div>', {class: 'google-result--info'});
		resultInfo.append(resultTitleSubmit.click(function(){$(this).closest('form').submit();}));
		resultInfo.append(resultAuthor);
		holder.append(resultInfo);
		form.append(holder);
		return form;
		//
	};
	return {
		getEmpty: getEmpty,
		getElement: getElement
	};
}

function SearchTemplate(cfg) {
	var bookBase = cfg.bookClass || 'book-result';
	var authorBase = cfg.authorClass || 'author-result';
	var getEmpty = function() {};

	var getElement = function(result) {
		//
		if(result.className === 'Book') {
			return getBook(result);
		} else if(result.className === 'Author') {
			return getAuthor(result);
		} else {
			//
		}
	};

	var getBookCover = function(book) {
		var holder = $('<div></div>', {class: bookBase + '--thumbnail'});
		var link = $('<a></a>',{href:'book.php?i=' +  book.id});
		var icon = $('<img>',{src: book.thumbnail, alt:'Cover'});
		link.append(icon);
		holder.append(link);
		return holder;
	};

	var getBookInfo = function(book) {
		var holder = $('<div></div>', {class: bookBase + '--info'});
		var link = $('<a></a>', {href:'book.php?i=' + book.id});
		var title = $('<h4></h4>').text(book.title);
		var authors = book.authors.reduce(function(linkArray, author) {
			//
			linkArray.push("<a href='author.php?i=" + author.id + "' >" + author.name +"</a>");
			return linkArray;
		}, []);
		//authorHolder.append(authors.join(",&nbsp"));
		var author = $('<h5></h5>').html(authors.join(",&nbsp"));
		link.append(title);
		holder.append(link);
		holder.append(author);
		return holder;
	};

	var getBookRating = function(book) {
		var holder = $('<div></div>', {class: bookBase + '--rating'});
		var rating = book.rating != null ? book.rating.rating : 0;
		holder = populateRatingDiv(holder, rating);
		return holder;
	};

	var getBook = function(book) {
		var holder = $('<article></article>',{class: bookBase});
		holder.append(getBookCover(book));
		holder.append(getBookInfo(book));
		holder.append(getBookRating(book));
		return holder;
	};

	var getAuthorIcon = function(author) {
		var holder = $('<div></div>', {class: authorBase + '--thumbnail'});
		var link = $('<a></a>',{href:'author.php?i=' +  author.id});
		var icon = $('<img>',{src: author.icon, alt:'Cover'});
		link.append(icon);
		holder.append(link);
		return holder;
	};

	var getAuthorInfo = function(author) {
		var holder = $('<div></div>', {class: authorBase + '--info'});
		var link = $('<a></a>', {href:'author.php?i=' + author.id});
		var name = $('<h3></h3>').text(author.name);
		link.append(name);
		holder.append(link);
		return holder;
	}

	var getAuthor = function(author){
		var holder = $('<article></article>',{class: authorBase});
		holder.append(getAuthorIcon(author));
		holder.append(getAuthorInfo(author));
		return holder;
	};

	return {
		getEmpty: getEmpty,
		getElement: getElement
	};
}

function SideBookTemplate(cfg) {
	var base = cfg.base || 'book-card';

	var getEmpty = function() {
		//what to do in case the collection was empty
	}

	var getElement = function(book) {
		var bookHolder = $('<div></div>',{class:'col-md-12 col-sm-4'});
		var bookCard = $('<article></article>', {class:base});
		var bookThumbLink = $('<a></a>',{href:'book.php?i='+book.id});
		var bookThumb = $('<div></div>', {class: base + '--thumbnail'});
		
		var cover = book.thumbnail == null ? '../img/defaultthumb.png' : book.thumbnail;
		var thumb = $('<img>',{alt:'Book cover', src: cover});
		
		var bookInfo = $('<div></div>', {class: base + '--info'});
		var bookTitleLink = $('<a></a>',{href:'book.php?i='+book.id});
		var bookTitle = $('<h5></h5>').text(book.title);
		var bookAuthor = $('<h6></h6>').text(book.authorName);
		
		var bookRating = $('<div></div>', {class: base + '--rating'});
		var rating = book.rating != null ? book.rating.rating : 0;
		bookRating = populateRatingDiv(bookRating, rating);
		
		bookThumb.append(thumb);
		bookThumbLink.append(bookThumb);
		bookCard.append(bookThumbLink);

		bookTitleLink.append(bookTitle);
		bookInfo.append(bookTitleLink);
		bookInfo.append(bookAuthor);
		bookCard.append(bookInfo);

		bookCard.append(bookRating);
		return bookHolder.append(bookCard);
	}

	return {
		getElement: getElement,
		getEmpty: getEmpty
	};
}

function UserHandler(cfg) {
	var translator = cfg.translator;

	var displayUser = function(userInfo, displayNameHolder, userNameHolder, iconHolder) {
		iconHolder.attr('src', userInfo.user.icon);
		displayNameHolder.text(userInfo.user.displayName);
		userNameHolder.text(userInfo.user.userName);
		return true;
	};

	var followUser = function(holder, id) {
		holder.off();
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'followUser.php',
			data: {user: id}
		}).then(function(){
			holder.removeClass()
				.addClass('unfollow-button btn')
				.click(function(){
					unfollowUser(holder, id)
				});
		});
	};

	var unfollowUser = function(holder, id) {
		holder.off();
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'unfollowUser.php',
			data: {user: id}
		}).then(function(){
			holder.removeClass()
				.addClass('follow-button btn')
				.click(function(){
					followUser(holder, id)
				});
		});
	};

	var displayInteractionButton = function(id, interactions, holder) {
		//This is going to be disabled for a bit
		if(typeof interactions.following === "boolean" && false) {
			//
			var followingText = translator.getFollowingText();
			var button = $('<button>', {class: 'btn'});
			button.append($('<span>', {class: 'follow-text'}).text(followingText.follow));
			button.append($('<span>', {class: 'unfollow-text'}).text(followingText.unfollow));
			button.append($('<span>', {class: 'following-text'}).text(followingText.following));
			if(interactions.following === false) {
				button.addClass('follow-button');
				button.click(function(){
					followUser(button, id);
				});
				holder.append(button);
			} else {
				button.addClass('unfollow-button');
				button.click(function(){
					unfollowUser(button, id);
				});
				holder.append(button);
			}
		} else {
			//Probs do nothing
		}
	};

	return {
		displayUser: displayUser,
		displayInteractionButton: displayInteractionButton
	};
}

function BookHandler(cfg) {
	var DEFAULT_COVER = '../img/default.png';
	//
	var displayBook = function(bookInfo, titleHolder, coverHolder, authorHolder, ratingHolder) {
		//Set the cover
		coverHolder.error(function(){this.src=DEFAULT_COVER;});
		coverHolder.attr('src', bookInfo.book.icon);
		//Set the title
		titleHolder.text(bookInfo.book.title);
		//authorHolder.attr('href', 'author.php?i=' + bookInfo.book.author.id);
		//authorHolder.append(bookInfo.book.author.name);
		var authors = bookInfo.book.authors.reduce(function(linkArray, author) {
			//
			linkArray.push("<a href='author.php?i=" + author.id + "' >" + author.name +"</a>");
			/*var authorLink = document.createElement('a');
			authorLink.href = 'author.php?i=' + author.id;
			authorLink.appendChild(document.createTextNode(author.name));
			authorHolder.append(authorLink);
			console.log(author);*/
			return linkArray;
		}, []);
		authorHolder.append(authors.join(",&nbsp"));

		//set here the authors

		ratingHolder.raty({
			//
			readOnly: true,
			size: 120,
			score : bookInfo.book.rating ? bookInfo.book.rating : 0,
			path: '../img/',
			starHalf : 'star-half-big.png',
			starOff : 'star-off-big.png',
			starOn : 'star-on-big.png',
		});
		return true;
	};

	return {
		displayBook: displayBook
	};
}

function AuthorHandler(cfg) {
	var displayAuthor = function(author, nameHolder, iconHolder) {
		//
		nameHolder.text(author.name);
		iconHolder.attr('src', author.icon)
	};

	return {
		displayAuthor: displayAuthor
	};
}

function BookInteractionHandler(cfg) {
	//handle the book interactions
	var base = cfg.base || 'icon';
	var ajaxDir = cfg.dir || '../php/ajax/';
	//TODO: put defautl values for these two (make them optional)
	var translator = cfg.translator;
	var uiHandler = cfg.uiHandler;

	var ajax = function(options) {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};

	var removeFromReading = function(holder, id, wishlist) {
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'deleteFromReadings.php',
			data: {book: id}
		}).then(function() {
			holder.removeClass()
				.addClass('icon-reading')
				.off()
				.click(function(){
					addToReading(holder, id);
				});
			//TODO: Enable wishlisting again
			uiHandler.displayAlert(translator.interactionReadingRemove());
		});
	};

	var addToReading = function(holder, id, wishlist) {
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'addToReading.php',
			data: {book: id}
		}).then(function() {
			holder.removeClass()
				.addClass('icon-reading--active')
				.off()
				.click(function(){
					removeFromReading(holder, id);
				});
			//TODO: Disable wishlisting here
			uiHandler.displayAlert(translator.interactionReadingAdd());
		});
	};

	var removeFromWishlist = function(holder, id) {
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'deleteFromWishlist.php',
			data: {book: id}
		}).then(function() {
			holder.removeClass()
				.addClass('icon-wishlist')
				.off()
				.click(function(){
					addToWishlist(holder, id);
				});
			uiHandler.displayAlert(translator.interactionWishlistRemove());
		});
	};

	var addToWishlist = function(holder, id) {
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'addToWishlist.php',
			data: {book: id}
		}).then(function() {
			holder.removeClass()
				.addClass('icon-wishlist--active')
				.off()
				.click(function(){
					removeFromWishlist(holder, id);
				});
			uiHandler.displayAlert(translator.interactionWishlistAdd());
		});
	};

	var removeFromFavorites = function(holder, id) {
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'deleteFromFavorites.php',
			data: {book: id}
		}).then(function() {
			holder.removeClass()
				.addClass('icon-favorite')
				.off()
				.click(function(){
					addToFavorites(holder, id);
				});
			uiHandler.displayAlert(translator.interactionFavoritesRemove());
		});
	};

	var addToFavorites = function(holder, id) {
		ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'addToFavorites.php',
			data: {book: id}
		}).then(function() {
			holder.removeClass()
				.addClass('icon-favorite--active')
				.off()
				.click(function(){
					removeFromFavorites(holder, id);
				});
			uiHandler.displayAlert(translator.interactionFavoritesAdd());
		});
	};

	var getFavoriteInteraction = function(holder, interactions, id) {
		if(interactions.favorite == true) {
			holder.removeClass('icon-favorite--disabled')
				.addClass('icon-favorite--active')
				.click(function() {
					removeFromFavorites(holder, id);
				});
		} else {
			holder.removeClass('icon-favorite--disabled')
				.addClass('icon-favorite')
				.click(function() {
					addToFavorites(holder, id);
				});
		}
	};

	var getReadingInteraction = function(holder, interactions, id, wishlist) {
		if(interactions.reading == true) {
			holder.removeClass('icon-reading--disabled')
				.addClass('icon-reading--active')
				.click(function() {
					removeFromReading(holder, id);
				});
		} else {
			holder.removeClass('icon-reading--disabled')
				.addClass('icon-reading')
				.click(function() {
					addToReading(holder, id);
				});
		}
	};

	var getWishlistInteraction = function(holder, interactions, id) {
		if(interactions.wishlisted == true) {
			holder.removeClass('icon-wishlist--disabled')
				.addClass('icon-wishlist--active')
				.click(function() {
					removeFromWishlist(holder, id);
				});
		} else if(interactions.reading != true) {
			holder.removeClass('icon-wishlist--disabled')
				.addClass('icon-wishlist')
				.click(function() {
					addToWishlist(holder, id);
				});
		}
	};

	var getPrologeInteraction = function(holder, interactions, id, f) {
		if(interactions.posdta) {
			holder.removeClass('icon-prologe--disabled')
				.addClass('icon-prologe--active');
		} else {
			holder.removeClass('icon-prologe--disabled')
				.addClass('icon-prologe')
				.click(function() {
					//Modal show and stuff ->
					f();
				});
		}
	};

	var markAsProloged = function(prologeIcon, readingIcon, id) {
		//
		prologeIcon.removeClass('icon-prologe')
			.addClass('icon-prologe--active')
			.off();
		readingIcon.removeClass('icon-reading--disabled icon-reading--active')
			.addClass('icon-reading')
			.off()
			.click(function() {
				addToReading(readingIcon, id)
			});
		f();
	};

	return {
		getFavoriteInteraction: getFavoriteInteraction,
		getReadingInteraction: getReadingInteraction,
		getWishlistInteraction: getWishlistInteraction,
		getPrologeInteraction: getPrologeInteraction,
		markAsProloged: markAsProloged
	};
}

function PrologesDataHandler(cfg) {
	var ajaxDir = cfg.dir || '../php/ajax/';

	var ajax = function(options) {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};

	this.postProloge = function(book, rating, prologe) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'postPosdta.php',
			data: {book: book, rating: rating, posdta: prologe}
		});
	};
}

function AuthorDataSource(cfg) {
	var ajaxDir = cfg.dir || '../php/ajax/';

	var ajax = function(options) {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};

	var getInfo = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getAuthor.php',
			data: {author: id}
		});
	};

	var getBooks = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getAuthorBooks.php',
			data: {author: id}
		});
	};

	return {
		getInfo: getInfo,
		getBooks: getBooks
	};
}

function MyDataSource(cfg) {
	var ajaxDir = cfg.dir || '../php/ajax/';
	var ajax = function(options) {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};
	var getProloges = function() {};
	var getReading = function() {};
	var getFavorites = function() {};
	var getWishlisted = function() {};
	var getLibraryView = function() {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getMyLibraryView.php',
			data: {limit: 10}
		});
	};

	return {
		getProloges: getProloges,
		getReading: getReading,
		getFavorites: getFavorites,
		getWishlisted: getWishlisted,
		getLibraryView: getLibraryView
	};
}

function UserDataSource(cfg) {
	var ajaxDir = cfg.dir || '../php/ajax/';

	var ajax = function(options) {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};

	var getUserInteractions = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getInteractionsWithUser.php',
			data: {user: id}
		});
	};

	var getUserInfo = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getUserInfo.php',
			data: {user: id}
		});
	};

	var getProloges = function(id, limit) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getUserPosdtas.php',
			data: {user: id, limit: limit === undefined ? 20 : limit}
		});
	};

	var getBooksReading = function(id, limit) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getUserReadings.php',
			data: {user: id, limit: limit === undefined ? 10 : limit}
		});
	};

	var getBooksFavorited = function(id, limit) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getUserFavorites.php',
			data: {user: id, limit: limit === undefined ? 10 : limit}
		});
	};

	var getBooksWishlisted = function(id, limit) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getUserWishlisted.php',
			data: {user: id, limit: limit === undefined ? 10 : limit}
		});
	};

	return {
		getUserInfo: getUserInfo,
		getUserInteractions: getUserInteractions,
		getProloges: getProloges,
		getBooksReading: getBooksReading,
		getBooksFavorited: getBooksFavorited,
		getBooksWishlisted: getBooksWishlisted
	};
}

function SearchDataSource(cfg) {
	var ajaxDir = cfg.dir || '../php/ajax/';
	var ajax = function(options) {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};
	var search = function(query, start, limit) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'search.php',
			data: {q: query, start: start, limit: limit === undefined ? 10 : limit}
		});
	}
	var googleSearch = function(query, limit) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'gsearch.php',
			data: {q: query, limit: limit === undefined ? 10 : limit}
		});
	};

	return {
		search: search,
		googleSearch: googleSearch
	};
}

function PrologesDataSource(cfg) {
	
	var ajaxDir = cfg.dir || '../php/ajax/';

	var ajax = function(options) {
		return new Promise(function(resolve, reject) {
			$.ajax(options).done(resolve).fail(reject);
		});
	};

	this.getMostRead = function() {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getMostRead.php',
			data: {limit: 3}
		});
	}
	
	this.getEvents = function() {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getEvents.php'
		});
	};

	this.getBookInteractions = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getInteractionsWithBook.php',
			data: {book: id}
		});
	};

	this.getBookPosdtas = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getBookPosdtas.php',
			data: {book: id}
		});
	};

	this.getBookInfo = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getBookInfo.php',
			data: {book: id}
		});
	};

	this.getBooksFromSameAuthor = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getBooksFromSameAuthor.php',
			data: {book: id}
		});
	};

	this.getBookProloges = function(id) {
		return ajax({
			type: 'GET',
			dataType: 'json',
			url: ajaxDir + 'getBookPosdtas.php',
			data: {book: id}
		});
	};
}
