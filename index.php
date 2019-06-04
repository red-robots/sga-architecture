<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

get_header(); ?>
<div id="primary" class="full-content-area clear homecontent">
	<main id="main" class="site-main clear" role="main">
		<?php
		$home_page_id = get_homepage_id();
		$post = get_post($home_page_id);
		if ( $post ) {  setup_postdata($post); ?>
			<?php if ( $tagline = get_field('tagline') ) { ?>
			<div class="tagline text-center"><?php echo $tagline ?></div>	
			<?php } ?>
			<div class="two-columns">
				<div class="flexrow clear">
					<div class="flexbox col1">
						<?php 
						$title = get_field('title'); 
						$about_description = get_field('about_description'); 
						?>
						<?php if ($title) { ?>
						<h2 class="section-title"><?php echo $title ?></h2>	
						<?php } ?>
						<?php if ($about_description) { ?>
						<div class="section-text"><?php echo $about_description ?></div>	
						<?php } ?>
					</div>

					<div class="flexbox col2">
						<?php 
						$disciplines_title = get_field('disciplines_title'); 
						$disciplines = get_field('disciplines'); 
						?>
						<?php if ($disciplines_title) { ?>
						<h2 class="section-title text-center"><?php echo $disciplines_title ?></h2>	
						<?php } ?>
						<?php if ($disciplines) { ?>
						<div class="section-text">
							<ul class="disciplines">
								<?php foreach ($disciplines as $d) { 
								$icon = $d['icon'];
								$text = $d['discipline']; ?>
								<li>
									<?php if ($icon) { ?>
									<div class="dicon"><span class="icon" style="background-image:url('<?php echo $icon['url'] ?>');"></span></div>	
									<?php } ?>
									<?php if ($text) { ?>
									<div class="dtext"><?php echo $text ?></div>	
									<?php } ?>
								</li>	
								<?php } ?>
							</ul>
						</div>	
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
