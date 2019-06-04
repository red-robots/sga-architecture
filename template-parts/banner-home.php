<?php
$page_id = get_homepage_id();
$banners = get_field('slider_image',$page_id);
$tagline = get_field('tagline',$page_id);
$count = ($banners) ? count($banners) : 0;
$slideClass = ($count>1) ? 'slideshow':'no-slide';
if($banners) { ?>
<div class="slides-wrap <?php echo $slideClass ?>">
 	<ul class="sliders">
	<?php foreach ($banners as $b) { ?>
		<li class="slide">
			<div class="slide-image" style="background-image:url('<?php echo $b['url'] ?>');"></div>
		</li>
	<?php } ?>
	</ul>
</div>
<?php } ?>