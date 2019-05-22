<?php
/**
 * The header for theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bellaworks
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site clear">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>

	<header id="masthead" class="site-header clear" role="banner">
		<div class="wrapper">
			<div class="left">
				<?php if( get_custom_logo() ) { ?>
					<?php if ( is_home() ) { ?>
						<h1 class="logo">
			            	<?php the_custom_logo(); ?>
			            </h1>
					<?php } else { ?>
						<div class="logo">
			            	<?php the_custom_logo(); ?>
			            </div>
					<?php } ?>
		        <?php } else { ?>
		            <div class="logo">
			            <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>
		            </div>
		        <?php } ?>
	        </div>

	        <div class="right">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<span id="toggleMenu" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span><i aria-label="Menu"></i></span></span>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container_class'=>'main-menu-wrapper','link_before'=>'<span>','link_after'=>'</span>' ) ); ?>
				</nav><!-- #site-navigation -->
			</div>
		</div><!-- wrapper -->
	</header><!-- #masthead -->

	<?php 
		if ( is_home() || is_front_page() ) {
			get_template_part('template-parts/banner','home'); 
		}
	?>

	<div id="content" class="site-content wrapper clear">
