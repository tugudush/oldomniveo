<?php
/*-----------------------------------------------------------------------------------*/
/* List Portfolio Custom post type Widget
/*-----------------------------------------------------------------------------------*/
 /*
 	    --------------------------------------------------------------------
		Credit
		--------------------------------------------------------------------
		Plugin Name: Custom Post Type List Widget
		Version: 1.1
		Contributors: Keith P. Graham		
		--------------------------------------------------------------------
		Notes
		--------------------------------------------------------------------
		- This version of List Custom Post type widget has been modified
 
*/
/* Add function to widgets_init that'll load the widget */
 
class ATM_list_cpt extends WP_Widget {
	
	/* List Categories */		
    function ATM_list_cpt() {
      
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_list_portfolio', 'description' => 'A list of portfolio' );
	
		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'widget_list_portfolio' );
	
		/* Create the widget. */
		$this->WP_Widget( 'widget_list_portfolio', 'Portfolio Widget', $widget_ops, $control_ops );	
    }

	/**
	 * How to display the widget on the screen.
	 **/
    function widget($args, $instance) {	
		extract( $args );
		
		$title = $instance['title'];
		$post_type = 'portfolio';
		$orderby = $instance['orderby'];
		$maxlines = $instance['maxlines'];
		$post_thumb = $instance['post_thumb'];
		
		$sort=$orderby;
		
		if ($sort=='random') 
			$sort='ID';
		
		$datelimit='';
		
	    $items= kpg_cpl_get_results($sort,$post_type);
		
		$out='';
		
		if (empty($items)) { return '<!-- no custom post shortcode results returned -->'; }
		
		if ($orderby=='random') { shuffle($items); }
		
		// now go through the list
		$max=$maxlines;
		if ( $maxlines==0||$maxlines==-1 ) { $max=count($items); }
		
		$out='';
		global $wp_query;
		$thePostID = $wp_query->post->ID;		

		foreach ($items as $post) {
			$max--;
			if ($max<0) break;
			$post_title = wp_specialchars(qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($post->post_title));
//			$post_title = $post->post_title;
			$comment_count=$post->comment_count;
			$ID=$post->ID;
			$cpi='';
			if ($thePostID==$ID) {
			   $cpi=' current_page_item';
			}
			$post_link=get_permalink($ID);
//			if(qtrans_getLanguage() == "es") $post_link.="?lang=es";
//			qtrans_convertURL($post_link, "es");

//			lmb: the below line changed from & to ? after going to permalinks
			$post_link.="?lang=".qtrans_getLanguage();
			$post_author=$post->post_author;
			$authordata = get_userdata( $post_author );
			$post_author=$authordata->display_name;
			if (empty($post_author)) { $post_author=$authordata->user_nicename; }
			if (empty($post_author)) { $post_author='anonymous'; }
						
		    $thumbsize = 'portfolio-thumbnail';
			if ( $post_thumb == "large" ) :
				$thumbsize = 'portfolio-thumbnail-large';
			elseif ( $post_thumb == "none" ) :
				$thumbsize = '';
			else :
				$thumbsize = 'portfolio-thumbnail';
			endif;
			
			$out.= "\r\n<li class=\"portfolio_list_item$cpi $thumbsize\"><a href=\"$post_link\" title=\"$post_title\" alt=\"$post_title\" >";
			
			if( $thumbsize != '')
				$out.= get_the_post_thumbnail($ID,$thumbsize);
		
			$out.= "$post_title</a></li>";
			
		}
		
		echo $before_widget;
			
			if ( $title) { echo $before_title . $title . $after_title; }
				echo "<ul>".$out."</ul>"; 
						
		echo $after_widget;		
	}
		
    /**
	 * Update
	 **/
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;		
		return $new_instance;
	}
   
   /**
	 * Displays the widget settings controls on the widget panel.

	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Portfolio', 'post_type' => 'portfolio', 'maxlines' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults ); 			
       ?>       
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
        <p>
				<label for="<?php echo $this->get_field_id( 'maxlines' ); ?>">No. of portfolio to show:</label>
				<input id="<?php echo $this->get_field_id( 'maxlines' ); ?>" name="<?php echo $this->get_field_name( 'maxlines' ); ?>" value="<?php echo $instance['maxlines']; ?>" size="3" type="text" /><br />"0" mean All post<p>
			</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'post_thumb' ); ?>">Image</label>
			<select id="<?php echo $this->get_field_id('post_thumb'); ?>" name="<?php echo $this->get_field_name('post_thumb'); ?>" class="widefat">
                <option value="thumb"<?php selected( $instance['post_thumb'], 'thumb' ); ?>>Thumbnail</option>
                <option value="large"<?php selected( $instance['post_thumb'], 'large' ); ?>>Large</option>
                <option value="none"<?php selected( $instance['post_thumb'], 'none' ); ?>>None</option>
            </select>	
		</p> 	   
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order by:</label>
			<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" class="widefat">
                <option value="post_date desc"<?php selected( $instance['orderby'], 'post_date desc' ); ?>>Date (Newest first)</option>
                <option value="post_date"<?php selected( $instance['orderby'], 'post_date' ); ?>>Date (oldest first)</option>
                <option value="upper(post_title)"<?php selected( $instance['orderby'], 'upper(post_title)' ); ?>>Alphabetical Title</option>
                <option value="random"<?php selected( $instance['orderby'], 'random' ); ?>>Random</option>
                <option value="comment_count desc,post_date desc"<?php selected( $instance['orderby'], 'comment_count desc,post_date desc' ); ?>>Number of Comments</option>
            </select>	
		</p>
<?php
	
	}

}

function kpg_cpl_get_results($sort,$post_type) {
	global $wpdb;
	$dd='';
	if (!empty($datelimit)) {
		
		$dd=" AND POST_DATE>DATE('$datelimit')" ;
	}
	$sql="SELECT ID,post_title,post_author,comment_count, post_date, menu_order, post_modified FROM ".$wpdb->posts." WHERE post_status = 'publish' $dd and post_type='$post_type' ORDER by $sort";
	;
	
	$results=$wpdb->get_results($sql);
	return $results;
}
		
/*-----------------------------------------------------------------------------------*/
/* Twitter widget
/*-----------------------------------------------------------------------------------*/

	/**
	 * Twitter Class
	 **/
	class ATM_Twitter extends WP_Widget {
		
		/**
		 * Twitter
		 **/
		function ATM_Twitter() {
			/* Widget settings. */
			$widget_ops = array( 'classname' => 'widget_twitter', 'description' => 'A list of latest tweets' );
	
			/* Widget control settings. */
			$control_ops = array( 'id_base' => 'widget_twitter' );
	
			/* Create the widget. */
			$this->WP_Widget( 'widget_twitter', 'Twitter Widget', $widget_ops, $control_ops );
		}
		
		/**
		 * Widget
		 **/
		function widget( $args, $instance ) {
			extract( $args );
	
			/* User-selected settings. */
			$title = apply_filters('widget_title', $instance['title'] );
			$username = of_get_option('twitter_user');
			$show_count = $instance['show_count'];
			$show_follow = isset( $instance['show_follow'] ) ? $instance['show_follow'] : false;
	
			/* Before widget (defined by themes). */
			echo $before_widget;
	
			/* Title of widget (before and after defined by themes). */
			if ( $title )
				echo $before_title . $title . $after_title;
			
			// Display Latest Tweets
			 ?>				
				
					<ul id="twitter_update_list">
						<li>&nbsp;</li>
					</ul>					
				
				
                <script type="text/javascript">
				jQuery(document).ready(function($){
					$.getJSON('http://api.twitter.com/1/statuses/user_timeline//<?php echo $username ?>.json?count=<?php echo $show_count ?>&callback=?', function(tweets){
						$("#twitter_update_list").html(twitter_callback(tweets));
					});
				});
				</script>
			
			<?php 
			
			if ( $show_follow ) echo '<div class="box-link follow-user"><a target="_blank" href="http://twitter.com/' . $username . '">' . $instance['follow_text'] . '</a></div>';
	
			/* After widget (defined by themes). */
			echo $after_widget;
		}
		
		/**
		 * Update
		 **/
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;	
			/* Strip tags (if needed) and update the widget settings. */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['username'] = $new_instance['username'];
			$instance['show_count'] = $new_instance['show_count'];
			$instance['show_follow'] = $new_instance['show_follow'];
			$instance['follow_text'] = $new_instance['follow_text'];
	
			return $instance;
		}
		
		/**
		 * Form
		 **/
		function form( $instance ) {
	
			/* Set up some default widget settings. */
			$defaults = array( 'title' => 'Latest Tweets', 'username' => '', 'show_count' => 10, 'hide_timestamp' => false, 'hide_url' => false, 'show_follow' => true , 'follow_text' => 'Follow me' );
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'show_count' ); ?>">Show:</label>
				<input id="<?php echo $this->get_field_id( 'show_count' ); ?>" name="<?php echo $this->get_field_name( 'show_count' ); ?>" value="<?php echo $instance['show_count']; ?>" size="3" type="text" /> tweets
			</p>
			
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $instance['show_follow'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_follow' ); ?>" name="<?php echo $this->get_field_name( 'show_follow' ); ?>" />
				<label for="<?php echo $this->get_field_id( 'show_follow' ); ?>">Display follow me button</label>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id( 'follow_text' ); ?>">Follow me text:</label>
				<input id="<?php echo $this->get_field_id( 'follow_text' ); ?>" name="<?php echo $this->get_field_name( 'follow_text' ); ?>" value="<?php echo $instance['follow_text']; ?>" class="widefat" type="text" />
			</p>
				
			
			<?php
		}
	}

