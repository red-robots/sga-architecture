<?php  
$taxonomy = 'category';
$post_type = 'post';
$archives = get_posts_by_year($post_type);
$max = 10;
?>
<?php if ($archives) { ?>
<div class="portfolio-categories">
	<ul class="categories">
		<li class="mobile-cat-label"><a id="mobileCatSelect" href="#"><span class="txt">Select Year<span class="icon"><i class="fas fa-caret-down"></i></span></span></a></li>
		<?php $i=1; foreach ($archives as $a) { 
			$year = $a['year'];
			$parent_url = get_site_url().'/'.$year.'/';
			$monthList = $a['months'];
			if($i<=$max) { ?>
			<li class="catlink">
				<a class="parent" href="<?php echo $parent_url ?>"><?php echo $year ?></a>
				<?php if ($monthList) { ?>
					<ul class="children">
						<?php foreach ($monthList as $m) {
							$mNum = $m['monthNum'];
							$mName = $m['monthName'];
							$num = str_pad($mNum, 2, '0', STR_PAD_LEFT);
							$child_url = $parent_url . $num . '/';
							?>
							<li class="childcatlink"><a class="child" href="<?php echo $child_url ?>"><span><?php echo $mName ?></span></a></li>	
						<?php } ?>
					</ul>
				<?php } ?>
			</li>
			<?php } ?>
		<?php $i++; } ?>
	</ul>
</div>
<?php } ?>