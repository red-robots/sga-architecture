<?php 
/* Custom Post Types */
//ICONS = https://developer.wordpress.org/resource/dashicons/
add_action('init', 'js_custom_init', 1);
function js_custom_init() {
    $post_types = array(
        array(
            'post_type' => 'portfolio',
            'menu_name' => 'Portfolio',
            'plural'    => 'Portfolio',
            'single'    => 'Portfolio',
            'menu_icon' => 'dashicons-portfolio',
            'supports'  => array('title','editor','thumbnail')
        ),
         array(
            'post_type' => 'services',
            'menu_name' => 'Services',
            'plural'    => 'Services',
            'single'    => 'Service',
            'menu_icon' => 'dashicons-laptop',
            'supports'  => array('title','editor','thumbnail')
        ),
        array(
            'post_type' => 'team',
            'menu_name' => 'Team',
            'plural'    => 'Team',
            'single'    => 'Team',
            'menu_icon' => 'dashicons-groups',
            'supports'  => array('title','editor')
        ),
        array(
            'post_type' => 'careers',
            'menu_name' => 'Careers',
            'plural'    => 'Careers',
            'single'    => 'Career',
            'menu_icon' => 'dashicons-megaphone',
            'supports'  => array('title','editor')
        )
    );
    
    if($post_types) {
        foreach ($post_types as $p) {
            $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
            $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
            $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
            $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural']; 
            $menu_icon = ( isset($p['menu_icon']) && $p['menu_icon'] ) ? $p['menu_icon'] : "dashicons-admin-post"; 
            $supports = ( isset($p['supports']) && $p['supports'] ) ? $p['supports'] : array('title','editor','custom-fields','thumbnail'); 
            $taxonomies = ( isset($p['taxonomies']) && $p['taxonomies'] ) ? $p['taxonomies'] : array(); 
            $parent_item_colon = ( isset($p['parent_item_colon']) && $p['parent_item_colon'] ) ? $p['parent_item_colon'] : ""; 
            $menu_position = ( isset($p['menu_position']) && $p['menu_position'] ) ? $p['menu_position'] : 20; 
            
            if($p_type) {
                
                $labels = array(
                    'name' => _x($plural_name, 'post type general name'),
                    'singular_name' => _x($single_name, 'post type singular name'),
                    'add_new' => _x('Add New', $single_name),
                    'add_new_item' => __('Add New ' . $single_name),
                    'edit_item' => __('Edit ' . $single_name),
                    'new_item' => __('New ' . $single_name),
                    'view_item' => __('View ' . $single_name),
                    'search_items' => __('Search ' . $plural_name),
                    'not_found' =>  __('No ' . $plural_name . ' found'),
                    'not_found_in_trash' => __('No ' . $plural_name . ' found in Trash'), 
                    'parent_item_colon' => $parent_item_colon,
                    'menu_name' => $menu_name
                );
            
            
                $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true, 
                    'show_in_menu' => true, 
                    'show_in_rest' => true,
                    'query_var' => true,
                    'rewrite' => true,
                    'capability_type' => 'post',
                    'has_archive' => false, 
                    'hierarchical' => false, // 'false' acts like posts 'true' acts like pages
                    'menu_position' => $menu_position,
                    'menu_icon'=> $menu_icon,
                    'supports' => $supports
                ); 
                
                register_post_type($p_type,$args); // name used in query
                
            }
            
        }
    }
}

// Add new taxonomy, make it hierarchical (like categories)
add_action( 'init', 'ii_custom_taxonomies', 0 );
function ii_custom_taxonomies() {
        $posts = array();
        $posts = array(
            array(
                'post_type' => 'portfolio',
                'menu_name' => 'Portfolio Categories',
                'plural'    => 'Portfolio Categories',
                'single'    => 'Portfolio Category',
                'taxonomy'  => 'portfolio_categories'
            ),
        );
    
    if($posts) {
        foreach($posts as $p) {
            $p_type = ( isset($p['post_type']) && $p['post_type'] ) ? $p['post_type'] : ""; 
            $single_name = ( isset($p['single']) && $p['single'] ) ? $p['single'] : "Custom Post"; 
            $plural_name = ( isset($p['plural']) && $p['plural'] ) ? $p['plural'] : "Custom Post"; 
            $menu_name = ( isset($p['menu_name']) && $p['menu_name'] ) ? $p['menu_name'] : $p['plural'];
            $taxonomy = ( isset($p['taxonomy']) && $p['taxonomy'] ) ? $p['taxonomy'] : "";
            
            
            if( $taxonomy && $p_type ) {
                $labels = array(
                    'name' => _x( $menu_name, 'taxonomy general name' ),
                    'singular_name' => _x( $single_name, 'taxonomy singular name' ),
                    'search_items' =>  __( 'Search ' . $plural_name ),
                    'popular_items' => __( 'Popular ' . $plural_name ),
                    'all_items' => __( 'All ' . $plural_name ),
                    'parent_item' => __( 'Parent ' .  $single_name),
                    'parent_item_colon' => __( 'Parent ' . $single_name . ':' ),
                    'edit_item' => __( 'Edit ' . $single_name ),
                    'update_item' => __( 'Update ' . $single_name ),
                    'add_new_item' => __( 'Add New ' . $single_name ),
                    'new_item_name' => __( 'New ' . $single_name ),
                  );

              register_taxonomy($taxonomy,array($p_type), array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'show_in_rest' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => $taxonomy ),
              ));
            }
            
        }
    }
}

