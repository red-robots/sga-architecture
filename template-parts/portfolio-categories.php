<?php
$taxonomy = 'portfolio_categories';
$page_parent_cat = 0;
if( is_single() ) {
	global $post;
	$page_id = $post->ID;
	$terms = get_the_terms($page_id,$taxonomy);
	if($terms) {
		foreach($terms as $tm) {
			$p_term_id = $tm->term_id;
			if($tm->parent==0) {
				$page_parent_cat = $p_term_id;
				break;
			}
		}
	}
}

if( is_archive() ) {
	$obj =  get_queried_object(); 
	$page_parent_cat = ( isset($obj->term_id) && $obj->term_id ) ? $obj->term_id:0;
}

$args = array(
		'taxonomy'=> $taxonomy,
		'hide_empty'=> true,
		'parent'=>0
	);
$categories = get_categories($args);

if($categories) { ?>
<div class="portfolio-categories">
	<ul class="categories">
		<li class="mobile-cat-label"><a id="mobileCatSelect" href="#"><span class="txt">Categories <span class="icon"><i class="fas fa-caret-down"></i></span></span></a></li>
	<?php foreach ($categories as $cat) { 
		$term_id = $cat->term_id;
		$catname = $cat->name;
		$catlink = get_term_link($cat);
		$children = get_term_children( $term_id, $taxonomy );
		$is_active = ($term_id==$page_parent_cat) ? ' active':'';
		?>
		<li id="catid-<?php echo $term_id?>" class="catlink<?php echo $is_active?>">
			<a class="parent" href="<?php echo $catlink ?>"><?php echo $catname ?></a>
			<?php if ($children) { ?>
				<ul class="children">
					<?php foreach ($children as $ch) { 
					$cterm = get_term_by( 'id', $ch, $taxonomy );
					if( $cterm->count > 0 ) {
						$child_term_id = $cterm->term_id;
						$child_catname = $cterm->name;
						$child_link = get_term_link($cterm); 
						$is_active = ($child_term_id==$page_parent_cat) ? ' active':''; ?>
						<li id="catid-<?php echo $child_term_id?>" class="childcatlink<?php echo $is_active?>"><a class="child" href="<?php echo $child_link ?>"><span><?php echo $child_catname ?></span></a></li>	
						<?php } ?>
					<?php } ?>
				</ul>
			<?php } ?>
		</li>
	<?php } ?>
	</ul>
</div>
<?php } ?>