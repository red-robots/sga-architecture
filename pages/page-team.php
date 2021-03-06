<?php
/**
 * Template Name: Team
 *
 */

get_header(); ?>
<div id="primary" class="full-content-area default-temp">
	<main id="main" class="site-main clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
		<?php endwhile; ?>

		<?php
		$args = array(
			'posts_per_page'=> -1,
			'post_type'		=> 'team',
			'post_status'	=> 'publish'
		);
		$teams = new WP_Query($args);
		if ( $teams->have_posts() ) {  ?>
		<div class="the-team clear">
			<div class="flexrow">
			<?php while ( $teams->have_posts() ) : $teams->the_post(); 
				$name = get_the_title();
				$photo = get_field('photo');
				$photo_alt = ( isset($photo['title']) && $photo['title'] ) ? $photo['title']:'';
				$photoSrc = ( isset($photo['url']) && $photo['url'] ) ? $photo['url'] : get_bloginfo('template_url') .'/images/nophoto.jpg';
				?>
				<div class="flexbox info">
					<div class="inside">
						<a class="photodiv clear" href="<?php echo get_permalink(); ?>" style="background-image:url('<?php echo $photoSrc ?>');">
							<img class="team-photo" src="<?php echo $photoSrc ?>" alt="<?php echo $photo_alt ?>" />
							<img src="<?php echo get_bloginfo('template_url') ?>/images/px.png" alt="" aria-hidden="true" />
						</a>
						<div class="name clear">
							<h3><?php echo $name ?></h3>
							<a class="link" href="<?php echo get_permalink(); ?>">Profile <span>&gt;</span></a>
						</div>
					</div>
				</div>
			<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
		<?php } ?>


	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
