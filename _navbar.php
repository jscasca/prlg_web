<?php
include 'php/commons.php';
echo "<script type='text/javascript'>var loggedIn = ".(isset($_SESSION[SID])?"true":"false").";</script>";
?>
<nav role="navigation" class="navbar navbar-custom navbar-default navbar-fixed-top">
	<div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand-image"><img src="img/prologes.png" class="navlogo"/></a>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse">
            
            <ul class="nav navbar-nav navbar-right">
                <!-- NOT LOGGED IN -->
                <?php	if(!isset($_SESSION[SID])) { ?>
					<li><a href="login.php">Inicia Session</a></li>
				<!-- LOGGED IN -->
				<?php	} else { ?>
					<!--<li><a href="#">Perfil</a></li>	
					<li><a href="#">Seguidores</a></li>	-->
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<div class="user-header">
								<div class="user-profile-pic">
									<!--<img src="img/defaultUser.png" class="" />-->
								</div>
								<div class="user-display-name">Tin Kalzetin</div>
							</div>
							<!--<img src="img/defaultUser.png" class="profile-pic" />!-->
							<!--Tin Kalzetin-->
						</a>
						<ul role="menu" class="dropdown-menu">
							<li><a href="profile.php">Mi perfil</a></li>
							<li><a href="logout.php">Salir</a></li>
						</ul>
					</li>	
				<?php	} ?>
            </ul>
            
            <form role="search" class="navbar-form navbar-right" action="search.php">
                <div class="input-group">
                    <input type="text" placeholder="Search" name="q" class="form-control">
                    <div class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<i class="glyphicon glyphicon-search"></i>
						</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </nav>
