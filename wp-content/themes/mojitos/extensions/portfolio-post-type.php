<?php

function portfolioposttype_activation() {
	portfolioposttype();
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'portfolioposttype_activation' );

function portfolioposttype() {

	/**
	 * Enable the Portfolio custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __('Portfolios','mojitos'),
		'singular_name' => __('Portfolio Item','mojitos'),
		'add_new' => __('Add New Item','mojitos'),
		'add_new_item' => __('Add New Portfolio Item','mojitos'),
		'edit_item' => __('Edit Portfolio Item','mojitos'),
		'new_item' => __('Add New Portfolio Item','mojitos'),
		'view_item' => __('View Item','mojitos'),
		'search_items' => __('Search Portfolio','mojitos'),
		'not_found' => __('No portfolio items found','mojitos'),
		'not_found_in_trash' => __('No portfolio items found in trash','mojitos'),
		'all_items' => __('All Portfolios','mojitos')
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments','revisions', 'post-formats' ),
		'capability_type' => 'post',
		'rewrite' => array("slug" => "portfolio"), // Permalinks format
		'menu_position' => 5,
		'has_archive' => true
	); 

	register_post_type( 'portfolio', $args );
	
	/**
	 * Register a taxonomy for Portfolio Tags
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	 
	
	$taxonomy_portfolio_tag_labels = array(
		'name' => __('Portfolio Tags','mojitos'),
		'singular_name' => __('Portfolio Tag','mojitos'),
		'search_items' => __('Search Portfolio Tags','mojitos'),
		'popular_items' => __('Popular Portfolio Tags','mojitos'),
		'all_items' => __('All Portfolio Tags','mojitos'),
		'parent_item' => __('Parent Portfolio Tag','mojitos'),
		'parent_item_colon' => __('Parent Portfolio Tag:','mojitos'),
		'edit_item' => __('Edit Portfolio Tag','mojitos'),
		'update_item' => __('Update Portfolio Tag','mojitos'),
		'add_new_item' => __('Add New Portfolio Tag','mojitos'),
		'new_item_name' => __('New Portfolio Tag Name','mojitos'),
		'separate_items_with_commas' => __('Separate portfolio tags with commas','mojitos'),
		'add_or_remove_items' => __('Add or remove portfolio tags','mojitos'),
		'choose_from_most_used' => __('Choose from the most used portfolio tags','mojitos'),
		'menu_name' => __('Portfolio Types','mojitos')
	);
	
	$taxonomy_portfolio_tag_args = array(
		'labels' => $taxonomy_portfolio_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'portfolio-tag'),
		'query_var' => true
	);
	
	register_taxonomy( 'portfolio_tag', array( 'portfolio' ), $taxonomy_portfolio_tag_args );
	
}

add_action( 'init', 'portfolioposttype' );
 
/**
 * Add Columns to Portfolio Edit Screen
 * http://wptheming.com/2010/07/column-edit-pages/
 */
 
function portfolioposttype_edit_columns($portfolio_columns){
	$portfolio_columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Title','Column name', 'mojitos'),
		"thumbnail" => __('Thumbnail','mojitos'),
		"portfolio_tag" => __('Tags','mojitos'),
		"author" => __('Author','mojitos'),
		"comments" => __('Comments','mojitos'),
		"date" => __('Date','mojitos'),
	);
	$portfolio_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
	return $portfolio_columns;
}

add_filter( 'manage_edit-portfolio_columns', 'portfolioposttype_edit_columns' );
 
function portfolioposttype_columns_display($portfolio_columns, $post_id){

	switch ( $portfolio_columns )
	
	{
		// Code from: http://wpengineer.com/display-post-thumbnail-post-page-overview
		
		case "thumbnail":
			$width = (int) 35;
			$height = (int) 35;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			// Display the featured image in the column view if possible
			if ($thumbnail_id) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset($thumb) ) {
				echo $thumb;
			} else {
				echo __('None','mojitos');
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "portfolio_tag":
			
			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo __('None','mojitos');
			}
			break;			
	}
}

add_action( 'manage_posts_custom_column',  'portfolioposttype_columns_display', 10, 2 );

/**
 * Add Portfolio count to "Right Now" Dashboard Widget
 */

function add_portfolio_counts() {
        if ( ! post_type_exists( 'portfolio' ) ) {
             return;
        }

        $num_posts = wp_count_posts( 'portfolio' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'Portfolio Item', 'Portfolio Items', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=portfolio'>$num</a>";
            $text = "<a href='edit.php?post_type=portfolio'>$text</a>";
        }
        echo '<td class="first b b-portfolio">' . $num . '</td>';
        echo '<td class="t portfolio">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->pending > 0) {
            $num = number_format_i18n( $num_posts->pending );
            $text = _n( 'Portfolio Item Pending', 'Portfolio Items Pending', intval($num_posts->pending) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=pending&post_type=portfolio'>$num</a>";
                $text = "<a href='edit.php?post_status=pending&post_type=portfolio'>$text</a>";
            }
            echo '<td class="first b b-portfolio">' . $num . '</td>';
            echo '<td class="t portfolio">' . $text . '</td>';

            echo '</tr>';
        }
}

add_action( 'right_now_content_table_end', 'add_portfolio_counts' );


/**
 * Displays the custom post type icon in the dashboard
 */

function portfolioposttype_portfolio_icons() { ?>
    <style type="text/css" media="screen">
        #menu-posts-portfolio .wp-menu-image {
            background: url(<?php echo get_template_directory_uri(); ?>/images/portfolio-icon.png) no-repeat 6px 6px !important;
        }
		#menu-posts-portfolio:hover .wp-menu-image, #menu-posts-portfolio.wp-has-current-submenu .wp-menu-image {
            background-position:6px -16px !important;
        }
		#icon-edit.icon32-posts-portfolio {background: url(<?php echo get_template_directory_uri(); ?>/images/portfolio-32x32.png) no-repeat;}
    </style>
<?php }

add_action( 'admin_head', 'portfolioposttype_portfolio_icons' );

?>