<?php
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
      <a href="<?php echo $rootpath;?>index" class="navbar-brand-image"><img class="navlogo logo" src="<?php echo $rootpath;?>img/prologes.png" class="navlogo"/></a>
    </div>
    <!-- Collection of nav links, forms, and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class='dropdown'>
          <a data-toggle='dropdown' class='dropdown-toggle' href='#'>
            <div class='lang-selector'>
              <?php echo getTranslation('LANG'); ?>
            </div>
          </a>
          <ul role='menu' class='dropdown-menu'>
            <li>
              <a href="<?php echo $rootpath;?>lang/en">English</a>
            </li>
            <li>
              <a href="<?php echo $rootpath;?>lang/es">Español</a>
            </li>
          </ul>
        </li>

        <li>
          <!-- Search -->
          <form role="search" class="navbar-form navbar-right" action="<?php echo $rootpath;?>search">
            <div class="input-group">
              <input type="text" placeholder="Search" name="q" class="form-control input-sm">
              <span class="input-group-btn">
                <button class="btn btn-default input-sm" type="submit">
                  <span class="fas fa-search"></span>
                </button>
              </span>
            </div>
          </form>
        </li>

        <!-- NOT LOGGED IN -->
        <?php	if(!isset($_SESSION[SID])) { ?>
        <li>
          <a href="<?php echo $rootpath;?>login"><?php echo getTranslation('Log in');?></a>
        </li>
        <!-- LOGGED IN -->
        <?php	} else { ?>
        <!--<li><a href="#">Perfil</a></li>	
        <li><a href="#">Seguidores</a></li>	-->
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
          <div class="user-header">
            <!-- <div class="user-profile-pic"><img src="img/defaultUser.png" class="" /></div> -->
            <div class="user-display-name"><?php echo $_SESSION[DISPLAY_NAME]; ?></div>
          </div>
          </a>
          <ul role="menu" class="dropdown-menu">
            <li><a href="<?php echo $rootpath;?>profile"><?php echo getTranslation('Profile');?></a></li>
            <li><a href="<?php echo $rootpath;?>library"><?php echo getTranslation('Library');?></a></li>
            <!-- <li><a href="<?php echo $rootpath;?>clubs"><?php echo getTranslation('Book clubs');?></a></li> -->
            <li><a href="<?php echo $rootpath;?>logout"><?php echo getTranslation('Log out');?></a></li>
          </ul>
        </li>
        <?php	} ?>
      </ul>
    </div>
  </div>
</nav>
