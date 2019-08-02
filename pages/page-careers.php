<?php
/**
 * Template Name: Careers
 *
 */

get_header('careers'); ?>
<div id="primary" class="full-content-area careers-content">
	<?php  
	$placeholder = get_field('video_thumbnail');
	$style = ($placeholder) ? ' style="background-image:url('.$placeholder['url'].')"' : ''; 
	$video_mp4 = get_field('video_mp4');
	$video_ogg = get_field('video_ogg');
	?>
	<div class="video-wrapper"<?php echo $style ?>>
		<?php if ($video_mp4 || $video_ogg) { ?>
			<div id="vidwrap" class="videowrap">
				<video id="video" width="400" height="300" muted playsinline loop>
					<?php if ($video_mp4) { ?><source src="<?php echo $video_mp4; ?>" type="video/mp4"><?php } ?>
					<?php if ($video_ogg) { ?><source src="<?php echo $video_ogg; ?>" type="video/ogg"><?php } ?>
					<p>Your browser doesn't support HTML5 video. <a href="<?php echo $video_mp4; ?>">Download</a> the video instead.
					</p>
				</video>
			</div>
			<div id="video-controls">
			    <button type="button" id="play-pause" class="pause">Play</button>
			</div>
		<?php } ?>
	</div>
	<header class="pageheader">
		<div id="titlewrap" class="wrapper"><h1><?php echo get_the_title(); ?></h1></div>
		<span class="sidehline left"></span>
	</header>
	<main id="main" class="site-main clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'page' ); ?>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
