<?php
$page_id = get_homepage_id();
$banners = get_field('slider_image',$page_id);
$tagline = get_field('tagline',$page_id);
$count = ($banners) ? count($banners) : 0;
$slideClass = ($count>1) ? 'slideshow':'no-slide';
if($banners) { ?>
<div class="slides-wrap <?php echo $slideClass ?>">
 	<ul class="sliders">
	<?php foreach ($banners as $b) { 
		$id = $b['ID'];
		$url = get_field("weburl",$id);
		$part = ($url) ? parse_external_url($url) : '';
		?>
		<li class="slide">
			<div class="slide-image" style="background-image:url('<?php echo $b['url'] ?>');">
				<?php if ($url) { ?>
					<a href="<?php echo $url ?>" target="<?php echo $part['target'] ?>" class="slideURL <?php echo $part['class'] ?>">
						<img src="<?php echo $b['sizes']['medium'] ?>" alt="<?php echo $b['title'] ?>" style="display:none;">
					</a>
				<?php } ?>
				
			</div>
		</li>
	<?php } ?>
	</ul>
</div>
<?php } ?>