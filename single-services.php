<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); 
$post_type = get_post_type();
?>

<div id="primary" class="full-content-area  single-page-content services-content">
	<main id="main" class="site-main clear" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
		<?php endwhile; ?>
		
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
