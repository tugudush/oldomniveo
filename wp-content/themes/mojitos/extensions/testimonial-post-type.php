<?php

function testimonialposttype_activation() {
	testimonialposttype();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'testimonialposttype_activation' );

function testimonialposttype() {

	/**
	 * Enable the Testimonial custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __('Testimonials','mojitos'),
		'singular_name' => __('Testimonial Item','mojitos'),
		'add_new' => __('Add New Item','mojitos'),
		'add_new_item' => __('Add New Testimonial Item','mojitos'),
		'edit_item' => __('Edit Testimonial Item','mojitos'),
		'new_item' => __('Add New Testimonial Item','mojitos'),
		'view_item' => __('View Item','mojitos'),
		'search_items' => __('Search Testimonial','mojitos'),
		'not_found' => __('No Testimonial items found','mojitos'),
		'not_found_in_trash' => __('No Testimonial items found in trash','mojitos'),
		'all_items' => __('All Testimonials','mojitos')
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor' ),
		'capability_type' => 'post',
		'rewrite' => array("slug" => "testimonials"), // Permalinks format
		'menu_position' => 5,
		'has_archive' => true
	); 

	register_post_type( 'testimonial', $args );
	
	/**
	 * Register a taxonomy for Testimonial Tags
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	 
	
	$taxonomy_testimonial_tag_labels = array(
		'name' => __('Testimonial Tags','mojitos'),
		'singular_name' => __('Testimonial Tag','mojitos'),
		'search_items' => __('Search Testimonial Tags','mojitos'),
		'popular_items' => __('Popular Testimonial Tags','mojitos'),
		'all_items' => __('All Testimonial Tags','mojitos'),
		'parent_item' => __('Parent Testimonial Tag','mojitos'),
		'parent_item_colon' => __('Parent Testimonial Tag:','mojitos'),
		'edit_item' => __('Edit Testimonial Tag','mojitos'),
		'update_item' => __('Update Testimonial Tag','mojitos'),
		'add_new_item' => __('Add New Testimonial Tag','mojitos'),
		'new_item_name' => __('New Testimonial Tag Name','mojitos'),
		'separate_items_with_commas' => __('Separate testimonial tags with commas','mojitos'),
		'add_or_remove_items' => __('Add or remove testimonial tags','mojitos'),
		'choose_from_most_used' => __('Choose from the most used testimonial tags','mojitos'),
		'menu_name' => __('Testimonial Types','mojitos')
	);
	
	$taxonomy_testimonial_tag_args = array(
		'labels' => $taxonomy_testimonial_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'testimonial' ),
		'query_var' => true
	);
	
	register_taxonomy( 'testimonial_tag', array( 'testimonial' ), $taxonomy_testimonial_tag_args );
	
}

add_action( 'init', 'testimonialposttype' );
 
/**
 * Add Columns to Testimonial Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function testimonialposttype_edit_columns($testimonial_columns){
	$testimonial_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title','Column name','mojitos'),
		"thumbnail" => __('Thumbnail','mojitos'),
		"author" => __('Author','mojitos'),
		"date" => __('Date','mojitos')
	);
	return $testimonial_columns;
}

add_filter( 'manage_edit-testimonial_columns', 'testimonialposttype_edit_columns' );


/**
 * Displays the custom post type icon in the dashboard
 */

function testimonialposttype_testimonial_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-testimonial .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/images/testimonial-icon.png) no-repeat 6px 6px !important;
        }
		#menu-posts-testimonial:hover .wp-menu-image, #menu-posts-testimonial.wp-has-current-submenu .wp-menu-image {
            background-position:6px -16px !important;
        }
		#icon-edit.icon32-posts-testimonial {background: url(<?php echo get_template_directory_uri(); ?>/images/testimonial-32x32.png) no-repeat;}
    </style>
<?php }

add_action( 'admin_head', 'testimonialposttype_testimonial_icons' );

?>