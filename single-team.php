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
			<h2 class="head1">Meet Our Team</h2>
			<?php get_template_part('template-parts/team-list'); ?>
		</div>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="col-right block-info">
			<?php  
			$photo = get_field('photo');
			$photo_alt = ($photo) ? $photo['title']:'';
			$photoSrc = ($photo) ? $photo['url'] : get_bloginfo('template_url') .'/images/nophoto.jpg';
			$job_title = get_field('job_title');
			$contact = get_field('contact');
			$office_phone = ( isset($contact['office']) && $contact['office'] ) ? $contact['office'] : '';
			$cell = ( isset($contact['cell']) && $contact['cell'] ) ? $contact['cell'] : '';
			$fax = ( isset($contact['fax']) && $contact['fax'] ) ? $contact['fax'] : '';
			$email = ( isset($contact['email']) && $contact['email'] ) ? $contact['email'] : '';
			$contactArrs = array($office_phone,$cell,$fax,$email);
			$has_contact = ($contactArrs && array_filter($contactArrs)) ? true : false;
			?>
			<?php if ($photo) { ?>
			<div class="photo">
				<img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['title']; ?>" />
			</div>	
			<?php } ?>
			<div class="infotext <?php echo ($photo) ? 'half':'full'?>">
				<h1 class="pagetitle">
					<?php the_title(); ?>
					<?php if ($job_title) { ?>
					<span class="jobtitle"><?php echo $job_title ?></span>	
					<?php } ?>
				</h1>
				<?php the_content(); ?>
				<?php if ( $has_contact ) { ?>
				<div class="contact-details">
					<div class="greentxt">Contact:</div>
					<?php if ($office_phone) { ?>
					<div class="contact">Office: <a href="tel:<?php echo format_phone_number($office_phone); ?>"><?php echo $office_phone ?></a></div>	
					<?php } ?>
					<?php if ($cell) { ?>
					<div class="contact">Cell: <a href="tel:<?php echo format_phone_number($cell); ?>"><?php echo $cell ?></a></div>	
					<?php } ?>
					<?php if ($fax) { ?>
					<div class="contact">Fax: <a href="tel:<?php echo format_phone_number($fax); ?>"><?php echo $fax ?></a></div>	
					<?php } ?>
					<?php if ($email) { ?>
					<div class="contact"><a href="mailto:<?php echo antispambot($email,1); ?>"><?php echo $email ?></a></div>	
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
