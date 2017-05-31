<?php

/**
 * Tell WordPress to run mojitos_setup() when the 'after_setup_theme' hook is run.
 */
 
add_action( 'after_setup_theme', 'mojitos_setup' );

if ( ! function_exists( 'mojitos_setup' ) ):

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override mojitos_setup() in a child theme, add your own mojitos_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since mojitos 0.1
 */
 
function mojitos_setup() {
	
	/* Make Mojitos available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Mojitos, use a find and replace
	 * to change 'mojitos' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mojitos', get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	/**
 	* Set the content width based on the theme's design and stylesheet.
 	*/
	if ( ! isset( $content_width ) )
		$content_width = 560;

	// Styles the visual editor with editor-style.css to match the theme style
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );
	
	// Add post format
	add_theme_support( 'post-formats', array( 'gallery' ) );
	add_post_type_support( 'portfolio', 'post-formats' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'mojitos' ) );

	// Adds theme support for thumbnails
	add_theme_support('post-thumbnails');
	
	// Creates an image thumbnail size for multiple displays
	add_image_size( 'multiple-thumb', 215, 150, true );
	add_image_size( 'single-thumb', 500, 275, true );
	add_image_size( 'feature-thumb', 210, 100, true );
	
	// Creates an image thumbnail size for multiple portfolio displays
	add_image_size( 'portfolio-thumb-1-col', 645, 300, true );
	add_image_size( 'portfolio-thumb-3-col', 280, 188, true );
	add_image_size( 'portfolio-thumb-4-col', 205, 150, true );
	add_image_size( 'portfolio-slider', 920, 340, true );
	add_image_size( 'portfolio-single', 590, 9999 );
	add_image_size( 'portfolio-thumbnail', 32, 32 ,true );
	add_image_size( 'portfolio-thumbnail-large', 260, 160 ,true );
	
	
	// allow short code in widget
	add_filter('widget_text', 'do_shortcode');

}
endif; // mojitos_setup


	/*-----------------------------------------------------------------------------------*/
	/* Options Framework Theme
	/*-----------------------------------------------------------------------------------*/
	
	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */
	
	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', TEMPLATEPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', STYLESHEETPATH . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	}
	
	require(OPTIONS_FRAMEWORK_URL . 'options-framework.php');
	require(TEMPLATEPATH . '/admin/options-funtions.php');

	/**
	 * Enables the Custom post type
	 **/
	require(TEMPLATEPATH . '/extensions/portfolio-post-type.php');
	require(TEMPLATEPATH . '/extensions/testimonial-post-type.php');
	
	/**
	 * Load theme widgets
	 **/
	require(TEMPLATEPATH . '/extensions/theme-widgets.php');
	
	/**
	 * Load shortcode
	 **/
	require(TEMPLATEPATH . '/extensions/shortcodes.php');
	
	/**
	 * Load Metaboxe
	 **/
	require(TEMPLATEPATH . '/extensions/meta-box.php');
	

/**
 * Sets the post excerpt length to 40 characters.
 */
 

function portfolio_excerpt_length($length) {
    return 15;
}
function portfolio_excerptmore($more) {
    return '';
}
function portfolio_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}

/**
 * General Excerpt length
 *
 */

function mojitos_excerpt_length( $length ) {
	return 35;
} 
function mojitos_auto_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_length', 'mojitos_excerpt_length' );
add_filter( 'excerpt_more', 'mojitos_auto_excerpt_more' );

/**
 * Adds custom body for singular vs multiple layouts
 */

/**
 * Registers the sidebars and widgetized areas.
 *
 * @since mojitos 0.1
 */
 
