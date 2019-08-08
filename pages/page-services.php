<?php
/**
 * Template Name: Services
 *
 */

get_header(); ?>
<div id="primary" class="full-content-area services-page">
	<main id="main" class="site-main clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<h1 style="display:none;"><?php the_title(); ?></h1>
			<?php  $services = get_field('services'); ?>
			<?php if ($services) { ?>
			<div class="services-info">
				<?php $i=1; foreach ($services as $s) { 
					$class = ($i%2) ? 'even':'odd'; 
					$info = $s['content'];
					$page_title = ($info) ? $info->post_title:'';
					$title = ($s['custom_title']) ? $s['custom_title'] : $page_title;
					if($info && $title) { 
						$id = $info->ID;
						$slug = $info->post_name;
						$text = $info->post_content;
						$text = apply_filters('the_content',$text);
						$thumbId = get_post_thumbnail_id($id);
						$img = wp_get_attachment_image_src($thumbId,'full');
						$style = ($img) ? ' style="background-image:url('.$img[0].')"':''; ?>
						<div id="<?php echo $slug ?>" class="svrow <?php echo $class ?>">
							<h3 class="title"><span><?php echo $title ?></span></h3>
							<div class="flexbox">
								<div class="fbox imagecol"<?php echo $style ?>>
									<?php if ($img) { ?>
										<img src="<?php echo $img[0] ?>" alt="" />
									<?php } ?>
								</div>
								<div class="fbox textcol">
									<div class="text"><?php echo $text; ?></div>
								</div>
							</div>
						</div>	
					<?php } ?>
				<?php $i++; } ?>
			</div>	
			<?php } ?>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
