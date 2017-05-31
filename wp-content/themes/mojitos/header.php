<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */
?><!DOCTYPE html>
<!--[if lt IE 9]>
<html id="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'mojitos' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<header id="branding" role="banner" class="clearfix">
    	<div class="col-width">
			<hgroup>
					<a href="<?php echo esc_url( home_url( '/' ) );	echo "?lang=".qtrans_getLanguage(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="http://www.omniveo.com/images/logo_omni-blue-cut.png" alt="<?php bloginfo( 'name' ) ?>" /></a>
				<h1 id="site-title">
				<span><a href="<?php echo esc_url( home_url( '/' ) ); echo "?lang=".qtrans_getLanguage();?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php if ( of_get_option('logo', false) ) { ?>
					<img src="<?php echo of_get_option('logo'); ?>" alt="<?php bloginfo( 'name' ) ?>" />
				<?php } else {
					bloginfo( 'name' );
				}?>
				</a></span></h1>
                <?php if ( of_get_option('tagline',false) ) { ?>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                <?php } ?>
			</hgroup>
			<nav id="access" role="navigation">
				<h1 class="section-heading"><?php _e( 'Main menu', 'mojitos' ); ?></h1>
				<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'mojitos' ); ?>"><?php _e( 'Skip to content', 'mojitos' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assiged to the primary position is the one used. If none is assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_id'=>'main-nav'  ) ); ?>
			</nav><!-- #access -->
            <?php
			
			$facebook = of_get_option('facebook_user');
            $twitter = of_get_option('twitter_user');
            $dribbble = of_get_option('dribbble_user');
			$forrst = of_get_option('forrst_user');
			$flickr = of_get_option('flickr_user');
			$googleplus = of_get_option('googleplus_user');
			$vimeo = of_get_option('vimeo_user');
			$youtube = of_get_option('youtube_user');
			$linkedin = of_get_option('linkedin_user'); 
			
			if ( $facebook != '' || $twitter != '' || $dribbble != '' || $forrst != '' || $flickr != '' || $googleplus != '' || $vimeo != '' || $youtube != '' ) : 
			
			?>
            <div class="social-link">
            	<ul>
					
					<?php
					
                    if (  $facebook ) echo '<li><a class="facebook" title="facebook" href="http://facebook.com/'. $facebook. '">facebook</a></li>';
                    if (  $twitter ) echo '<li><a class="twitter" title="twitter" href="http://twitter.com/' . $twitter . '">twitter</a></li>';
                    if (  $dribbble ) echo '<li><a class="dribbble" title="dribbble" href="http://drbbble.com/'. $dribbble. '">dribbble</a></li>';
					if (  $forrst ) echo '<li><a class="forrst" title="forrst" href="http://forrst.com/people/'. $forrst. '">forrst</a></li>';
					if (  $flickr ) echo '<li><a class="flickr" title="flickr" href="http://flickr.com/'. $flickr. '">flickr</a></li>';
					if (  $googleplus ) echo '<li><a class="googleplus" title="googleplus" href="https://plus.google.com/'. $googleplus. '">googleplus</a></li>';
					if (  $vimeo ) echo '<li><a class="vimeo" title="vimeo" href="http://vimeo.com/'. $vimeo. '">vimeo</a></li>';
					if (  $youtube ) echo '<li><a class="youtube" title="youtube" href="http://youtube.com/'. $youtube. '">youtube</a></li>';
					if (  $linkedin ) echo '<li><a class="linkedin" title="linkedin" href="'. $linkedin . '">linkedin</a></li>';
					?>
                </ul>
            </div><!-- #social-link -->
            <?php endif; ?>
			<div class="bck-qtrans"><?php echo qtrans_generateLanguageSelectCode('dropdown'); ?></div>
         </div><!-- .col-width -->
         
          <?php if (is_front_page()) : ?>
          <?php
        if (of_get_option('site_intro_page') != '') : 
			$site_intro = of_get_option('site_intro_page'); //Gets the page name and gives us access to the ID			                       
        ?>
        <div class="clearfix"></div>
		<div class="site-introduction clearfix">
        	<div class="col-width">
            		<?php 
//					$site_intro_content = get_post($site_intro,ARRAY_A); 
//					echo $site_intro_content['post_content']; 					
					?>       
					<?php
						if(qtrans_getLanguage() == "es") {
//						// Spanish
						$site_intro_es = "1890"; // same as page id you have just created
						$site_intro_content_es = get_post($site_intro_es,ARRAY_A); 
						echo $site_intro_content_es['post_content'];                  
						} else {
//						// English
						$site_intro_content = get_post($site_intro,ARRAY_A); 
						echo $site_intro_content['post_content'];                    
						} ?>
					<?php
//						if(qtrans_getLanguage() == "es") {
						// Spanish
//						echo '<h4><span style="color: #64738c;">Bienvenido a Omniveo !</span></h4>
//<h6>Creamos un mundo virtual con <span style="color: #5ac8e5; font-size: 34px;">fotos panorámicas 360°,</span></h6>
//<h2><span style="color: #5ac8e5;">Tours Virtuales</span> y <span style="color: #5ac8e5; font-size: 28px;">multimedia 3D</span></h2>
//&nbsp;
//<h6><span style="color: #64738c;">OmniVeo es una empresa innovadora que diseña imágenes interactivas de realidad virtual y animaciones multimedia 3D, tambien para pantallas 3D.</span></h6>';                  
//						} else {
						// English
//						$site_intro_content = get_post($site_intro,ARRAY_A); 
//						echo $site_intro_content['post_content'];                    
//						} ?>
            </div><!-- .col-width -->
        </div><!-- .site-introduction -->
        <?php endif; ?>
        <?php endif; ?>
	
         
	</header><!-- #branding -->


	<div id="main" class="clearfix">   	