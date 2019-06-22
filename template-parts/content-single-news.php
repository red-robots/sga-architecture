<div class="col-left">
	<?php  
	$year = get_the_date('Y');
	$year_archives = get_site_url().'/'.$year.'/';
	?>
	<div class="head1 single-title">
		<a href="<?php echo get_site_url() ?>/news/">News</a> <span class="sep">&ndash;</span>
		<a href="<?php echo $year_archives; ?>"><?php echo $year ?></a> <span class="sep">&ndash;</span>
		<span class="current"><?php echo get_the_title(); ?></span>	
	</div>
	<?php get_template_part('template-parts/news-categories'); ?>
</div>
<div class="col-right">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php  
			$postId = get_the_ID();
			$thumbnail_id = get_post_thumbnail_id( $postId );
			$pImg = wp_get_attachment_image_src($thumbnail_id,'medium_large');
		?>

		<?php if ( $pImg ) { ?>
		<div class="single-post-Image"><?php the_post_thumbnail(); ?></div>
		<?php } ?>

		<div class="post-content">
			<header class="post-header"><h1><?php the_title(); ?></h1> <span class="post-date">(<?php echo get_the_date('m/d/Y'); ?>)</span></header>
			<?php the_content(); ?>
		</div>
	<?php endwhile; ?>
</div>