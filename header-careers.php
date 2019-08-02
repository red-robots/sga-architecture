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
<link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site clear">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>

	<header id="masthead" class="careers-header clear" role="banner">
		<div class="wrapper">
			<div class="flexhead">
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


				<?php
					// $p_args = array('taxonomy'=>'portfolio_categories','parent'=>0,'hide_empty'=>false); 
					// $portfolio_categories = get_categories($p_args); 
					$args = array(
						'posts_per_page'   => -1,
						'post_type'        => 'services',
						'post_status'      => 'publish'
					);
					$portfolio_categories = get_posts($args);
				?>
				<div class="toplinks">
					<?php if ($portfolio_categories) { ?>
					<div class="wrap">
						<ul class="cats">
						<?php foreach ($portfolio_categories as $p) { 
							$id = $p->ID;
							$pname = $p->post_title;
							//$link = get_term_link($cat); 
							$link = get_permalink($id); ?>
							<li><a href="<?php echo $link ?>"><?php echo $pname; ?></a></li>
						<?php } ?>
						</ul>
					</div>
					<?php } ?>
				</div>
			</div>
		
			<nav id="navi2" class="careers-main-navigation" role="navigation">
				<div class="togglewrap"><a href="#" id="menutoggle2"><span class="lbl">Menu</span> <span class="burger"><span class="hl"></span></span></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container_class'=>'main-menu-wrapper') ); ?>
			</nav>
		</div><!-- .wrapper -->
	</header><!-- #masthead -->

	<?php 
		if ( is_home() || is_front_page() ) {
			get_template_part('template-parts/banner','home'); 
		}
	?>

	<div id="content" class="site-content wrapper clear">
