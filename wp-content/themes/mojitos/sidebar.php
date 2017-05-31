<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */
?>
		<div id="secondary" class="widget-area" role="complementary">
        
        	<?php if (is_single()) : global $blog_page;  ?>
            
            	<div class="control-nav single-page">
                <a class="view-all" href="<?php echo get_permalink( $blog_page ); ?>"><?php _e( 'back to main', 'mojitos' ); ?></a>
                <span class="previous-entry"><?php previous_post_link('%link') ?></span><span class="next-entry"><?php next_post_link('%link'); ?></span>
                </div><!-- .control-nav -->
            
            <?php endif; ?>
			
            <?php if ( is_page_template('template-contact.php') ) : 
					 					 
					 if (!dynamic_sidebar( 'contact-sidebar' )):
					 		dynamic_sidebar( 'sidebar' );
					
					 endif;
					 
			?>	 
            <?php elseif (  is_page() ) : 
					 
					 if (!dynamic_sidebar( 'page-sidebar' )):
					 		dynamic_sidebar( 'sidebar' );
					
					 endif;

			?>        
			<?php elseif ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'mojitos' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'mojitos' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
            
		</div><!-- #secondary .widget-area -->
