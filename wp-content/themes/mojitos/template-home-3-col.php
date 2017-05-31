<?php
/**
 * @package WordPress
 * @subpackage Mojitos
 * Template Name: Homepage with 3 columns Portfolios.
 */

get_header(); ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jCarouselLite.js"></script>
        
		<header class="page-title">
        	<div class="col-width">
                <h1><?php echo of_get_option('portfolio_title'); ?></h1>
            </div><!-- .col-width -->
		</header><!-- .entry-header -->
        <div class="col-width">		
            <div id="primary" class="col-3">            	
                <div class="portfolio-list">
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
					jQuery(document).ready(function() {
						jQuery("#casourel").jCarouselLite({
							btnNext: ".next",
							btnPrev: ".previous",
							easing: "easeInOutExpo",						
							speed:650,
							<?php echo (of_get_option('slide_item')) ? 'scroll: 3,':'';?>
							visible:3						
					   });
					});
				</script>
                <div id="casourel">
                	<ul>
                	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>                    
                    	<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf (esc_attr__('Permanent Link to %s', 'mojitos'), the_title_attribute( 'echo=0' ) ); ?>" ><?php the_post_thumbnail('portfolio-thumb-3-col'); ?></a><h3><?php the_title(); ?></h3>
                        </li>                        
                    <?php endwhile; wp_reset_query();  ?>
					</ul>
                </div><!-- #casourel -->
                <div class="control-nav">
                   	<a class="view-all" href="<?php echo get_permalink( of_get_option('portfolio_page') ); ?>"><?php _e('View all', 'mojitos') ?></a><a class="previous" ><?php _e('previous portfolio', 'mojitos') ?></a><a class="next" ><?php _e('next portfolio', 'mojitos') ?></a>
               	</div><!-- .control-nav -->
                <?php else: ?>                    
         	 		<h2 class="title"><?php _e('Sorry, no posts matched your criteria.', 'mojitos') ?></h2>                    
                <?php endif; ?>                	
                </div><!-- .portfolio-list -->                
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
                        <?php /* Start the Loop */ ?>
                        <?php $query = new WP_Query( 'posts_per_page=2&ignore_sticky_posts=1' ); $count = 0; ?>
						<?php while ( $query->have_posts() ) : $query->the_post(); $count++; ?>
                        
                    	<div class="article-container <?php echo ($count == 1) ? 'no-line':''; ?>">
                    	<article id="post-<?php the_ID(); ?>" <?php echo ( has_post_thumbnail() ) ? post_class('has-thumb'):post_class(); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mojitos' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                                <div class="entry-meta">
									<?php
										/* translators: used between list items, there is a space after the comma */
										$categories_list = get_the_category_list( __( ', ', 'mojitos' ) );
										if ( $categories_list ):
									?>
									<?php printf( __( '<span class="%1$s">in</span> %2$s', 'mojitos' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
									$show_sep = true; ?>
									<?php endif; // End if categories ?>
                                </div><!-- .entry-meta -->
                            </header><!-- .entry-header -->
                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mojitos' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('multiple-thumb'); ?></a>
                            <div class="entry-summary">
								<?php the_excerpt(); ?>
                            </div><!-- .entry-summary -->
                            
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                        <footer class="entry-meta">
                                <?php mojitos_posted_on(); ?>
                                <?php if ( comments_open() ) : ?>
                                <span class="leave-reply"><?php comments_popup_link( __( '<span class="reply">Reply</span>', 'mojitos' ), __( '<span class="reply">Replies:</span> 1', 'mojitos' ), __( '<span class="reply">Replies:</span> %', 'mojitos' ) ); ?></span>
                                <?php endif; // End if comments_open() ?>
                        </footer><!-- .entry-meta -->
                        </div><!-- article-container -->
                       <?php endwhile; ?>
                        <div class="box-link">
                        	<a href="<?php echo get_permalink( of_get_option('blog_page') ); ?>"><?php _e('View all articles', 'mojitos') ?></a>
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