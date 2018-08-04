

function Translator() {
	
	var getPrologesHeader = function() {
	//holder.prepend('<h2>Lee lo que la comunidad opina</h2>');
		var header = $('<h2>Read what the community thinks</h2>');
		return header;
	};

	var getEmptyPrologeList = function() {
		//TODO create the element properly
		var holder = $('<section class="main-prologe" id="main-prologe--empty" display="none"><div class="main-prologe--empty text-center"><h3>There are no prologues about this book. </h3><h2>Be the first!</h2></div><div class="main-prologe--prologe"><div class="icon-prologe text-center" id="first-prologe"></div></div></section>');
		//Append the function or something
		return holder;
		/*$("#first-prologe").click(function(){
		//depending on
		if(loggedIn) {
			$("#prologe-modal").modal('show');
		} else {
			$("#login-modal").modal('show');
		}
	});
		*/
	}

	var getFollowingText = function(){return {follow: 'FOLLOW', unfollow: 'UNFOLLOW', following: 'FOLLOWING'};};

	var getFavoriteParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" added ").append(target).append(" as a favorite.");
		return holder.append(paragraph);
	};
	var getWishlistedParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" wishlisted ").append(target);
		return holder.append(paragraph);
	};
	var getReadingParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" is reading ").append(target);
		return holder.append(paragraph);
	};
	var getPrologeParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" wrote a prologue about ").append(target);
		return holder.append(paragraph);
	};
	var getFollowingParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" is now following ").append(target);
		return holder.append(paragraph);
	}

	var emptyLibraryElement = function() {
		//
		return 'There are no book in this shelf';
	};

	var interactionReadingAdd = function() {
		return 'Added to your readings!';
	};

	var interactionReadingRemove = function() {
		return 'Removed from your readings!';
	};

	var interactionFavoritesAdd = function() {
		return 'Added to your favorites!';
	};

	var interactionFavoritesRemove = function() {
		return 'Removed from your favorites';
	};

	var interactionWishlistAdd = function() {
		return 'Added to your wishlist!';
	};

	var interactionWishlistRemove = function() {
		return 'Removed from your wishlist';
	};

	var getSpan = function(name, args) {
		var span = name;
		switch(name) {
			case 'post': span = 'Post'; break;
			case 'cancel': span = 'Cancel'; break;
			case 'reply': span = 'Reply'; break;
			case 'expand': span = '' + args[0] + ' ' + (args[0] > 1 ? 'replies' : 'reply'); break;
			case 'collapse': span = 'Collapse'; break;
			case 'timeFromNow': span = args[0] + ' ' + args[1] + ' ago'; break;
		}
		return span;
	}

	var getTimeFromNow = function(interval, span) {
		return  interval + ' ' + span + ' ago';
	};

	var getErrorMessage = function(message) {
		var errorMessages = {
			logInToPost: 'You must be logged in to post a reply'
		};
		return errorMessages[message] !== undefined ? errorMessages[message] : 'An error has occurred';
	};

	return {
		/* Following and unfollowing*/
		getFollowingText: getFollowingText,
		/* Regarding event paragraphs*/
		getWishlistedParagraph: getWishlistedParagraph,
		getReadingParagraph: getReadingParagraph,
		getPrologeParagraph: getPrologeParagraph,
		getFavoriteParagraph: getFavoriteParagraph,
		getFollowingParagraph: getFollowingParagraph,
		/* Prologe listing*/
		getPrologesHeader: getPrologesHeader,
		getEmptyPrologeList: getEmptyPrologeList,
		/* Modal action texts */
		interactionWishlistAdd: interactionWishlistAdd,
		interactionReadingAdd: interactionReadingAdd,
		interactionFavoritesAdd: interactionFavoritesAdd,
		interactionWishlistRemove: interactionWishlistRemove,
		interactionReadingRemove: interactionReadingRemove,
		interactionFavoritesRemove: interactionFavoritesRemove,
		/**/
		getSpan: getSpan,
		getErrorMessage: getErrorMessage
	};
}