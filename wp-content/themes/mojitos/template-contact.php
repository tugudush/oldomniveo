<?php
/**
 * @package WordPress
 * @subpackage Mojitos
 * Template Name: Contact page
 * Description: Contact form
 */
get_header(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/contact.js"></script>
                <header class="page-title">
                    <div class="col-width">
                        <h1><?php the_title(); ?></h1>
                    </div><!-- .col-width -->
                </header><!-- .entry-header -->
				<div class="col-width">	
                <div id="primary">
                      <div id="content">
                      	<div class="col-2-box box">
    					
                        <?php the_post(); ?>
                        <?php the_content(); ?>
                
                <p id="success" class="successmsg hidden"><span><?php _e('Your email has been sent! Thank you!', 'mojitos'); ?></span></p>
				<p id="bademail" class="errormsg hidden"><span><?php _e('Please enter your name, a message and a valid email address.', 'mojitos'); ?></span></p>
				<p id="badserver" class="errormsg hidden"><span><?php _e('Your email failed. Try again later.', 'mojitos'); ?></span></p>
                
				<form id="contact" action="<?php echo get_template_directory_uri(); ?>/sendmail.php" method="post"> 
					<fieldset> 
						<p><label for="name"><?php _e('Name', 'mojitos'); ?></label> <span class="required">*</span>
						<input name="name" type="text" class="txt" id="nameinput"  /></p> 
			
						<p><label for="email"><?php _e('Email', 'mojitos'); ?></label> <span class="required">*</span>
						<input name="email" type="text" class="txt" id="emailinput"  /></p> 
			
						<p><label for="message"><?php _e('Message', 'mojitos'); ?></label> 
						<textarea name="message" id="message" rows="5" cols="45" ></textarea> </p>
						
                        <p><input type="submit" id="submit" name="submit" class="submit" value="<?php _e('Send', 'mojitos'); ?>"/></p>
                        <input type="hidden" id="receiver" name="receiver" value="<?php echo strhex(of_get_option('contact_email'))?>"/>
                        <input type="hidden" id="blogname" name="blogname" value="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"/> 
			
					</fieldset> 
				</form>
                
            	</div><!-- #contact -->
			</div><!-- #content -->
		</div><!-- #primary -->
    

<?php get_sidebar(); ?>
<?php get_footer(); ?>