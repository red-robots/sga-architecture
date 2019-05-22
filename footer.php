	</div><!-- #content -->

	<?php
	$address = get_field('address','option');
	$phone = get_field('phone','option');
	$email = get_field('email','option');
	?>
	<footer id="colophon" class="site-footer clear" role="contentinfo">
		<div class="wrapper">
			<div class="col left company-info">
				<?php if ($address) { ?>
				<span class="address info"><?php echo $address; ?></span>	
				<?php } ?>
				<?php if ($phone) { ?>
				<span class="phone info"><a href="tel:<?php echo format_phone_number($phone); ?>"><?php echo $phone; ?></a></span>	
				<?php } ?>
				<?php if ($email) { ?>
				<span class="email info"><a href="tel:<?php echo antispambot($email,1); ?>"><?php echo $email; ?></a></span>	
				<?php } ?>
			</div>
			<div class="col right">
				<?php wp_nav_menu( array( 'menu' => 'Footer Menu', 'menu_id' => 'footer-menu','container'=>false) ); ?>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
