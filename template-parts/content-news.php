<?php 
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
//$posts_per_page = ( get_field('pagenum','option') ) ? get_field('pagenum','option') : 12;
$posts_per_page = 9;
$postType = 'post';
$date_query = [];
$latest_post_id = 0;

/* Latest post */
if( is_archive() ) {

	$args = array(
		'posts_per_page'=> $posts_per_page,
		'post_type'		=> $postType,
		'post_status'	=> 'publish',
		'paged'			=> $paged
	);

	$year     = get_query_var('year');
	$monthNum = get_query_var('monthnum');

	if( $year && $monthNum ) {
		$date_query = [
	        [
	            'year'  => $year,
	            'month' => $monthNum
	        ]
	    ];
	} else {
		$date_query = [
	        [
	            'year'  => $year
	        ]
	    ];
	}
    $args['date_query'] = $date_query;
    
} else {

	$args1 = array(
		'posts_per_page'=> 1,
		'orderby'		=> 'date',
		'order'			=> 'DESC',
		'post_type'		=> $postType,
		'post_status'	=> 'publish',
		'suppress_filters' => true
	); 
	$singlePost = get_posts($args1);
	$latest_post_id = ($singlePost) ? $singlePost[0]->ID : 0;

	$args = array(
		'posts_per_page'=> $posts_per_page,
		'post_type'		=> $postType,
		'post_status'	=> 'publish',
		'post__not_in'	=> array($latest_post_id),
		'paged'			=> $paged
	);
}


$theposts = new WP_Query($args);
if ( $theposts->have_posts() ) {  ?>
<div class="post-listings clear">
	<?php  
	if ($latest_post_id) {
		$latestPost = get_post($latest_post_id);
		$latest_post_title = $latestPost->post_title;
		$post_thumbnail_id = get_post_thumbnail_id( $latest_post_id );
		$img = wp_get_attachment_image_src($post_thumbnail_id,'medium_large');
		$placeholderImage = get_bloginfo('template_url').'/images/coming-soon-white.jpg'; 
		$latest_content = $latestPost->post_content;
		$content = strip_shortcodes($latest_content);
		$content = preg_replace("/<img[^>]+\>/i", " ", $latest_content);          
		$content = str_replace(']]>', ']]>', $content);
		$excerpt = ($content) ? shortenText($content,520) : '';
		$latest_post_link = get_permalink($latest_post_id);
		?>
		<?php if ($paged<2) { ?>
			<?php if( !is_archive() ) { ?>
			<div class="lastest_post_image clear">
				<?php if ($img) { ?>
					<div class="featImage" style="background-image:url('<?php echo $img[0] ?>');"><img style="display:none;" src="<?php echo $img[0] ?>" alt="<?php echo $latest_post_title;?>" /></div>
				<?php } else { ?>
				<div class="placeholder" style="background-image:url('<?php echo $placeholderImage ?>')"></div>
				<?php } ?>
				<div class="last-post-excerpt">
					<h2 class="title"><?php echo $latest_post_title ?></h2>
					<div class="excerpt">
						<?php if ($excerpt) { ?>
							<?php echo $excerpt; ?>
							<div class="buttondiv"><a class="readmore" href="<?php echo $latest_post_link ?>">Read More &gt;</a></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
	<?php } ?>

	<div class="post-items-wrap clear">
		<div class="itemrows clear">
			<div class="flexrow">
			<?php while ( $theposts->have_posts() ) : $theposts->the_post();  ?>
				<?php  
				$postId = get_the_ID();
				$thumbnail_id = get_post_thumbnail_id( $postId );
				$pImg = wp_get_attachment_image_src($thumbnail_id,'medium_large');
				$placeholderImage2 = get_bloginfo('template_url').'/images/coming-soon.jpg'; 
				$pImageSrc = ($pImg) ? $pImg[0] : $placeholderImage2;
				$pcontent = get_the_content();
				$pcontent = strip_shortcodes($pcontent);
				$pcontent = strip_tags($pcontent);
				$pcontent = preg_replace("/<img[^>]+\>/i", " ", $pcontent);          
				$pcontent = str_replace(']]>', ']]>', $pcontent);
				$pcontent = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $pcontent);
				$pexcerpt = ($pcontent) ? shortenText($pcontent,80) : '';
				?>
				<a class="post-item-block" href="<?php echo get_permalink(); ?>">
					<span class="wrap">
						<?php if ($pImg) { ?>
						<span class="image clear <?php echo ($pImg) ? 'has-image': 'no-image';?>"><span class="thumb" style="background-image:url('<?php echo $pImageSrc ?>');"></span><img style="display:none;" class="feat" src="<?php echo $pImageSrc ?>" alt="<?php echo get_the_title() ?>" /></span>					
						<?php } ?>
						<span class="post-excerpt clear">
							<span class="ptitle clear">
								<span class="title"><?php echo get_the_title(); ?></span>
								<span class="date"><?php echo get_the_date('m/d/y'); ?></span>
							</span>
							
							<?php if ($pexcerpt) { ?>
								<?php echo $pexcerpt; ?>
								<span class="readmore clear">Read More &gt;</span>
							<?php } ?>
						</span>
					</span>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
			</div>
		</div>

		<?php
	    $total_pages = $theposts->max_num_pages;
	    if ($total_pages > 1){ ?>
	        <div id="pagination" class="pagination-links clear">
	            <?php
	                $pagination = array(
	                    'base' => @add_query_arg('pg','%#%'),
	                    'format' => '?paged=%#%',
	                    'current' => $paged,
	                    'total' => $total_pages,
	                    'prev_text' => __( '&laquo;', 'red_partners' ),
	                    'next_text' => __( '&raquo;', 'red_partners' ),
	                    'type' => 'plain'
	                );
	                echo paginate_links($pagination);
	            ?>
	        </div>
	        <?php
	    }
	    ?>
	</div>
</div>
<?php } ?>