/*-----------------------------------------------------------------------------------*/
/* googlemap Widget
/*-----------------------------------------------------------------------------------*/

class ATM_googlemap extends WP_Widget {

	// constructor
	function ATM_googlemap() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_googlemap', 'description' => 'Add a google map to your site' );
		
		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'widget_googlemap' );
	
		/* Create the widget. */
		$this->WP_Widget( 'widget_googlemap', 'Googlemap Widget', $widget_ops, $control_ops );
	}
	
	// output the content of the widget
	function widget($args, $instance) {		
		extract( $args );
		
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$lat = $instance['lat'];
		$lng = $instance['lng'];
		$zoom = $instance['zoom'];
		$type = $instance['type'];
		$icon = $instance['icon'];
		$icon_w = $instance['icon_w'];
		$icon_h = $instance['icon_h'];
		$content = $instance['content'];
		
		function printmap($lat,$lng,$icon,$icon_w,$icon_h,$type,$zoom) {
			
		  $id = time();
		  
		  if ($icon != '') :
		  
		  $map = '<div id="map'.$id.'" class="googlemap-container"></div>
		   <script>
		   jQuery(document).ready(function(){ 
			jQuery("#map'.$id.'").gMap({
				markers: [ { 
					latitude: '.$lat.',
					longitude: '.$lng.'} ],
				icon: { image: \''.$icon.'\', iconsize: ['.$icon_w.', '.$icon_h.'], shadow:"'. get_template_directory_uri() .'/images/map-shadow.gif" }, 
				maptype: google.maps.'.$type.',
				mapTypeControl:false,
				streetViewControl:false,
				zoom: '.$zoom.'}); 
			});
			</script>';
			
			else :
			
			$map = '<div id="map'.$id.'" class="googlemap-container"></div>
		   <script>
		   jQuery(document).ready(function(){ 
			jQuery("#map'.$id.'").gMap({
				markers: [ { 
					latitude: '.$lat.',
					longitude: '.$lng.'} ], 
				maptype: google.maps.'.$type.',
				mapTypeControl:false,
				streetViewControl:false,
				zoom: '.$zoom.'}); 
			});
			</script>';
			
			endif;
   
		   return $map;
		}
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		echo printmap($lat, $lng, $icon, $icon_w, $icon_h, $type, $zoom);
	
		/* Title of widget (before and after defined by themes). */
		if ( $title )
		echo $before_title . $title . $after_title;
		echo nl2br($content);	
		/* After widget (defined by themes). */
		echo $after_widget;

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;						
		return $new_instance;
	}
	
	// output the options form on admin
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Address', 'lat' => '', 'lng' => '', 'zoom' => '15' , 'icon' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</p>
			<p>
			<label for="<?php echo $this->get_field_id('lat'); ?>">Latitude:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('lat'); ?>" name="<?php echo $this->get_field_name('lat'); ?>" type="text" value="<?php echo $instance['lat']; ?>" />
			</p>
			<p>
			<label for="<?php echo $this->get_field_id('lng'); ?>">Longitude:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('lng'); ?>" name="<?php echo $this->get_field_name('lng'); ?>" type="text" value="<?php echo $instance['lng']; ?>" />
			</p>
			<p>
			<label for="<?php echo $this->get_field_id('zoom'); ?>">Zoom Level: (1-19)</label>
			<input class="widefat" id="<?php echo $this->get_field_id('zoom'); ?>" name="<?php echo $this->get_field_name('zoom'); ?>" type="text" value="<?php echo $instance['zoom']; ?>" />
			</p>
            <p>
			<label for="<?php echo $this->get_field_id('type'); ?>">Map Type:</label>
			<select id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>" class="widefat">
                <option value="MapTypeId.ROADMAP"<?php selected( $instance['type'], 'MapTypeId.ROADMAP' ); ?>>Roadmap</option>
                <option value="MapTypeId.SATELLITE"<?php selected( $instance['type'], 'MapTypeId.SATELLITE' ); ?>>Satellite</option>
                <option value="MapTypeId.HYBRID"<?php selected( $instance['type'], 'MapTypeId.HYBRID' ); ?>>Hybrid</option>
                <option value="MapTypeId.TERRAIN"<?php selected( $instance['type'], 'MapTypeId.TERRAIN' ); ?>>Terrian</option>
            </select>	
		   </p>
			<p>
			<label for="<?php echo $this->get_field_id('icon'); ?>">Icon</label>
			<input class="widefat" id="<?php echo $this->get_field_id('icon'); ?>" name="<?php echo $this->get_field_name('icon'); ?>" type="text" value="<?php echo $instance['icon']; ?>" />
			</p>
            <p>
			<label for="<?php echo $this->get_field_id('icon_w'); ?>">Icon width</label>
			<input class="widefat" id="<?php echo $this->get_field_id('icon_w'); ?>" name="<?php echo $this->get_field_name('icon_w'); ?>" type="text" value="<?php echo $instance['icon_w']; ?>" />
			</p>
            <p>
			<label for="<?php echo $this->get_field_id('icon_h'); ?>">Icon Height</label>
			<input class="widefat" id="<?php echo $this->get_field_id('icon_h'); ?>" name="<?php echo $this->get_field_name('icon_h'); ?>" type="text" value="<?php echo $instance['icon_h']; ?>" />
			</p>			
			<p>
			<label for="<?php echo $this->get_field_id('content'); ?>">Content</label>
			<textarea rows="7" class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $instance['content']; ?></textarea>
			</p>
		<?php 
	}
	
} // googlemap widget

