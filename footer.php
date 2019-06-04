	</div><!-- #content -->

	<?php
	$locations = get_field('locations','option');
	?>
	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="wrapper">
			<div class="col left locations-list">
				<?php if ($locations) { ?>
					<div class="foot-title">Locations</div>
					<div class="locations">
						<div class="flexrow clear">
							<?php foreach ($locations as $e) { 
							$loc = $e['location'];
							$address = $e['address'];
							$telephone = $e['telephone'];
							?>
							<div class="loc flexbox">
								<?php if ($loc) { ?>
								<div class="name"><?php echo $loc ?></div>	
								<?php } ?>
								<?php if ($address) { ?>
								<address class="address"><?php echo $address ?></address>	
								<?php } ?>
								<?php if ($telephone) { ?>
								<div class="telephone"><a href="tel:<?php echo format_phone_number($telephone); ?>"><?php echo $telephone ?></a></div>	
								<?php } ?>
							</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="col right">
				<div class="fwrap clear">
					<div class="social-links">
						<div class="foot-title">Follow Us</div>
						<?php  
						$email = get_field('email','option');
						$social[] = array('linkedin','fab fa-linkedin');
						$social[] = array('facebook','fab fa-facebook-square');
						$social[] = array('instagram','fab fa-instagram');
						$social[] = array('twitter','fab fa-twitter-square');
						$i=1; foreach ($social as $s) { 
							$social_link = get_field( $s[0],'option' );
							$social_icon = $s[1];
							?>
							<?php if ($social_link) { ?>
							<a class="social<?php echo($i==1) ? ' first':'';?>" href="<?php echo $social_link ?>" target="_blank">
								<span class="icon"><i class="<?php echo $social_icon ?>"></i><span class="sr-only"><?php echo $s[0]; ?></span></span>
							</a>
							<?php $i++; } ?>
						<?php } ?>
					</div>
				</div>
				<?php if ($email) { ?>
				<div class="enquiry-email"><a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a></div>	
				<?php } ?>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
