<?php
$current_term_id = 0;
$taxonomy = 'portfolio_categories';
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$posts_per_page = ( get_field('pagenum','option') ) ? get_field('pagenum','option') : 12;
$args = array(
	'posts_per_page'=> $posts_per_page,
	'post_type'		=> 'portfolio',
	'post_status'	=> 'publish',
	'paged'			=> $paged
);

if( is_archive() ) {
	$obj =  get_queried_object(); 
	$current_term_id = ( isset($obj->term_id) && $obj->term_id ) ? $obj->term_id:0;
	$args['tax_query'][] = array(
		'taxonomy'=> $taxonomy,
		'field'=>'term_id',
		'terms'=>$current_term_id
	);
}

$theposts = new WP_Query($args);
if ( $theposts->have_posts() ) {  ?>
<div class="project-list">
	<div class="masonry-wrapper">
		<div class="flexrow clear">
		<?php while ( $theposts->have_posts() ) : $theposts->the_post();  ?>
			<div class="proj-info masonry-item">
				<?php 
					$post_id = get_the_ID();
					$post_thumbnail_id = get_post_thumbnail_id( $post_id );
					$img = wp_get_attachment_image_src($post_thumbnail_id,'medium_large'); 
					$imageSrc = ($img) ? $img[0] : get_bloginfo('template_url').'/images/coming-soon.jpg';
					$pagelink = get_permalink();
					$project_name = get_the_title();
					$location = get_field('location');
					$client = get_field('client');
				?>
				<a class="proj-block" href="<?php echo $pagelink ?>">
					<span class="proj-image" style="background-image:url('<?php echo $imageSrc?>');"></span>
					<span class="caption">
						<span class="wrap">
							<span class="projname"><?php echo $project_name ?></span>
							<?php if ($location) { ?>
							<span class="location opt"><?php echo $location ?></span>
							<?php } ?>
							<?php if ($client) { ?>
							<span class="client opt"><?php echo $client ?></span>
							<?php } ?>
						</span>
					</span>
					<img class="px" src="<?php echo get_bloginfo('template_url') ?>/images/px2.png" alt="" aria-hidden="true" />
				</a>

			</div>
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
<?php } ?>