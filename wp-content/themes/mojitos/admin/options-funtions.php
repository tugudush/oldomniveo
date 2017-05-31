<?php
/**
 * Theme option function
 **/

/* This sets up the layouts and styles selected from the options panel */

/**
 * Adds a body class to indicate sidebar position
 */
 
function atm_body_class($classes) {
	$layout = of_get_option('layout','layout-2cr');
	$classes[] = $layout;
	return $classes;
}

add_filter('body_class','atm_body_class');


if (!function_exists('atm_wp_head')) :
	
	function atm_wp_head() {
		 	
		// This prints out the custom css and specific styling options
		atm_head_css();
	}
	
endif;

add_action('wp_head', 'atm_wp_head');


/* Output CSS from standarized options */

function atm_head_css() {
				
		$output = '';
		
		if (of_get_option('body_background')) :
			$background = of_get_option('body_background');			
			if ($background['image']) :
				$output .= "body { background:".$background['color']." url(".$background['image'].") ".$background['position']." ".$background['repeat']." ".$background['attachment'].";}\n";
			elseif ($background['color']) :
				$output .= "body { background: ".$background['color'].";}\n";
			else :				
			endif;	
		endif;
		
		/*if (of_get_option('header_background')) :
			$background = of_get_option('header_background');			
			if ($background['image']) :
				$output .= "#branding { background:".$background['color']." url(".$background['image'].") ".$background['position']." ".$background['repeat']." ".$background['attachment'].";}\n";
				$output .= "#branding:after { border-top: 8px solid ".$background['color'].";}\n";
			elseif ($background['color']) :
				$output .= "#branding { background: ".$background['color'].";}\n";
				$output .= "#branding:after { border-top: 8px solid ".$background['color'].";}\n";
			else :				
			endif;	
		endif;*/
		
		if (of_get_option('color_ft')) :
			$output .= "#colophon { color:".of_get_option('color_ft')."; }\n";
		endif;
		if (of_get_option('color_ft_a')) :
			$output .= "#colophon a { color:".of_get_option('color_ft_a')."; }\n";
		endif;
		if (of_get_option('color_ft_a_hover')) :
			$output .= "#colophon a:hover { color:".of_get_option('color_ft_a_hover')."; }\n";
		endif;		
		if (of_get_option('custom_css')) :
			$custom_css = of_get_option('custom_css');
			$output .= $custom_css . "\n";
		endif;		
		// Output styles
		if ($output <> "") :
			$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo $output;
		endif;
	
}

/* Add Favicon */

function atm_custom_favicon() {
	
	$shortname =  of_get_option('custom_favicon'); 
	if ( $shortname <> "") 
	     echo '<link rel="shortcut icon" href="'.  $shortname  .'"/>'."\n";
		 	    
}

add_action('wp_head', 'atm_custom_favicon');

/* Theme color */

function atm_custom_theme() {
	
	$shortname =  of_get_option('alt_stylesheet'); 
	if ( $shortname <> "") 
	     echo '<link rel="stylesheet" type="text/css" media="all" href="'. get_stylesheet_directory_uri().'/styles/'.  $shortname  .'"/>'."\n";
		 	    
}

add_action('wp_head', 'atm_custom_theme');


/* Show analytics code in footer */

function atm_analytics(){
	
	$output = of_get_option('google_analytics');
	if ( $output <> "" ) 
		echo '<script type="text/javascript">'.stripslashes($output).'</script>';
}

add_action('wp_footer','atm_analytics');
?>