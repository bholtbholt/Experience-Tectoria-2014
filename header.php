<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- 
        ,@@@@@...
     ,@@@@@@@@@@@@@@..
   ,@@@@~'        `~@@@.
  @@@@                `~
 @@@@@        (_O
@@@@@@@.       /\
@@@@@@@@@..   |\_,-'   
@@@@@@@@@@@@@='~
@@@@@@@@@@@@@@@@@@@@@@@==......__
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@=...__
@@@@@@@@ SITE BY BRIANHOLT.CA @@@@@@@@@=...__
@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@=...__
-->
	<title><?php echo get_bloginfo('name'); wp_title(' | '); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,500,800' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
	<?php wp_head(); ?>
</head>
<body>

<nav id="main-nav">
	<div class="container">
		<button type="button" class="btn btn-primary visible-xs" data-toggle="collapse" data-target="#header-menu-div">MENU</button>
	  <div id="header-menu-div" class="collapse">
	    <?php wp_nav_menu( array( 'theme_location' => 'header-menu',
	                              'container' => '',
	                              'menu_id' => 'header-menu'
	    ) ); ?>
	  </div>
	</div>
</nav>