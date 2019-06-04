<?php
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$args = array(
	'posts_per_page'   => 12,
	'post_type'        => 'portfolio',
	'post_status'      => 'publish',
	'paged'			   => $paged
);
$posts = new WP_Query($args);
if ( $posts->have_posts() ) {  ?>
<div class="project-list">
	<div class="masonry-wrapper">
	<?php while ( $posts->have_posts() ) : $posts->the_post();  ?>
		<div class="proj-info masonry-item">
			<?php if ( has_post_thumbnail() ) { ?>
				<?php 
				$post_id = get_the_ID();
				$post_thumbnail_id = get_post_thumbnail_id( $post_id );
				$img = wp_get_attachment_image_src($post_thumbnail_id,'medium_large'); 
				$pagelink = get_permalink();
				?>
				<a class="info" href="<?php echo $pagelink ?>"><span class="proj-image" style="background-image:url('<?php echo $img[0]?>');"></span></a>
			<?php } ?>
		</div>
	<?php endwhile; wp_reset_postdata(); ?>
	</div>
</div>
<?php } ?>