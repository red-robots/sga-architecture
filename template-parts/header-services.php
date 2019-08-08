<?php
	// $p_args = array('taxonomy'=>'portfolio_categories','parent'=>0,'hide_empty'=>false); 
	// $portfolio_categories = get_categories($p_args); 
	$args = array(
		'posts_per_page'   => -1,
		'post_type'        => 'services',
		'post_status'      => 'publish'
	);
	$portfolio_categories = get_posts($args);
?>
<div class="top-info">
	<div class="wrapper">
		<?php if ($portfolio_categories) { ?>
			<ul class="cats">
			<?php foreach ($portfolio_categories as $p) { 
				$id = $p->ID;
				$pname = $p->post_title;
				$slug = $p->post_name;
				//$link = get_term_link($cat); 
				$link = get_permalink($id);
				//$link = get_site_url() . '/services/#' . $slug;
				?>
				<li><a href="<?php echo $link ?>"><?php echo $pname; ?></a></li>
			<?php } ?>
			</ul>
		<?php } ?>
	</div>
</div>