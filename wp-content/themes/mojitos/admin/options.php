<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses 'mojitos'.  If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {
	
	/*$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'mojitos';
	update_option('optionsframework', $optionsframework_settings);*/
	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
		
	// Number data
	$number_array = array("2" => "2","3" => "3","4" => "4","5" => "5","6" => "6");
	
	// Number data
	$portcol_array = array("1" => "1","3" => "3","4" => "4");
	
	$slider_style_array = array("fade" => "Fade","slide" => "Slide");
	
	// Slide data
	$slide_type_array = array("carousel" => "Carousel","slider" => "Slider");
	
	// Background Defaults	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	// Pull all the portfolio tag an array
	$options_portfoliotag = array();  
	$options_portfoliotag_obj = get_categories('taxonomy=portfolio_tag');
	$options_portfoliotag[''] = 'Recent portfolio';
	foreach ($options_portfoliotag_obj as $portfoliotag) {
    	$options_portfoliotag[$portfoliotag->cat_ID] = $portfoliotag->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
	//Stylesheets Reader
	$alt_stylesheet_path = TEMPLATEPATH . '/styles/';
	$alt_stylesheets = array();
	
	if ( is_dir($alt_stylesheet_path) ) {
		if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
			while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
				if(stristr($alt_stylesheet_file, ".css") !== false) {
					$alt_stylesheets[$alt_stylesheet_file] = $alt_stylesheet_file;
				}
			}    
		}
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';
	
	// Options array	
	$options = array();
		
	$options[] = array( "name" => __('General Settings','mojitos'),
                    	"type" => "heading");
						
	$options[] = array( "name" => __('Custom Logo','mojitos'),
						"desc" => __('Upload a logo for your site.','mojitos'),
						"id" => "logo",
						"type" => "upload");
						
	$options[] = array( "name" => __('Custom Favicon','mojitos'),
						"desc" => __('Upload a 16px x 16px Png/Gif image to represent your site.','mojitos'),
						"id" => "custom_favicon",
						"std" => "",
						"type" => "upload");
						
	$options[] = array( "name" => __('Display Site Tagline','mojitos'),
						"desc" => __('Display the site tagline under the site title.','mojitos'),
						"id" => "tagline",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Contact email','mojitos'),
						"desc" => __('Email Address for Contact Form','mojitos'),
						"id" => "contact_email",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Portfolio all portfolio text','mojitos'),
						"desc" => "Display label for show all portfolio",
						"id" => "filter_default",
						"std" => "All",
						"type" => "text");
						
	$options[] = array( "name" => __('Portfolio columns','mojitos'),
						"desc" => __('Select number of column of portfolio','mojitos'),
						"id" => "column_no",
						"std" => "4",
						"type" => "select",
						"options" => $portcol_array);     
						
	$options[] = array( "name" => __('Tracking Code','mojitos'),
						"desc" => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','mojitos'),
						"id" => "google_analytics",
						"std" => "",
						"type" => "textarea");
						
	$options[] = array( "name" => __('Homepage Settings','mojitos'),
                    	"type" => "heading");
						
	$options[] = array( "name" => __('Site introduction Page','mojitos'),
						"desc" => __('Select the page to use as a site introduction page, This page will appear in the top of your homepage.','mojitos'),
						"id" => "site_intro_page",
						"std" => "Select a page:",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => __('Portfolio Title','mojitos'),
						"desc" => __('Enter the title of the portfolio area.','mojitos'),
						"id" => "portfolio_title",
						"std" => "Latest Projects",
						"type" => "text");
						
	$options[] = array( "name" => __('Portfolio Page','mojitos'),
						"desc" => __('Select the page to use as a portfolio, this will be use for the portfolio link.','mojitos'),
						"id" => "portfolio_page",
						"std" => "Select a page:",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => __('Feature box Title','mojitos'),
						"desc" => __('Enter the title of the feature box on homepage.','mojitos'),
						"id" => "feature_box_title",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Featured 1 Column','mojitos'),
						"desc" => __('Select the page to use as a first featured column','mojitos'),
						"id" => "featured_page_1",
						"std" => "Select a page:",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => __('Featured 2 Column','mojitos'),
						"desc" => __('Select the page to use as a second featured column.','mojitos'),
						"id" => "featured_page_2",
						"std" => "Select a page:",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => __('Featured 3 Column','mojitos'),
						"desc" => __('Select the page to use as a third featured column.','mojitos'),
						"id" => "featured_page_3",
						"std" => "Select a page:",
						"type" => "select",
						"options" => $options_pages);
						
	$options[] = array( "name" => __('Recent Post Title','mojitos'),
						"desc" => __('Enter the title of the latest posts area.','mojitos'),
						"id" => "latest_title",
						"std" => "Latest Posts",
						"type" => "text");
						
	$options[] = array( "name" => __('Blog Page','mojitos'),
						"desc" => __('Select the page to use as a blog, this will be used for the blog link.','mojitos'),
						"id" => "blog_page",
						"std" => "Select a page:",
						"type" => "select",
						"options" => $options_pages);																
						
	$options[] = array( "name" => __('Slideshow Settings','mojitos'),
                    	"type" => "heading");
						
	$options[] = array( "name" => __('Homepage type','mojitos'),
						"desc" => __('Select option according your homepage style (Carousel or Slideshow).','mojitos'),
						"id" => "slide_type",
						"std" => "",
						"type" => "radio",
						"options" => $slide_type_array);
						
	$options[] = array( "name" => __('Number of slide','mojitos'),
						"desc" => __('Number of slide to be display on slider.','mojitos'),
						"id" => "slider_number",
						"std" => "5",
						"type" => "select",
						"options" => $number_array);
						
	$options[] = array( "name" => __('Slider style','mojitos'),
						"desc" => __('Style of slider fade or slide.','mojitos'),
						"id" => "slider_effect",
						"std" => "fade",
						"type" => "select",
						"options" => $slider_style_array);
						
	$options[] = array( "name" => __('Slide item style','mojitos'),
						"desc" => __('Enable to slide item as a group.','mojitos'),
						"id" => "slide_item",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Select a Portfolio set','mojitos'),
						"desc" => __('Select which set of portfolio to be display, default is recently portfolio.','mojitos'),
						"id" => "slide_option",
						"type" => "select",
						"options" => $options_portfoliotag);				                                                 
    
	$options[] = array( "name" => __('Style and Layout','mojitos'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Theme Stylesheet','mojitos'),
						"desc" => __('Theme switching. If you want to have another new theme style, you can create new css file in styles folder.','mojitos'),
						"id" => "alt_stylesheet",
						"std" => "default.css",
						"type" => "select",
						"options" => $alt_stylesheets);
	
	$options[] = array( "name" => __('Layout','mojitos'),
						"desc" => __('Select a site layout: sidebar right, sidebar left, or no sidebar.','mojitos'),
						"id" => "layout",
						"std" => "layout-2cr",
						"type" => "images",
						"options" => array(
						'layout-2cr' => $imagepath . '2cr.png',
						'layout-2cl' => $imagepath . '2cl.png')
						);
					
	$options[] = array( "name" => __('Custom CSS','mojitos'),
						"desc" => __('Quickly add some CSS to your theme by adding it to this block.','mojitos'),
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea");
						
	/*$options[] = array( "name" => __('Header Background','mojitos'),
						"desc" => __('Change the header background style.','mojitos'),
						"id" => "header_background",
						"std" => "#373f4c", 
						"type" => "background");*/
						
	$options[] = array( "name" => __('Body Background','mojitos'),
						"desc" => __('Change the whole page background style.','mojitos'),
						"id" => "body_background",
						"std" => "#edeae3", 
						"type" => "background");
						
	/*$options[] = array( "name" => __('Main Color','mojitos'),
						"desc" => __('Change the whole page text style.','mojitos'),
						"id" => "body_text",
						"std" => "#edeae3", 
						"type" => "color");*/
				
	$options[] = array( "name" => __('Social Links','mojitos'),
						"type" => "heading");
						
	$options[] = array( "name" => __('Facebook','mojitos'),
						"desc" => __('Username eg. addtwomore','mojitos'),
						"id" => "facebook_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Twitter','mojitos'),
						"desc" => __('Username or ID eg. addtwomore','mojitos'),
						"id" => "twitter_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Dribbble','mojitos'),
						"desc" => __('Username or ID eg. addtwomore','mojitos'),
						"id" => "dribbble_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Forrst','mojitos'),
						"desc" => __('Username or ID eg. addtwomore','mojitos'),
						"id" => "forrst_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Flickr','mojitos'),
						"desc" => __('Username or ID eg. addtwomore','mojitos'),
						"id" => "flickr_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Googleplus','mojitos'),
						"desc" => __('Username or ID eg. addtwomore','mojitos'),
						"id" => "googleplus_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Vimeo','mojitos'),
						"desc" => __('Username or ID eg. addtwomore','mojitos'),
						"id" => "vimeo_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Youtube','mojitos'),
						"desc" => __('Username or ID eg. addtwomore','mojitos'),
						"id" => "youtube_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Linkedin','mojitos'),
						"desc" => __('Insery Linkedin public profile eg. http://www.linkedin.com/pub/addtwomore/1a/b0/28a','mojitos'),
						"id" => "linkedin_user",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __('Footer settings','mojitos'),
						"type" => "heading");
	
	$options[] = array( "name" => __('Footer text color','mojitos'),
						"desc" => __('Color of text in footer','mojitos'),
						"id" => "color_ft",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => __('Link','mojitos'),
						"desc" => __('Color of link in footer','mojitos'),
						"id" => "color_ft_a",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => __('Link hover','mojitos'),
						"desc" => __('Color of link when hover','mojitos'),
						"id" => "color_ft_a_hover",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => __('Custom Footer Text','mojitos'),
						"desc" => __('Custom HTML/Text that will appear in the footer of your theme. (Copyright &copy; addtwomore)','mojitos'),
						"id" => "footer_text",
						"std" => "",
						"type" => "textarea");
						
	return $options;
}