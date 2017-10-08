<?php
session_start();
//if(!isset($_SESSION[SID]))die($_SESSION[SID]);
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
		<div id="index-modal" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="search.php">
						<div class="modal-header text-center">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h2 id="index-modal--header"></h2>
						</div>
						<div class="modal-body text-center">
							<div class="index-modal--info">
								<span id="index-modal--text"></span>
							</div>
							<div class="input-group index-modal--search">
								<input class="form-control" type="text" name="q" id="index-modal--field">
								<div class="input-group-btn">
									<button type="submit" class="btn search-button" id="index-modal--submit">
										<i class="glyphicon glyphicon-search"></i>
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<?php
		if(!isset($_SESSION[SID])) {
		?>
		<div class="row">
			<div class="welcome">
				<!-- inicia sesion o registrate -->
				<div class="col-md-4">
					<div class="welcome-padding-top-left"></div>
					<div class="welcome-login text-center">
						<h5>¿No tienes cuenta aún?</h5>
						<a href="registration.php">Registrate</a>
						<h4>¿Ya eres miembro?</h4>
						<a href="login.php">¡Inicia sesión!</a>
					</div>
				</div>
				
				<!-- Que es Prologes -->
				<div class="col-md-4">
					<div class="welcome-whatis">
						<div class="welcome-whatis--header text-center">
							<h1><span>B</span>ienvenido</h1>
						</div>
						<div class="welcome-whatis--body">
							<p>Únete y descubre una nueva comunidad de lectores!</p>
							<p>Marca los libros que quieres leer, los que estas leyendo y escribe prólogos para convertirte en un lider de opinión en la comunidad!</p>
						</div>

					</div>
										
				</div>
				
				<!-- Algo random -->
				<div class="col-md-4">
					<div class="welcome-padding-top-right"></div>
					<div class="welcome-prologes">
						<p>Empieza a leer los prólogos que la comunidad ha escrito para ti!</p>
						<div class="welcome-prologes--prologes">
							<div class="icon-prologe-noeffect text-center"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php
		} else {
		?>
		<div class="row">
			
			<div class="index-buttons">
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--prologo">
						<div class="index-action--prologo">Escribe un prólogo</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--reading">
						<div class="index-action--reading">Comparte lo que lees</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--favorite">
						<div class="index-action--favorite">Encuentra tus favoritos</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--wishlist">
						<div class="index-action--wishlist">Agrega libros a tu lista</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">	
			<div class="index-search">
				<form class="" action="search.php">
					<div class="input-group">
						<input class="form-control" id="index-search--field" type="text" name="q" placeholder="Encuentra tu siguiente historia" />
						<div class="input-group-btn">
							<button class="btn btn-default" id="index-search--submit" type="submit">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
					
				</form>
				<!--<div class="index-search">
					<form class="" action="search.php">
						<div class="index-search--form">
							<input class="form-control" type="text" name="q" placeholder="Encuentra tu siguiente historia">
							<div class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<i class="glyphicon glyphicon-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>-->
			</div>
		</div>
		<?php
		}
		?>
		
		
		
		
		<div class="main-page">
			<div class="row">
				<!-- Right scroll -->
				<div class="col-md-4 col-md-push-8">
					<h3 class="Section-title no-padding">Libros más leídos</h3>
					<div class="book-cards">
						<div class="row" id="most-read">
						</div>
					</div>
				</div>
				
				<!-- Main stuff -->
				<div class="col-md-8 col-md-pull-4">
					<h3 class="Section-title no-padding">Que esta pasando?</h3>
					<div class="event-cards" id="event-holder">
						
						
					</div>
					
					
				</div>
			</div>
		</div>
		
		
	<!--ends container -->	
	</div>
	
	<?php
	include("_footer.php");
	?>
</body>
</html>
<script type="text/javascript">
var p = new PrologesDataSource({});
var translator = new Translator();
var sideBooks = new SideBookTemplate({base: 'book-card', translator: translator});
var eventTemplate = new EventTemplate({base: 'event-card', translator: translator});

$(document).ready(function() {

	var mostReadHandler = new PrologesDataHolder($('#most-read'), sideBooks);
	var eventHandler = new PrologesDataHolder($('#event-holder'), eventTemplate);
	
	p.getMostRead().then(
		function(data){
			mostReadHandler.printCollection(data);
		}
	);
	
	p.getEvents().then(
		function(data){
			eventHandler.printCollection(data);
		}
	);
	
	$('#index-action--prologo').click(function() { displayIndexModal("Escribe un Prólogo", "¿De que libro quieres escribir un prólogo?"); });
	$('#index-action--favorite').click(function() { displayIndexModal("Encuentra tus favoritos", "¿Cual es tu libro favorito?"); });
	$('#index-action--reading').click(function() { displayIndexModal("Comparte lo que estas leyendo", "¿Que libro estas leyendo?"); });
	$('#index-action--wishlist').click(function() { displayIndexModal("Agregalos a tu lista", "¿Que libro quieres agregar a tu lista de lectura?"); });
});

function displayIndexModal(header, message) {
	$('#index-modal--header').html(header);
	$('#index-modal--text').html(message);
	$('#index-modal').modal('show');
}

</script>
