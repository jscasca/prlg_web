<?php

?>
<html lang="es">
<head>
	<?php
	include("templates/__header.php");
	?>
	<title><?php echo getTranslation('This page is in construction'); ?></title>
</head>
<body class="body-background">
	<div class="full-body construction">
		<section class="centered-section clear">
			<div class="header">
				<a href="<?php echo BASE_DIR; ?>index"><img src="<?php echo $rootpath;?>img/prologes.png" /></a>
			</div>
			<div class="content">
				<h3><?php echo getTranslation('This area is still under construction'); ?></h3>
				<h5><?php echo getTranslation('We are sorry for the inconvenience and we are working to have this back online as soon as possible'); ?></h5>
				<h5><a href="<?php echo BASE_DIR; ?>index"><?php echo getTranslation('Take me back'); ?></a></h5>
			</div>
		</section>
	</div>
</body>
</html>