<?php
/**
 * Template Name: About
 */

get_header(); ?>

<div id="primary" class="full-content-area aboutpage">
	<main id="main" class="site-main clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<div class="wrapper">
				<h1 class="head1" style="display:none;"><?php the_title(); ?></h1>
				<div class="middle-content">
					<?php the_content(); ?>
				</div>
			</div>

			<?php  
				$row3_image = get_field('row3_image');
				$row3_text = get_field('row3_text');
				$articles = get_field('articles');
				$imgStyle = ($row3_image) ? ' style="background-image:url('.$row3_image['url'].')"':'';
			?>
			<?php if ($row3_image || $row3_text) { ?>
			<div class="row3 clear">
				<div class="flexbox clear">
					<div class="col imagecol left"<?php echo $imgStyle ?>>
						<?php if ($row3_image) { ?>
						<img src="<?php echo $row3_image['url']; ?>" alt="<?php echo $row3_image['title']; ?>" />	
						<?php } ?>
					</div>
					<div class="col textcol right">
						<div class="inside"><div class="text"><?php echo $row3_text; ?></div></div>
					</div>
				</div>
			</div>	
			<?php } ?>

			<?php $articles = get_field('articles'); ?>
			<?php if ($articles) { ?>
			<div class="bottom-articles clear">
				<div class="wrapper">
					<div class="flexbox">
						<?php foreach ($articles as $a) { 
							$image = $a['image'];
							$description = $a['description'];
							?>
							<article class="article">
								<div class="inside">
									<?php if ($image) { ?>
										<div class="feat-image">
											<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>" />
										</div>
									<?php } ?>
									<?php if ($description) { ?>
										<div class="description">
											<?php echo $description ?>
										</div>
									<?php } ?>
								</div>
							</article>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>

		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