/*-----------------------------------------------------------------------------------*/
/* Social link Widget
/*-----------------------------------------------------------------------------------*/

class ATM_social extends WP_Widget {

	// constructor
	function ATM_social() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_social', 'description' => 'Add a social link to your site' );
		
		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'widget_social' );
	
		/* Create the widget. */
		$this->WP_Widget( 'widget_social', 'Social Link Widget', $widget_ops, $control_ops );
	}
	
	// output the content of the widget
	function widget($args, $instance) {		
		extract( $args );
		
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		
		function socialLink() {
			
			$facebook = of_get_option('facebook_user');
            $twitter = of_get_option('twitter_user');
            $dribbble = of_get_option('dribbble_user');
			$forrst = of_get_option('forrst_user');
			$flickr = of_get_option('flickr_user');
		 	$googleplus = of_get_option('googleplus_user');
			$vimeo = of_get_option('vimeo_user');
			$youtube = of_get_option('youtube_user');
			$linkedin = of_get_option('linkedin_user');
            $sociallist =	'<ul>';
			if (  $facebook ) $sociallist .= '<li><a class="facebook" title="facebook" href="http://facebook.com/'. $facebook. '">facebook</a></li>';
            if (  $twitter ) $sociallist .= '<li><a class="twitter" title="twitter" href="http://twitter.com/' . $twitter . '">twitter</a></li>';
            if (  $dribbble ) $sociallist .= '<li><a class="dribbble" title="dribbble" href="http://drbbble.com/'. $dribbble. '">dribbble</a></li>';
			if (  $forrst )$sociallist .= '<li><a class="forrst" title="forrst" href="http://forrst.com/people/'. $forrst. '">forrst</a></li>';
			if (  $flickr ) $sociallist .= '<li><a class="flickr" title="flickr" href="http://flickr.com/'. $flickr. '">flickr</a></li>';
			if (  $googleplus ) $sociallist .= '<li><a class="googleplus" title="googleplus" href="https://plus.google.com/'. $googleplus. '">googleplus</a></li>';
			if (  $vimeo ) $sociallist .= '<li><a class="vimeo" title="vimeo" href="http://vimeo.com/'. $vimeo. '">vimeo</a></li>';
			if (  $youtube ) $sociallist .= '<li><a class="youtube" title="youtube" href="http://youtube.com/'. $youtube. '">youtube</a></li>';
			if (  $linkedin ) $sociallist .= '<li><a class="linkedin" title="linkedin" href="'. $linkedin. '">linkedin</a></li>';
             $sociallist .= '</ul>';
			
			echo $sociallist;
		  
		}
		
		/* Before widget (defined by themes). */
		echo $before_widget;
			
		/* Title of widget (before and after defined by themes). */
		if ( $title )
		echo $before_title . $title . $after_title;
		
		socialLink();
		
		/* After widget (defined by themes). */
		echo $after_widget;

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;						
		return $new_instance;
	}
	
	// output the options form on admin
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Follow Us' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</p>
			
		<?php 
	}
	
} // social link widget

