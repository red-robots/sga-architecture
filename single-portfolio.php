<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); ?>

<div id="primary" class="full-content-area margintop portfolio-content">
	<main id="main" class="site-main clear" role="main">
		<div class="col-left">
			<h1 class="head1"><?php the_title(); ?></h1>
			<?php get_template_part('template-parts/portfolio-categories'); ?>
		</div>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php 
			$post_id = get_the_ID();
			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			$img = wp_get_attachment_image_src($post_thumbnail_id,'medium_large'); 
			$altTxt = '';
			if($img) {
				//$altTxt = trim( strip_tags( get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true ) ) );
				$altTxt = trim(get_the_title($post_thumbnail_id));
			}
			$img2 = wp_get_attachment_image($post_thumbnail_id,'full','',array('class'=>'ssimage mainpic','alt'=>$altTxt));
			
			$galleries = get_field('gallery');
			$location = get_field('location');
			$client = get_field('client');
			$dimension = get_field('square_footage');
			$budget = get_field('budget');
			$projectOpts = array($location,$client,$dimension,$budget);
			$hasOptions = ($projectOpts && array_filter($projectOpts)) ? true:false;
			?>
			<div class="col-right">
				<div class="project-sliders">
					<div class="project-images<?php echo ($galleries) ? ' project-slideshow':'';?>">
						<ul class="sliders">
							<?php if ($img) { ?>
							<li class="slide main">
								<div style="display:none;" class="ps-image" style="background-image:url('<?php echo $img[0];?>')"></div>
								<span class="span-image">
									<?php echo $img2 ?>
									<?php if ($altTxt) { ?>
									<span class="imagetitle"><span class="span"><?php echo $altTxt ?></span></span>
									<?php } ?>
								</span>
							</li>	
							<?php } ?>
							<?php if ($galleries) { ?>
								<?php foreach ($galleries as $g) { 
									$image_title = $g['title'];
									$image_src = $g['url'];
									?>
									<li class="slide gallery">
										<div style="display:none;" class="ps-image" style="background-image:url('<?php echo $g['url'];?>')"></div>
										<span class="span-image">
											<img class="ssimage" src="<?php echo $image_src;?>" alt="<?php echo $image_title;?>" />
											<span class="imagetitle"><span class="span"><?php echo $image_title ?></span></span>
										</span>
									</li>
								<?php } ?>	
							<?php } ?>
						</ul>
					</div>
				</div>
				<div class="project-details">
					<div class="project-inner <?php echo ($hasOptions) ? 'two-column':'one-col';?>">
						<?php if ($hasOptions) { ?>
						<div class="projcol options">
							<?php if ($location) { ?>
							<div class="option">
								<div class="o-name">Location</div>
								<div class="o-info"><?php echo $location ?></div>
							</div>
							<?php } ?>

							<?php if ($client) { ?>
							<div class="option">
								<div class="o-name">Client</div>
								<div class="o-info"><?php echo $client ?></div>
							</div>
							<?php } ?>

							<?php if ($dimension) { ?>
							<div class="option">
								<div class="o-name">Square Footage</div>
								<div class="o-info"><?php echo $dimension ?></div>
							</div>
							<?php } ?>

							<?php if ($budget) { ?>
							<div class="option">
								<div class="o-name">Budget</div>
								<div class="o-info"><?php echo $budget ?></div>
							</div>
							<?php } ?>
						</div>
						<?php } ?>
						<div class="projcol details <?php echo ($hasOptions) ? 'half':'full';?>">
							<h1 class="projectname"><?php the_title(); ?></h1>
							<div class="entry-content"><?php the_content(); ?></div>
						</div>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
