<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */
?>
		</div><!-- .col-width -->
	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
    	<div class="col-width">
        	 <?php if ( is_active_sidebar('footer-1') ||
			   	is_active_sidebar('footer-2') ||
				is_active_sidebar('footer-3') ||  
			    is_active_sidebar('footer-4')) : ?>
                
           <div id="footer-widgets">

				<?php $i = 0; while ( $i <= 4 ) : $i++; ?>			
                    <?php if ( is_active_sidebar('footer-'.$i) ) { ?>
        
                <div id="footer-widget-<?php echo $i; ?>" class="footer-widget">
                    <ul class="xoxo">
                    <?php dynamic_sidebar('footer-'.$i); ?>
                    </ul>    
                </div>

                <?php } endwhile; ?>                                
                
            </div><!-- /#footer-widgets  -->
            
            <?php endif; ?>
            
            <div id="site-generator">
            	<?php if ( $footer = of_get_option('footer_text', 0) ) {
					echo $footer;
				} else {
					_e( '&copy; 2017 | All rights reserved. | ', 'mojitos' ); ?><a href="<?php echo esc_url( __( 'http://www.omniveo.com', 'mojitos' ) ); ?>" title="<?php esc_attr_e( 'Visita Virtual Enriquecida', 'mojitos' ); ?>" rel="generator"><?php _e( 'OmniVeo', 'mojitos' ); ?></a>
                <?php } ?>
                <span class="back-to-top"><a><?php _e('Back to top', 'mojitos'); ?></a></span>
			</div><!-- #site-generator -->
            
         </div><!-- .col-width -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>