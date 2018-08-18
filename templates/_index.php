<?php

?>
<!-- Modal to search for books -->
<div id="index-modal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="search">
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

<!-- Main -->
<?php
if(!$loggedIn) {
?>
	<div class="row">
		<div class="welcome">
			<!-- inicia sesion o registrate -->
			<div class="col-md-4">
				<div class="welcome-padding-top-left"></div>
				<div class="welcome-login text-center">
					<h5><?php echo getTranslation('Not a member?'); ?></h5>
					<a href="register"><?php echo getTranslation('Sign up!'); ?></a>
					<h4><?php echo getTranslation('Already have an account?'); ?></h4>
					<a href="login"><?php echo getTranslation('Log in'); ?></a>
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
<?php
}
?>
<div class="row">	
	<div class="index-search">
		<form class="" action="search">
			<div class="input-group">
				<input class="form-control" id="index-search--field" type="text" name="q" placeholder="Find your next book" />
				<div class="input-group-btn">
					<button class="btn btn-default" id="index-search--submit" type="submit">
						<i class="glyphicon glyphicon-search"></i>
					</button>
				</div>
			</div>
			
		</form>
	</div>
</div>
<script type="text/javascript">
	//Load stuff here
	setTimeout(function(){console.log('load index');}, 3000);
</script>