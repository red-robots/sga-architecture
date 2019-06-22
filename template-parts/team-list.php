<?php
$args = array(
	'posts_per_page'=> -1,
	'post_type'		=> 'team',
	'post_status'	=> 'publish'
);
$teams = new WP_Query($args);
if ( $teams->have_posts() ) {  ?>
<div class="col-sidebar portfolio-categories">
	<ul class="links categories">
		<li class="mobile-cat-label"><a id="mobileCatSelect" href="#"><span class="txt">The Team <span class="icon"><i class="fas fa-caret-down"></i></span></span></a></li>
	<?php while ( $teams->have_posts() ) : $teams->the_post();  ?>
		<li class="catlink link"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
	<?php endwhile; wp_reset_postdata(); ?>
	</ul>
</div>
<?php } ?>