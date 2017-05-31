<?php
/**
 * Remove open paragraphs
 **/
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content) {   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
    return $content;
}

/**
 * Button
**/
add_shortcode('button', 'shortcode_button');
function shortcode_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'size' => 'medium',
		'color' => '',
		'target' => '_self',
		'align' => 'left'
    ), $atts));	
	$button = '';
	$button .= '<a class="button '.$size.' '. $align.'" target="'.$target.'" href="'.$link.'" style="background:'.$color.';">';
	$button .= $content;
	$button .= '</a>';
	return $button;
}

/**
 * Dropcap
**/
add_shortcode('dropcap', 'shortcode_dropcap');
function shortcode_dropcap( $atts, $content = null ) {  
		
	return '<span class="dropcap">' .do_shortcode($content). '</span>';  
		
}

/**
 * Arrowlist
**/
add_shortcode('arrowlist', 'shortcode_arrowlist');
function shortcode_arrowlist( $atts, $content = null ) {
	
	$content = str_replace('<ul>', '<ul class="arrow-list">', do_shortcode($content));
	$content = str_replace('<li>', '<li>', do_shortcode($content));
	
return $content;
	
}

/**
 * Column
**/

// 1-2 col
add_shortcode('one_half', 'shortcode_one_half');
function shortcode_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half_last', 'shortcode_one_half_last');
function shortcode_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}

// 1-3 col 
add_shortcode('one_third', 'shortcode_one_third');
function shortcode_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third_last', 'shortcode_one_third_last');
function shortcode_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}

// 2-3
add_shortcode('two_thirds', 'shortcode_two_thirds');
function shortcode_two_thirds( $atts, $content = null ) {
   return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds_last', 'shortcode_two_thirds_last');
function shortcode_two_thirds_last( $atts, $content = null ) {
   return '<div class="two_thirds last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}

// 1-4 col 
add_shortcode('one_fourth', 'shortcode_one_fourth');
function shortcode_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth_last', 'shortcode_one_fourth_last');
function shortcode_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}

// 3-4 col
add_shortcode('three_fourths', 'shortcode_three_fourths');
function shortcode_three_fourths( $atts, $content = null ) {
   return '<div class="three_fourths">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths_last', 'shortcode_three_fourths_last');
function shortcode_three_fourths_last( $atts, $content = null ) {
   return '<div class="three_fourths last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}

// 1-5 Col
add_shortcode('one_fifth', 'shortcode_one_fifth');
function shortcode_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}

// 2-5
add_shortcode('two_fifth', 'shortcode_two_fifth');
function shortcode_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}

// 3-5
add_shortcode('three_fifth', 'shortcode_three_fifth');
function shortcode_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}

// 4-5
add_shortcode('four_fifth', 'shortcode_four_fifth');
function shortcode_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth_last', 'shortcode_one_fifth_last');
function shortcode_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('two_fifth_last', 'shortcode_two_fifth_last');
function shortcode_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('three_fifth_last', 'shortcode_three_fifth_last');
function shortcode_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}
add_shortcode('four_fifth_last', 'shortcode_four_fifth_last');
function shortcode_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearfix"></div>';
}

/**
 * Google Maps Shortcode
 **/
add_shortcode( 'googlemap', 'shortcode_googlemaps' );
function shortcode_googlemaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '590',
      "height" => '442',
	  "lat" => '',
	  "long" => '',
	  "zoom" => '15',
	  "type" => 'MapTypeId.ROADMAP',
	  "icon" => '',
	  "icon_w" => '',
	  "icon_h" => '',
      "address" => ''
   ), $atts));
   
   $id = time();
   $map ='';
   
   if ($icon != '') :
		  
		  $map = '<div id="map'.$id.'" style="width:'.$width.'px; height:'.$height.'px;" class="googlemap-shortcode"></div>
		   <script>
		   jQuery(document).ready(function(){ 
			jQuery("#map'.$id.'").gMap({
				markers: [ { 
					latitude: '.$lat.',
					longitude: '.$long.'} ],
				icon: { image: \''.$icon.'\', iconsize: ['.$icon_w.', '.$icon_h.'], shadow:"'. get_template_directory_uri() .'/images/map-shadow.gif" }, 
				maptype: google.maps.'.$type.',
				mapTypeControl:false,
				streetViewControl:false,
				zoom: '.$zoom.'}); 
			});
			</script>';
			
			else :
			
			$map = '<div id="map'.$id.'" style="width:'.$width.'px; height:'.$height.'px;" class="googlemap-shortcode"></div>
		   <script>
		   jQuery(document).ready(function(){ 
			jQuery("#map'.$id.'").gMap({
				markers: [ { 
					latitude: '.$lat.',
					longitude: '.$long.'} ], 
				maptype: google.maps.'.$type.',
				mapTypeControl:false,
				streetViewControl:false,
				zoom: '.$zoom.'}); 
			});
			</script>';
			
			endif;
   
   return $map;
}

