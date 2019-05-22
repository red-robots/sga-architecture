<?php
$page_id = get_homepage_id();
$banner = get_field('image',$page_id);
$tagline = get_field('tagline',$page_id);
if($banner) { ?>
<div class="hero clear">
	<?php if ($tagline) { ?>
	<div class="caption">
		<div class="text"><?php echo $tagline?></div>
	</div>
	<?php } ?>
	<div class="h-image" style="background-image:url('<?php echo $banner['url'] ?>');"></div>
</div>
<?php } ?>