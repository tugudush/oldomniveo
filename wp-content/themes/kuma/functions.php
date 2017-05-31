<?php
add_action( 'after_setup_theme', 'kuna_setup' );

if ( ! function_exists( 'kuna_setup' ) ) :

	/**
	 * Global functions
	 */
	function kuna_setup() {

		// Theme lang.
		load_theme_textdomain( 'kuna', get_template_directory() . '/languages' );

		// Add Title Tag Support.
		add_theme_support( 'title-tag' );

		// Register Menus.
		register_nav_menus(
			array(
				'main_menu' => __( 'Main Menu', 'kuna' ),
			)
		);

		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 300, true );
		add_image_size( 'kuna-single', 1380, 460, true );

		// Add Custom Background Support.
		$args = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args );

		add_theme_support( 'custom-logo', array(
			'height'		 => 70,
			'width'			 => 200,
			'flex-height'	 => true,
			'flex-width'	 => true,
			'header-text'	 => array( 'site-title', 'site-description' ),
		) );

		// Adds RSS feed links to for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'kuna_custom_header_args', array(
			'default-image'		 => '',
			'default-text-color' => '404040',
			'width'				 => 2000,
			'height'			 => 200,
			'flex-height'		 => true,
			'flex-width'		 => true,
			'wp-head-callback'	 => 'kuna_header_style',
		) ) );
	}

endif;

if ( ! function_exists( 'kuna_header_style' ) ) :

	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 */
	function kuna_header_style() {
		$header_text_color	 = get_header_textcolor();
		$header_image		 = get_header_image();

		if ( $header_image ) :
			?>
			<style type="text/css">
				.site-header {
					position: relative;
				}
				.site-header:before {
					background-image: url( <?php echo esc_url( $header_image ); ?>);
					background-position: center;
					background-repeat: no-repeat;
					background-size: cover;
					content: "";
					display: block;
					height: 100%;
					left: 0;
					position: absolute;
					top: 0;
					width: 100%;
					z-index: -1;
				}
			</style>
			<?php
		endif;

		// If no custom options for text are set, let's bail.
		// get_header_textcolor() options: add_theme_support( 'custom-header' ) is default, hide text (returns 'blank') or any hex value.
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( 'blank' === $header_text_color ) :
			?>
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
				.site-title a,
				.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
		<?php endif; ?>
		</style>
		<?php
	}

endif;

/**
 * Set Content Width
 */
function kuna_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kuna_content_width', 1380 );
}

add_action( 'after_setup_theme', 'kuna_content_width', 0 );

/**
 * Enqueue Styles (normal style.css and bootstrap.css)
 */
function kuna_theme_stylesheets() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.3.7' );
	wp_enqueue_style( 'kuna-stylesheet', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'kuna_theme_stylesheets' );

/**
 * Register Bootstrap JS with jquery
 */
function kuna_theme_js() {
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '3.3.7', true );
	wp_enqueue_script( 'kuna-theme-js', get_template_directory_uri() . '/js/customscript.js', array( 'jquery' ), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'kuna_theme_js' );


/**
 * Register Custom Navigation Walker include custom menu widget to use walkerclass
 */
require_once( trailingslashit( get_template_directory() ) . 'lib/wp_bootstrap_navwalker.php' );


add_action( 'widgets_init', 'kuna_widgets_init' );

/**
 * Register the Sidebar(s)
 */
function kuna_widgets_init() {
	register_sidebar(
		array(
			'name'			 => esc_html__( 'Right Sidebar', 'kuna' ),
			'id'			 => 'kuna-right-sidebar',
			'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			'after_widget'	 => '</div>',
			'before_title'	 => '<h3 class="widget-title">',
			'after_title'	 => '</h3>',
		)
	);
}

function kuna_main_content_width_columns() {

	$columns = '12';

	if ( is_active_sidebar( 'kuna-right-sidebar' ) ) {
		$columns = $columns - 3;
	}

	echo absint( $columns );
}

if ( ! function_exists( 'kuna_posted_on' ) ) :

	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function kuna_posted_on() {

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__( 'by %s', 'kuna' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		echo '<span class="posted-on">' . kuna_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
	}

endif;


if ( ! function_exists( 'kuna_time_link' ) ) :

	/**
	 * Gets a nicely formatted string for the published date.
	 */
	function kuna_time_link() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date()
		);

		// Wrap the time string in a link, and preface it with 'Posted on'.
		return sprintf(
			/* translators: %s: post date */
			__( 'Posted on %s', 'kuna' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
	}

endif;

if ( ! function_exists( 'kuna_entry_footer' ) ) :

	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function kuna_entry_footer() {

		/* translators: used between list items, there is a space after the comma */
		$separate_meta = __( ', ', 'kuna' );

		// Get Categories for posts.
		$categories_list = get_the_category_list( $separate_meta );

		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', $separate_meta );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( $categories_list || $tags_list ) {

			echo '<div class="entry-footer">';

			if ( 'post' === get_post_type() ) {
				if ( $categories_list || $tags_list ) {

					// Make sure there's more than one category before displaying.
					if ( $categories_list ) {
						echo '<div class="cat-links"><span class="space-right">' . __( 'Category:', 'kuna' ) . '</span>' . $categories_list . '</div>';
					}

					if ( $tags_list ) {
						echo '<div class="tags-links"><span class="space-right">' . __( 'Tagged', 'kuna' ) . '</span>' . $tags_list . '</div>';
					}
				}
			}
			if ( comments_open() ) :
				echo '<div class="comments-template">';
				comments_popup_link( esc_html__( 'Leave a Comment', 'kuna' ), esc_html__( 'One Comment', 'kuna' ), esc_html__( '% Comments', 'kuna' ), 'comments-link', esc_html__( 'Comments are off for this post', 'kuna' ) );
				echo '</div>';
			endif;

			edit_post_link();

			echo '</div>';
		}
	}

endif;
