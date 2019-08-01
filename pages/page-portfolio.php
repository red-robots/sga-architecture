<?php
/**
 * Template Name: Portfolio
 */

get_header(); ?>

<div id="primary" class="full-content-area margintop portfolio-content">
	<main id="main" class="site-main clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
		
		<?php endwhile; ?>
		<div class="projcategories">
		<?php  
			$taxonomy = 'portfolio_categories';
			$args = array(
				'taxonomy'=> $taxonomy,
				'hide_empty'=> true,
				'parent'=>0
			);
			$categories = get_categories($args); 
			if($categories) { ?>
			<div class="catflex clear">
				<?php foreach ($categories as $term) { 
				$catname = $term->name;
				$catlink = get_term_link( $term, $taxonomy );
				$img = get_field('catimage', $term);
        		if($img) {
        			$img_src = $img['url'];
        			$styles = ' style="background-image:url('.$img_src.')"';
        		} else {
        			$img_src = '';
        			$styles = '';
        			//$img_src = get_bloginfo('template_url').'/images/coming-soon-white.jpg';
        		} 
        		$square = get_bloginfo('template_url').'/images/px2.png';
        		?>
				<div class="category">
					<a href="<?php echo $catlink ?>" class="link">
						<img src="<?php echo $square ?>" alt="" aria-hidden="true" />
						<span class="catname"><?php echo $catname; ?></span>
						<span class="bg"<?php echo $styles ?>></span>
					</a>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