/*-----------------------------------------------------------------------------------*/
/* Testimonial Widget
/*-----------------------------------------------------------------------------------*/

class ATM_testimonial extends WP_Widget {

	// constructor
	function ATM_testimonial() {
		/* Widget settings. */
		$widget_ops = array('classname' => 'widget_testimonial', 'description' => 'Add a testimonial to page' );
		
		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'widget_testimonial' );
	
		/* Create the widget. */
		$this->WP_Widget( 'widget_testimonial', 'Testimonial Widget', $widget_ops, $control_ops );
	}
	
	// output the content of the widget
	function widget($args, $instance) {		
		extract( $args );
		
		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$testimonial = $instance['testimonial'];
		
		function testimonial($testimonial_id) {
			
               $test_query = new WP_Query( 'post_type=testimonial&p='.$testimonial_id ); 
			   if ($test_query->have_posts()) : $test_query->the_post();
			   $company = get_post_meta( get_the_ID() , '_testimonial_company', true );
			   ?>                          
						 <div>
                            <div class="client-say"><?php the_content(); ?></div><!-- .client-say -->
                            <span class="client-name">- <?php the_title();  ?></span>
                            <span class="client-company"><?php echo ($company) ? $company:'' ; ?>
                            </span>
                            
                          </div>
			
			<?php endif; wp_reset_query(); 
		  
		}
		
		/* Before widget (defined by themes). */
		echo $before_widget;
			
		/* Title of widget (before and after defined by themes). */
		if ( $title )
		echo $before_title . $title . $after_title;
		
		testimonial($testimonial); 
		
		/* After widget (defined by themes). */
		echo $after_widget;

	}
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;						
		return $new_instance;
	}
	
	// output the options form on admin
	function form($instance) {
		
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Testimonial' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
			<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</p>
            <p>
			<label for="<?php echo $this->get_field_id('testimonial'); ?>">Title:</label>
            <select id="<?php echo $this->get_field_id('testimonial'); ?>" name="<?php echo $this->get_field_name('testimonial'); ?>" class="widefat">
			<?php
            $testf_query = new WP_Query( 'post_type=testimonial&posts_per_page=-1' );             
            while( $testf_query->have_posts() ) : $testf_query->the_post(); ?>
                <option value="<?php echo get_the_ID(); ?>"<?php selected( $instance['testimonial'], get_the_ID() ); ?>><?php the_title(); ?></option>
            <?php endwhile; wp_reset_query();  ?>
            </select>			
			</p>			
		<?php 
	}
	
} // testimonial link widget
	
function register_theme_widget() {
	register_widget( 'ATM_Twitter' );
	register_widget( 'ATM_list_cpt' );
	register_widget( 'ATM_googlemap' );
	register_widget( 'ATM_social' );
	register_widget( 'ATM_testimonial' );	
}
add_action( 'widgets_init', 'register_theme_widget' );
?>