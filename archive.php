<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

get_header(); ?>
<div id="primary" class="full-content-area margintop portfolio-content">
	<main id="main" class="site-main clear" role="main">
		<?php if ( have_posts() ) { ?>
			<div class="col-left">
				<?php the_archive_title( '<h1 class="head1">', '</h1>' ); ?>
				<?php get_template_part('template-parts/news-categories'); ?>
			</div>
		<?php } ?>
		<div class="col-right">
			<?php get_template_part('template-parts/content','news') ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
