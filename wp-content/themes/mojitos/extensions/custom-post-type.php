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
		'name' => 'Portfolio',
		'singular_name' => 'Portfolio Item',
		'add_new' => 'Add New Item',
		'add_new_item' => 'Add New Portfolio Item',
		'edit_item' => 'Edit Portfolio Item',
		'new_item' => 'Add New Portfolio Item',
		'view_item' => 'View Item',
		'search_items' => 'Search Portfolio',
		'not_found' => 'No portfolio items found',
		'not_found_in_trash' => 'No portfolio items found in trash'
	);

	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments','revisions' ),
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
		'name' => 'Portfolio Tags',
		'singular_name' => 'Portfolio Tag',
		'search_items' => 'Search Portfolio Tags',
		'popular_items' => 'Popular Portfolio Tags',
		'all_items' => 'All Portfolio Tags',
		'parent_item' => 'Parent Portfolio Tag',
		'parent_item_colon' => 'Parent Portfolio Tag:',
		'edit_item' => 'Edit Portfolio Tag',
		'update_item' => 'Update Portfolio Tag',
		'add_new_item' => 'Add New Portfolio Tag',
		'new_item_name' => 'New Portfolio Tag Name',
		'separate_items_with_commas' => 'Separate portfolio tags with commas',
		'add_or_remove_items' => 'Add or remove portfolio tags',
		'choose_from_most_used' => 'Choose from the most used portfolio tags',
		'menu_name' => 'Portfolio Types'
	);
	
	$taxonomy_portfolio_tag_args = array(
		'labels' => $taxonomy_portfolio_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'portfolio-tag' ),
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
		"title" => 'Title',
		"thumbnail" => 'Thumbnail',
		"portfolio_category" => 'Category',
		"portfolio_tag" => 'Tags',
		"author" => 'Author',
		"comments" => 'Comments',
		"date" => 'Date',
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
				echo 'None';
			}
			break;	
			
			// Display the portfolio tags in the column view
			case "portfolio_tag":
			
			if ( $tag_list = get_the_term_list( $post_id, 'portfolio_tag', '', ', ', '' ) ) {
				echo $tag_list;
			} else {
				echo 'None';
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