function mojitos_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Home page sidebar', 'mojitos' ),
		'id' => 'home-sidebar',
		'description' => __( 'The right sidebar for home page.', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Sidebar', 'mojitos' ),
		'id' => 'sidebar',
		'description' => __( 'The right sidebar for posts and pages.', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Contact page sidebar', 'mojitos' ),
		'id' => 'contact-sidebar',
		'description' => __( 'The right sidebar for contact page.', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Page sidebar', 'mojitos' ),
		'id' => 'page-sidebar',
		'description' => __( 'The right sidebar for page.', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar(array(
		'name' => __('Footer 1', 'mojitos'),
		'id' => 'footer-1',
		'description' => __( 'The leftmost footer widget', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'));
	register_sidebar(array(
		'name' => __('Footer 2', 'mojitos'),
		'id' => 'footer-2',
		'description' => __( 'The middle footer widget', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'));
	register_sidebar(array(
		'name' => __('Footer 3', 'mojitos'),
		'id' => 'footer-3',
		'description' => __( 'The rightmost footer widget which is the widest', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'));
	register_sidebar(array(
		'name' => __('Footer 4', 'mojitos'),
		'id' => 'footer-4',
		'description' => __( 'The rightmost footer widget which is the widest', 'mojitos' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'));
}
add_action( 'widgets_init', 'mojitos_widgets_init' );

/**
 * Display navigation to next/previous pages when applicable
 */
 
function mojitos_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $nav_id; ?>">
			<h1 class="section-heading"><?php _e( 'Post navigation', 'mojitos' ); ?></h1>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'mojitos' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'mojitos' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}

/**
 * Enqueue Javascripts
 **/

function my_scripts_method() {
   wp_enqueue_script( 'twitter', get_template_directory_uri().'/js/twitercallback.js');
	wp_enqueue_script( 'googlemap', 'http://maps.google.com/maps/api/js?sensor=false');
	wp_enqueue_script( 'gmap', get_template_directory_uri().'/js/jquery.gmap.js', array('jquery'));
	wp_enqueue_script( 'tipsy', get_template_directory_uri().'/js/jquery.tipsy.js', array('jquery'));
	wp_enqueue_script( 'equalheighft', get_template_directory_uri().'/js/jquery.equal-height-columns.js', array('jquery'));
	wp_enqueue_script( 'superfish', get_template_directory_uri().'/js/superfish.js', array('jquery'));
	wp_enqueue_script( 'custom', get_template_directory_uri().'/js/custom.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'my_scripts_method');

/**
 *  CONTACT FORM 
 **/

function hexstr($hexstr) {
  $hexstr = str_replace(' ', '', $hexstr);
  $hexstr = str_replace('\x', '', $hexstr);
  $retstr = pack('H*', $hexstr);
  return $retstr;
}
function strhex($string) {
  $hexstr = unpack('H*', $string);
  return array_shift($hexstr);
}

/**
 * Comments
 */
 
if ( ! function_exists( 'mojitos_comment' ) ) :

/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since mojitos 0.1
 */
 
function mojitos_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'mojitos' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'mojitos' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 71;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 40;

						echo get_avatar( $comment, $avatar_size );

						printf( __( '%1$s <span class="says">said:</span>', 'mojitos' ),
							sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ),
							'<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '"></a>'
						);
						
						
					?>
					
					<?php edit_comment_link( __( '[Edit]', 'mojitos' ), ' ' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mojitos' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>
            
            <time pubdate datetime="<?php echo get_comment_time( 'c' ); ?>"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?></time>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for mojitos_comment()


/* Portfolio image */
function atm_get_images() {
	
	global $post;

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	
	$output = '';

	if ($attachments) {		
		
		foreach ( $attachments as $attachment_id => $attachment ) {
			$output .= '<p class="portfolio-img">';
			$output .= wp_get_attachment_image( $attachment->ID, 'portfolio-single' );
			if ($attachment->post_content) :
				$output .= '<span >'.$attachment->post_content.'</span>';
			endif;
			$output .= '</p>';
		}

		return $output;
	
	}
}

/* 
 * 
 * This one shows/hides the an option when a select is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	if (jQuery('input:radio[name="mojitos[slide_type]"]:checked').val() == 'slider') {
			jQuery('#section-slide_item').hide();
			jQuery('#section-slider_number, #section-slider_effect').fadeIn(500);			
		} else {
			jQuery('#section-slider_number, #section-slider_effect').hide();
			jQuery('#section-slide_item').fadeIn(500);
		}

	jQuery('input:radio[name="mojitos[slide_type]"]').change(function() {
	
		if (jQuery(this).val() == 'slider') {
			jQuery('#section-slide_item').hide();
			jQuery('#section-slider_number, #section-slider_effect').fadeIn(500);			
		} else {
			jQuery('#section-slider_number, #section-slider_effect').hide();
			jQuery('#section-slide_item').fadeIn(500);
		}
	
	});
	
});
</script>

<?php
}
/**
 * Modified Recent_Posts widget class
 *
 * @since 2.8.0
 */


add_action( 'widgets_init', 'my_unregister_widgets' );

function my_unregister_widgets() {
	unregister_widget( 'WP_Widget_Recent_Posts' );
}
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class ATM_Widget_Recent_Posts extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => "The most recent posts on your site" );
		parent::__construct('recent-posts', 'Recent Posts', $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title'], $instance, $this->id_base);
		if ( ! $number = absint( $instance['number'] ) )
 			$number = 10;

		$r = new WP_Query(array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li>
        <?php the_post_thumbnail(array(32,32)); ?>
        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
        <span class="date"><?php echo get_the_date(); ?></span>
        </li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php 'Title:'; ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php 'Number of posts to show:'; ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}
function register_recent_post_widget() {
	register_widget( 'ATM_Widget_Recent_Posts' );	
}
add_action( 'widgets_init', 'register_recent_post_widget' );

/*
----------------------------------------------------------

	Plugin Name:	Extended Mime Types
	Plugin URI:	http://blog.tahlequah.k12.ok.us/maxwellja
	Description:	Extends the allowed uploadable MIME types to include a WIDE range of file types. Created specifically for WPMS to allow a wider range of file types network-wide. 
	Version:	1.0

	Author:		Josh Maxwell (Tahlequah Schools)
	Author URI:	http://blog.tahlequah.k12.ok.us/maxwellja
	
	*** This version of plugin has modified by AddTwoMore.

----------------------------------------------------------
*/

// Add the filter
add_filter('upload_mimes', 'tqps_extended_mime_types');

// Function to add mime types
function tqps_extended_mime_types ( $mime_types=array() ) {

	// add your extension & app info to mime-types.txt in this format
	//   doc,doct application/msword
	//   pdf application/pdf
	// etc...
	$file = TEMPLATEPATH . '/admin/mime-types.txt';
	$mime_file_lines = file($file);

	foreach ($mime_file_lines as $line) {
		//Catch all sorts of line endings - CR/CRLF/LF
		$mime_type = explode(" ",rtrim(rtrim($line,"\n"),"\r"));
		$mime_types[$mime_type[0]] = $mime_type[1];
	}

	// add as many as you like
	return $mime_types;
}

if ( ! function_exists( 'mojitos_posted_on' ) ) :

function mojitos_posted_on() {

	printf( __( '<div class="post-date"><span class="sep">%1$s</span><time class="entry-date" datetime="%2$s" pubdate><span class="day">%3$s</span><span class="month">%4$s <span class="sep">, </span></span><span class="year">%5$s</span></time></div>', 'mojitos'), 
		'Posted', 
		get_the_date('c'), 
		get_the_date('d'), 
		get_the_date('M'), 
		get_the_date('Y') 
		);
}
endif;

add_filter( 'the_excerpt', 'shortcode_unautop');
add_filter( 'the_excerpt', 'do_shortcode');

// Enable qTranslate for WordPress SEO
	function qtranslate_filter($text){
		return __($text);
	}
	add_filter('wpseo_title', 'qtranslate_filter', 10, 1);
	add_filter('wpseo_metadesc', 'qtranslate_filter', 10, 1);
	add_filter('wpseo_metakey', 'qtranslate_filter', 10, 1);