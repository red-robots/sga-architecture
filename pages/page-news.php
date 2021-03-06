<?php
/**
 * Template Name: News
 */

get_header(); ?>

<div id="primary" class="full-content-area margintop portfolio-content">
	<main id="main" class="site-main clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="col-left">
				<h1 class="head1"><?php the_title(); ?></h1>
				<?php get_template_part('template-parts/news-categories'); ?>
			</div>
		<?php endwhile; ?>
		<div class="col-right">
			<?php get_template_part('template-parts/content','news') ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
