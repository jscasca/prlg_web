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
						<h5>Don't have an account?</h5>
						<a href="registration.php">Sign up!</a>
						<h4>Already a member?</h4>
						<a href="login.php">Log in!</a>
					</div>
				</div>
				
				<!-- Que es Prologes -->
				<div class="col-md-4">
					<div class="welcome-whatis">
						<div class="welcome-whatis--header text-center">
							<h1><span>W</span>elcome</h1>
						</div>
						<div class="welcome-whatis--body">
							<p>Join us and discover a new community for readers!</p>
							<p>Wishlist what you want to read, share what you are reading and write prologues so other readers can find their next book!</p>
						</div>

					</div>
										
				</div>
				
				<!-- Algo random -->
				<div class="col-md-4">
					<div class="welcome-padding-top-right"></div>
					<div class="welcome-prologes">
						<p>Start reading the prologues that the community has written!</p>
						<div class="welcome-prologes--prologes">
							<div class="icon-prologe-noeffect text-center"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?
		} else {
		?>
		<div class="row">
			
			<div class="index-buttons">
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--prologo">
						<div class="index-action--prologo">Write a prologue</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--reading">
						<div class="index-action--reading">Share your readings</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--favorite">
						<div class="index-action--favorite">Mark your favorites</div>
					</div>
				</div>
				<div class="col-md-3 text-center">
					<div class="index-action" id="index-action--wishlist">
						<div class="index-action--wishlist">Add to your wishlist</div>
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
					<h3 class="Section-title no-padding">Most read</h3>
					<div class="book-cards">
						<div class="row" id="most-read">
						</div>
					</div>
				</div>
				
				<!-- Main stuff -->
				<div class="col-md-8 col-md-pull-4">
					<h3 class="Section-title no-padding">What is going on?</h3>
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
	
	$('#index-action--prologo').click(function() { displayIndexModal("Write a prologue", "Which book would you like to write a prologue about?"); });
	$('#index-action--favorite').click(function() { displayIndexModal("Find you favorites", "Which is your favorite book?"); });
	$('#index-action--reading').click(function() { displayIndexModal("Share your readings", "Which book are you reading?"); });
	$('#index-action--wishlist').click(function() { displayIndexModal("Add to your wishlist", "What book would you like to add?"); });
});

function displayIndexModal(header, message) {
	$('#index-modal--header').html(header);
	$('#index-modal--text').html(message);
	$('#index-modal').modal('show');
}

</script>
