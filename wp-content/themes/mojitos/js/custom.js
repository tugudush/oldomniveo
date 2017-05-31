jQuery(document).ready(function() {
	
	jQuery('.back-to-top a').click(function(){ 
		jQuery('html, body').animate({ scrollTop: 0 }, 'fast');
	});
	
	// Toggle Slides	
	jQuery(function(){ // run after page loads
			jQuery(".toggle_container").hide(); 
			//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			jQuery("p.trigger").click(function(){
				jQuery(this).toggleClass("active").next().slideToggle();
				return false; //Prevent the browser jump to the link anchor
			});
	});
	
	// valid XHTML method of target_blank
	jQuery(function(){ // run after page loads
		jQuery('a[rel*=external]').click( function() {
			window.open(this.href);
			return false;
		});
	});


	/* Tabs Activiation
	================================================== */
	var tabs = jQuery('ul.tabs');
	tabs.each(function(i) {
		//Get all tabs
		var tab = jQuery(this).find('> li > a');
		jQuery("ul.tabs li:first").addClass("active").fadeIn('fast'); //Activate first tab
		jQuery("ul.tabs li:first a").addClass("active").fadeIn('fast'); //Activate first tab
		jQuery("ul.tabs-content li:first").addClass("active").fadeIn('fast'); //Activate first tab
		
		tab.click(function(e) {
			
			//Get Location of tab's content
			var contentLocation = jQuery(this).attr('href') + "Tab";
			
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				tab.removeClass('active');
				jQuery(this).addClass('active');
				
				//Show Tab Content & add active class
				jQuery(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
				
			} 
		});
	}); 

});