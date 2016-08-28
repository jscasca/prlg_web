

function Translator() {
	
	var getPrologesHeader = function() {
	//holder.prepend('<h2>Lee lo que la comunidad opina</h2>');
		var header = $('<h2>Lee lo que la comunidad opina</h2>');
		return header;
	};

	var getEmptyPrologeList = function() {
		//TODO create the element properly
		var holder = $('<section class="main-prologe" id="main-prologe--empty" display="none"><div class="main-prologe--empty text-center"><h3>Nadie ha escrito un prologo sobre este libro. </h3><h2>Se el primero!</h2></div><div class="main-prologe--prologe"><div class="icon-prologe text-center" id="first-prologe"></div></div></section>');
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
	};

	var getFollowingText = function(){return {follow: 'SEGUIR', unfollow: 'NO SEGUIR', following: 'SIGUIENDO'};};

	var getFavoriteParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" ha agregado ").append(target).append(" a sus favoritos.");
		return holder.append(paragraph);
	};
	var getWishlistedParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" agrego ").append(target).append(" a su lista de lectura.");
		return holder.append(paragraph);
	};
	var getReadingParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" esta leyendo ").append(target);
		return holder.append(paragraph);
	};
	var getPrologeParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" ha escrito un prologe de ").append(target);
		return holder.append(paragraph);
	};

	var getFollowingParagraph = function(subject, target, base) {
		var holder = $('<div></div>', {class:base + '--info'});
		var paragraph = $('<p></p>').append(subject).append(" esta siguiendo a ").append(target);
		return holder.append(paragraph);
	};


	var emptyLibraryElement = function() {
		//
		return 'No hay libros en esta seccion';
	};

	var interactionReadingAdd = function() {
		return 'Se agrego a los libros que estas leyendo!';
	};

	var interactionReadingRemove = function() {
		return 'Se removio de los libros que estas leyendo!';
	};

	var interactionFavoritesAdd = function() {
		return 'Se agrego a tus libros favoritos!';
	};

	var interactionFavoritesRemove = function() {
		return 'Se removio de tus libros favoritos';
	};

	var interactionWishlistAdd = function() {
		return 'Se agrego a tu lista de libros por leer!';
	};

	var interactionWishlistRemove = function() {
		return 'Se removio de tus libros por leer';
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
		interactionFavoritesRemove: interactionFavoritesRemove
	};
}