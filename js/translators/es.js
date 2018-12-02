

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

	var getText = function(text) {
		var translations = {
			'Title': 'Titulo',
			'Author': 'Autor',
			'Authors': 'Autores',
			'Add a book': 'Agrega un libro',
			'Add book': 'Agrega un libro',
			'Could not find what you were looking for?': 'No encontraste el titulo que buscabas?',
			'Search results': 'Resultados de tu busqueda',
			'Language': 'Idioma',
			'Submit book': 'Agregar libro',
			'Search book': 'Encuentra un libro',
			'Select a title': 'Escribe el titulo del libro',
			'Select one author': 'Escribe por lo menos un autor',
			/* Registration */
			'Please type a username': 'Por favor escribe el nombre de usuario',
			'The username must be between 3 and 25 characters long': 'El nombre de usuario tiene que ser entre 3 y 25 caracterres de largo',
			'The username can contain only letters, numbers and underscores': 'El nombre de usuario solo puede tener letras, numeros y guiones bajos',
			'The email is not a valid format': 'El formato de correo no es valido',
			'Your password must be at least 6 characters long':'Tu contraseña debe de tener al menos 6 caracteres',
			'Your password does not match':'Tu contraseña no coincide',
			'There was an error during registration, please try again later': 'Ha ocurrido un error durante el registro. Por favor trata de nuevo mas tarde',
			/* Book */
			'Prologues': 'Prologos',
			'Comments': 'Comentarios',
			'Similar books': 'Libros similares',
			'Write a comment...': 'Escribe un comentario...',
			'Add to your wishlist': 'Agregalo a tu lista de lectura',
			'Add to your favourites': 'Agregalo a tus favoritos',
			'Rate and leave a prologue': 'Calificalo y escribe un prologo',
			'Add to your readings': 'Agregalo a los libros que estas leyendo',
			'Write a prologue!': 'Escribe un prologo!',
			'Rate': 'Puntuar',
			'Stamp': 'Sellar',
			/* Library */
			'Currently reading': 'Estoy leyendo',
			'My wishlist': 'Quiero leer',
			'My favourites': 'Mis favoritos',
			'My prologes': 'Mis prologos',
			/* Clubs */
			'Start a new book club!': 'Empieza un nuevo club de lectura!',
			'Add it!': 'Añadelo!',
			/* Profile */
			'Display name': 'Nombre para mostrar',
			'Username': 'Usuario',
			'There was an error uploading the file. Please try again.': 'Ha ocurrido un error. Por favor intentalo mas tarde.'
		};
		if(translations[text] !== undefined) {
			return translations[text]
		} else {
			return text;
		}
	};

	var spanMap = {
		years: 'años',
		months: 'meses',
		days: 'dias',
		hours: 'horas',
		minutes: 'minutos',
		seconds: 'segundos'
	};

	var getSpan = function(name, args) {
		var span = '';
		switch(name) {
			case 'post': span = 'Publicar'; break;
			case 'cancel': span = 'Cancelar'; break;
			case 'reply': span = 'Responder'; break;
			case 'expand': span = 'Ver ' + args[0] +  (args[0] > 1 ? ' respuestas' : ' respuesta'); break;
			case 'collapse': span = 'Colapsar'; break;
			case 'timeFromNow': 
				span = 'Hace ' + args[0] + ' ' + spanMap[args[1]]; 
				break;
			case 'duplicateUser': span = 'El nombre de usuario <i>' + args[0] + '</i> ya existe'; break;
			case 'duplicateEmail': span = 'El correo electronico <i>' + args[0] + '</i> ya esta asociado a otra cuenta'; break;
			case 'duplicateName': span = 'El nombre <i>' + args[0] + '</i> ya existe'; break;
		}
		return span;
	}

	var getErrorMessage = function(message) {
		var errorMessages = {
			logInToPost: 'Debes iniciar sesion para publicar tu respuesta'
		}
		return errorMessages[message] !== undefined ? errorMessages[message] : 'Ha ocurrido un error';
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
		getText: getText,
		getSpan: getSpan,
		getErrorMessage: getErrorMessage
	};
}