// Add the custom columns to the position post type:
add_filter( 'manage_posts_columns', 'set_custom_cpt_columns' );
function set_custom_cpt_columns($columns) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    if($post_type=='portfolio') {
        unset( $columns['taxonomy-portfolio_categories'] );
        unset( $columns['date'] );
        $columns['photo'] = __( 'Main Photo', 'bellaworks' );
        $columns['taxonomy-portfolio_categories'] = __( 'Categories', 'bellaworks' );
        $columns['date'] = __( 'Date', 'bellaworks' );
    }

    if($post_type=='team') {
        unset( $columns['date'] );
        $columns['team_photo'] = __( 'Photo', 'bellaworks' );
        $columns['date'] = __( 'Date', 'bellaworks' );
    }
    
    return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_posts_custom_column' , 'custom_post_column', 10, 2 );
function custom_post_column( $column, $post_id ) {
    global $wp_query;
    $query = isset($wp_query->query) ? $wp_query->query : '';
    $post_type = ( isset($query['post_type']) ) ? $query['post_type'] : '';
    
    if($post_type=='portfolio') {
        switch ( $column ) {
            case 'photo' :
                $thumbnail_id = get_post_thumbnail_id($post_id);
                $img = wp_get_attachment_image_src($thumbnail_id,'small-thumbnail');
                $img_src = ($img) ? $img[0] : '';
                $the_photo = '<span class="tmphoto" style="display:inline-block;width:70px;height:50px;background:#e2e1e1;text-align:center;">';
                if($img_src) {
                   $the_photo .= '<span style="background:url('.$img_src.') center no-repeat;background-size:cover;display:block;width:100%;height:100%;"></span>';
                } else {
                    $the_photo .= '<i class="dashicons dashicons-format-image" style="font-size:23px;position:relative;top:14px;left:-1px;opacity:0.2;"></i>';
                }
                $the_photo .= '</span>';
                echo $the_photo;
        }
    }

    if($post_type=='team') {
        switch ( $column ) {
            case 'team_photo' :
                $img = get_field('photo',$post_id);
                $img_src = ($img) ? $img['url'] : '';
                $the_photo = '<span class="tmphoto" style="display:inline-block;width:70px;height:50px;background:#e2e1e1;text-align:center;">';
                if($img_src) {
                   $the_photo .= '<span style="background:url('.$img_src.') center no-repeat;background-size:cover;display:block;width:100%;height:100%;"></span>';
                } else {
                    $the_photo .= '<i class="dashicons dashicons-format-image" style="font-size:23px;position:relative;top:14px;left:-1px;opacity:0.2;"></i>';
                }
                $the_photo .= '</span>';
                echo $the_photo;
        }
    }
    
}

/* Taxonomy Column */
add_filter('manage_edit-portfolio_categories_columns' , 'my_custom_taxonomy_columns');
function my_custom_taxonomy_columns( $columns ) {
    unset( $columns['slug'] );
    unset( $columns['description'] );
    unset( $columns['posts'] );
    $columns['category_image'] = __('Image');
    $columns['slug'] = __('Slug');
    $columns['posts'] = __('Count');
    return $columns;
}

function my_custom_taxonomy_columns_content( $content, $column_name, $term_id ) {
    $term = get_term($term_id, 'portfolio_categories');
    switch ($column_name) {
        case 'category_image': 
            $img = get_field('catimage', $term);
            $img_src = ($img) ? $img['url'] : '';
            $content = '<span class="tmphoto" style="display:inline-block;width:70px;height:50px;background:#f1f1f1;text-align:center;">';
                if($img_src) {
                   $content .= '<span style="background:url('.$img_src.') center no-repeat;background-size:cover;display:block;width:100%;height:100%;"></span>';
                } else {
                    $content .= '<i class="dashicons dashicons-format-image" style="font-size:23px;position:relative;top:14px;left:-1px;opacity:0.2;"></i>';
                }
                $content .= '</span>';
            break;
    }
    return $content;    
}
add_filter( 'manage_portfolio_categories_custom_column', 'my_custom_taxonomy_columns_content', 10, 3 );



 
// function manage_theme_columns($out, $column_name, $theme_id) {
//     $theme = get_term($theme_id, 'portfolio_categories');
//     switch ($column_name) {
//         case 'header_icon': 
//             // get header image url
//             // $data = maybe_unserialize($theme->description);
//             // $out .= "<img src=\"{$data['HEADER_image']}\" width=\"250\" height=\"83\"/>"; 
//             $out = 'test';
//             break;
 
//         default:
//             break;
//     }
//     return $out;    
// }

