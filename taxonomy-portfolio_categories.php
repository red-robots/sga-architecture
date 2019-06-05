<?php
get_header(); 
$obj =  get_queried_object(); 
$current_term_id = ( isset($obj->term_id) && $obj->term_id ) ? $obj->term_id:0;
$current_category = ( isset($obj->name) && $obj->name ) ? $obj->name:'';

$pages = get_posts(array(
  'post_type' => 'page',
  'numberposts' => -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'taxonomy-name',
      'field' => 'id',
      'terms' => 1, // Where term_id of Term 1 is "1".
      'include_children' => false
    )
  )
));

$args = array(
		'post_type' => 'page',
		'numberposts' => -1,
		'tax_query' => array(
		array(
		'taxonomy' => 'taxonomy-name',
		'field' => 'id',
		'terms' => 1, // Where term_id of Term 1 is "1".
		'include_children' => false
		)
		)
	);

?>

<div id="primary" class="full-content-area margintop portfolio-content">
	<main id="main" class="site-main clear" role="main">
		<div class="col-left">
			<?php if ($current_category) { ?>
				<h1 class="head1"><?php echo $current_category; ?></h1>
			<?php } ?>
			<?php get_template_part('template-parts/portfolio-categories'); ?>
		</div>
		<div class="col-right">
			<?php get_template_part('template-parts/content','portfolio') ?>
		</div>
	</main><!-- #main -->
</div><!-- #primary -->


<?php
get_footer();
