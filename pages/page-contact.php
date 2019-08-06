<?php
/**
 * Template Name: Contact
 *
 */

get_header(); ?>
<div id="primary" class="full-content-area contact-page default-temp">
	<main id="main" class="site-main content-with-sb clear" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			
			<div class="col-left">
				<h1 class="head1"><?php the_title(); ?></h1>
				<?php
				$args = array(
					'posts_per_page'=> -1,
					'post_type'		=> 'locations',
					'post_status'	=> 'publish'
				);
				$locations = get_posts($args);
				if ( $locations ) {  ?>
				<ul class="sblocations categories">
					<li class="mobile-cat-label"><a id="mobileCatSelect" href="#"><span class="txt">Locations<span class="icon"><i class="fas fa-caret-down"></i></span></span></a></li>
					<?php $i=1; foreach ($locations as $e) { 
					$p_id = $e->ID;
					$name = $e->post_title;
					$gmap = get_field('googlemap',$p_id);
					$address = get_field('address',$p_id);
					$phone = get_field('phone',$p_id); 
					$target = ($gmap) ? ' target="_blank"':'';
						if($name) { ?>
						<li class="catlink<?php echo ($i==1) ? ' first':'';?>">
							<a class="name" href="<?php echo $gmap ?>"<?php echo $target ?>><span class="xcon"><i class="fas fa-map-marker-alt"></i></span><?php echo $name ?></a>
							<?php if ($address) { ?>
							<address><?php echo $address ?></address>	
							<?php } ?>
							<?php if ($phone) { ?>
							<div class="phone">TEL: <a href="tel:<?php echo format_phone_number($phone);?>"><?php echo $phone ?></a></div>	
							<?php } ?>
						</li>
						<?php $i++; } ?>
					<?php } ?>
				</ul>
				<?php } ?>
			</div>
			

			<?php  
				$map = get_field('map');
				$column1_title = get_field('column1_title');
				$column1_text = get_field('column1_text');
				$column2_title = get_field('column2_title');
				$column2_text = get_field('column2_text');
			?>

			<div class="col-right <?php echo ($map) ? 'hasmap':'nomap';?>">
				<?php if ($map) { ?>
				<div class="map-wrapper clear"><?php echo $map; ?></div>	
				<?php } ?>
			
				<?php if ($column1_title || $column1_text) { ?>
				<div class="coltxt col1">
					<?php if ($column1_title) { ?>
					<h2 class="ctitle"><?php echo $column1_title ?></h2>	
					<?php } ?>
					<?php if ($column1_text) { ?>
					<div class="ctext"><?php echo $column1_text ?></div>	
					<?php } ?>
				</div>
				<?php } ?>

				<?php if ($column2_title || $column2_text) { ?>
				<div class="coltxt col2">
					<?php if ($column2_title) { ?>
					<h2 class="ctitle"><?php echo $column2_title ?></h2>	
					<?php } ?>
					<?php if ($column2_text) { ?>
					<div class="ctext"><?php echo $column2_text ?></div>	
					<?php } ?>
				</div>
				<?php } ?>

			</div>

		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