/**
 * Tabs
**/
add_shortcode( 'tabgroup', 'shortcode_tabgroup' );
function shortcode_tabgroup( $atts, $content ){
	
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
}
return $return;

}

add_shortcode( 'tab', 'shortcode_tab' );
function shortcode_tab( $atts, $content ){
extract(shortcode_atts(array(
	'title' => '%d',
	'id' => '%d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array(
	'title' => sprintf( $title, $GLOBALS['tab_count'] ),
	'content' =>  $content,
	'id' =>  $id );

$GLOBALS['tab_count']++;
}
	
/**
 * Toggle
**/
add_shortcode('toggle', 'shortcode_toggle');
function shortcode_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		 'title' => '',
		 'style' => 'list'
    ), $atts));
	$output = '';
	$output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
	$output .= '<div class="toggle_container"><div class="block">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div>';

	return $output;
	}

/**
 * Youtube
**/
add_shortcode('youtube', 'shortcode_youtube');
	function shortcode_youtube($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'width' => 590,
				'height' => 442
			), $atts);
		
			return '<div class="video-shortcode"><iframe title="YouTube video player" width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="http://www.youtube.com/embed/' . $atts['id'] . '" frameborder="0" allowfullscreen></iframe></div>';
	}
	
/**
 * Vimeo
**/
add_shortcode('vimeo', 'shortcode_vimeo');
	function shortcode_vimeo($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'width' => 590,
				'height' => 442
			), $atts);
		
			return '<div class="video-shortcode"><iframe src="http://player.vimeo.com/video/' . $atts['id'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '" frameborder="0"></iframe></div>';
	}


/* Portfolio image */

add_shortcode('portgallery', 'shortcode_portgallery');
function shortcode_portgallery($atts) {
	
	$atts = shortcode_atts(
			array(
				'type' => ''
			), $atts);
		
	global $post;
	
	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );	
	$output = '';
	
	if ($attachments) {	
	
		if ($atts['type'] == 'slider') :
		
		$output .= '<div class="slider-wrapper flex-shortcode">
                	<div class="flexslider">
                    	<ul class="slides">';
		
		foreach ( $attachments as $attachment_id => $attachment ) {
			$output .= '<li>';
			$output .= wp_get_attachment_image( $attachment->ID, 'portfolio-single' );
			$output .= '</li>';			
		}
		
		$output .= '</ul></div></div><!-- .slider-wrapper -->';
		$output .= '<script type="text/javascript" src="'. get_template_directory_uri(). '/js/jquery.flexslider-min.js"></script>';
			$output .= "<script type=\"text/javascript\">
				jQuery(window).load(function() {
					jQuery('.flexslider').flexslider({
						animation: 'fade',
						slideshowSpeed: 7000,
						animationDuration: 600,
						directionNav: false,
						slideshow: false
					});
				});
				</script>";
		
		else :
				
		foreach ( $attachments as $attachment_id => $attachment ) {
			$output .= '<p class="portfolio-img">';
			$output .= wp_get_attachment_image( $attachment->ID, 'portfolio-single' );
			if ($attachment->post_content) :
				$output .= '<span >'.$attachment->post_content.'</span>';
			endif;
			$output .= '</p>';
		}
		
		endif;
		
		return $output;	
	}
}

/**
* Add buttons to tinyMCE
**/
/*add_action('init', 'add_button');

function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons_3', 'register_button');  
   }  
}  

function register_button($buttons) {  
   array_push($buttons, "button", "arrowlist", "dropcap", "one_half", "one_third", "googlemap", "tabs", "toggle", "youtube", "vimeo");  
   return $buttons;  
}  

function add_plugin($plugin_array) {
	$plugin_array['button'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';  
   	$plugin_array['dropcap'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
   	$plugin_array['arrowlist'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
	$plugin_array['one_half'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
	$plugin_array['one_third'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
   	$plugin_array['googlemap'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
	$plugin_array['tabs'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
   	$plugin_array['toggle'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
   	$plugin_array['youtube'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
   	$plugin_array['vimeo'] = get_template_directory_uri().'/extensions/tinymce/customcodes.js';
	return $plugin_array;  
}*/

?>