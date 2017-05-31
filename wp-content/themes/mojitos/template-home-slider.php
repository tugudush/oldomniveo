<?php
/**
 * @package WordPress
 * @subpackage Mojitos
 * Template Name: Homepage with silder.
 */

get_header(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>

		<header class="page-title">
        	<div class="col-width">
                <h1><?php echo of_get_option('portfolio_title'); ?></h1>
            </div><!-- .col-width -->
		</header><!-- .entry-header -->
        <div class="col-width">		
            <div id="primary">            	
                <div class="portfolio-slider">
                <?php
				$my_query = new WP_Query();
			    $slide_option = of_get_option('slide_option');
				$slider_effect = of_get_option('slider_effect');
				$slider_number = of_get_option('slider_number');
				
				if ($slide_option) :
						$args = array( 'tax_query' => array(
									array(
										'taxonomy' => 'portfolio_tag',
										'field' => 'id',
										'terms' => $slide_option
									)
								),
									'posts_per_page' => $slider_number
						); 		
				else :					
						$args = array( 'post_type' => 'portfolio',
									'posts_per_page' => $slider_number
						); 	  
				endif;
				$my_query->query($args);			
                ?>
                <script type="text/javascript">
				jQuery(window).load(function() {
					jQuery('.flexslider').flexslider({
						animation: "<?php echo ($slider_effect) ? $slider_effect : 'fade'; ?>",
						slideshowSpeed: 7000,
						animationDuration: 600
					});
				});
				</script>
                
                <div class="slider-wrapper">
                	<div class="flexslider">
                    	<ul class="slides">
                       <?php $count = 0; while ($my_query->have_posts()) : $my_query->the_post(); $count++; ?>
                                           
                    	<li><a href="<?php the_permalink() ?>" rel="bookmark" ><?php the_post_thumbnail('portfolio-slider', array("title"=>"")); ?></a><p class="flex-caption"><?php echo get_the_title($post->ID); ?></p></li>                                           
                      <?php endwhile; wp_reset_query();  ?>
                      </ul>
                        
                    </div>
                </div><!-- .slider-wrapper -->
                
              <div class="control-nav">
                   	<a class="view-all" href="<?php echo get_permalink( of_get_option('portfolio_page') ); ?>"><?php _e('View all', 'mojitos') ?></a><a class="previous" ><?php _e('previous portfolio', 'mojitos') ?></a><a class="next" ><?php _e('next portfolio', 'mojitos') ?></a>
               	</div><!-- .control-nav -->
                            	
              </div><!-- .portfolio-slider -->                
              <div class="feature-page box">
               	<?php echo (of_get_option('feature_box_title')) ? '<h3 class="box-title">'.of_get_option('feature_box_title').'</h3>':''; ?>
               	  <ul>
                  	  <?php $feature_page = 0; while ($feature_page != 3) : $feature_page++;  ?>
                   	  <li>
                      	<?php $feature_page_id = of_get_option('featured_page_'.$feature_page ); ?>
                        <?php $query = new WP_Query( 'page_id='.$feature_page_id ); ?>
                        <?php if ($query->have_posts()) : $query->the_post(); ?>  
                        <?php the_post_thumbnail(array(48,48));
						      the_title('<h3>', '</h3>');
							  the_content(); 
							  wp_reset_query(); 
						?>
                        <?php endif; ?>
                      </li>
                      <?php endwhile; ?>
                  </ul>
                </div><!-- .box -->
                <div class="block">                	
                    <div class="recent-post box">
						<h3 class="box-title"><?php echo of_get_option('latest_title'); ?></h3>
                <div class="portfolio-list2">
                <?php
				$my_query = new WP_Query();
			    $slide_option = of_get_option('slide_option');
				
				if ($slide_option) :
						$args = array( 'tax_query' => array(
									array(
										'taxonomy' => 'portfolio_tag',
										'field' => 'id',
										'terms' => $slide_option
									)
								),
									'posts_per_page' => -1
						); 		
				else :					
						$args = array( 'post_type' => 'portfolio',
									'posts_per_page' => -1
						); 	  
				endif;
				$my_query->query($args);			
                ?>
                <?php if ($my_query->have_posts()) : ?>
                <script>
					jQuery(document).ready(function(){
						jQuery("#casourel").jCarouselLite({
							btnNext: ".next",
							btnPrev: ".previous",
							easing: "easeInOutExpo",						
							speed:650,
							<?php echo (of_get_option('slide_item')) ? 'scroll: 4,':'';?>
							visible:4						
					   });
					});
				</script>
                <div id="casourel"><!-- edit LMB: show portfolio 5 to 8 -->
                	<ul>
                	<?php $count = 0; while ($my_query->have_posts()) : $my_query->the_post(); $count++; ?>                    
                    	<?php if ($count>5) { ?>
							<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'mojitos' ), the_title_attribute( 'echo=0' ) ); ?>" ><?php the_post_thumbnail('portfolio-thumb-4-col'); ?><h3><?php the_title(); ?></h3></a>
                        </li>      <?php }   ?>               
                    <?php if ($count>8) break; endwhile; wp_reset_query();  ?>
					</ul>
                </div><!-- #casourel -->
				<a class="button large left" target="_self" href="http://www.omniveo.com/?page_id=1719<?php echo "&lang=".qtrans_getLanguage(); ?>" style=""><?php if(qtrans_getLanguage() == "es") { _e('Ver Portfolio', 'mojitos');} else { _e('View Portfolio', 'mojitos');} ?></a>
                <?php else: ?>                    
         	 		<h2 class="title"><?php _e('Sorry, no posts matched your criteria.', 'lightcompass') ?></h2>                    
                <?php endif; ?>                	
                </div><!-- .portfolio-list -->                
<!--                         <div class="box-link">
                        	<a href="http://www.omniveo.com/wp/portfolio-1-col/"><?php if(qtrans_getLanguage() == "es") { _e('Ver Portfolio', 'mojitos');} else { _e('View Portfolio', 'mojitos');} ?></a>
                        </div><!-- .box-link -->                        
                    </div><!-- recent-post -->
                    <div class="widget-box">
                    	<?php if ( ! dynamic_sidebar( 'home-sidebar' ) ) : ?>
                        	<aside id="archives" class="widget">
                                <h1 class="widget-title"><?php _e( 'Archives', 'mojitos' ); ?></h1>
                                <ul>
                                    <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                                </ul>
                            </aside>
                        <?php endif; ?>
                    </div><!-- widget-box -->
                </div><!-- .block -->
            </div><!-- #primary -->

<?php get_footer(); ?>