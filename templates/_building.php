<?php

?>
<html lang="es">
<head>
	<?php
	include("templates/__header.php");
	?>
	<title><?php echo getTranslation('This page is in construction'); ?></title>
</head>
<body class="body-fullWidth">
	
	<section class="Building text-center">
		<div class="Building-header">
			<a href="index"><img src="<?php echo $rootpath;?>img/prologes.png" /></a>
		</div>
		<div class="Building-container">

		<h3><?php echo getTranslation('This area is still under construction'); ?></h3>
		<h5><?php echo getTranslation('We are sorry for the inconvenience and we are working to have this back online as soon as possible'); ?></h5>
		<h5><a href="index"><?php echo getTranslation('Take me back'); ?></a></h5>
		</div>
	</section>

</body>
</html>