<?php
/*
This template is for displaying the portfolio tags
*/
?>
<?php get_header(); ?>

			<?php $column_no = of_get_option('column_no'); ?>
            
            <?php $portfolio_page = of_get_option('portfolio_page'); //Gets the page name and gives us access to the ID ?>
            
            <header class="page-title">
        	<div class="col-width">
                <h1>
                <?php
					echo ($portfolio_page) ? get_the_title($portfolio_page):'Portfolio';
				?>
                </h1>
            </div><!-- .col-width -->
		</header><!-- .entry-header -->
        <div class="col-width">
            <div id="primary" <?php echo ($column_no == 3) ? 'class="col-3"':''; ?>>
            	<?php  $portfoliotag =  get_categories('taxonomy=portfolio_tag'); ?>               
                <?php  if (isset($portfoliotag)) : ?>
                <div class="filter">
                    <ul>
                     	<li><a href="<?php echo get_permalink( $portfolio_page ); ?>"><?php echo of_get_option('filter_default'); ?></a></li>
                	<?php 
					
					  $filteractive = single_tag_title('', false);
										   
					  foreach ($portfoliotag as $tag) {

						if ( $filteractive == $tag->cat_name ) :
							$option = '<li><a href="' .  get_term_link($tag,$tag->taxonomy) . '" class="current_item">';
						else :
							$option = '<li><a href="' .  get_term_link($tag,$tag->taxonomy) . '">';
						endif;
						$option .= $tag->cat_name;						
						$option .= '</a></li>';
						echo $option;
					  }
					 ?>               	
                                    	
                	</ul>
                </div><!-- .filter -->
                <?php  endif; ?>
                
                <div id="portfolio" class="<?php echo ( $column_no != 1 ) ? 'portfolio-list':'portfolio-list-one'; ?> ">
                                
                <?php global $query_string;
				
				query_posts( $query_string .'&posts_per_page=-1' );
				
				if (have_posts()) : $count = 0; ?>
                
                <ul>
                
               <?php while (have_posts()) : the_post(); $count++; ?>
                
				<?php if ( $column_no == 3 ) : ?>
                
                <li class="portfolio-item item-<?php echo $count; ?> <?php if ($count % 3 == 0) { echo 'last'; } ?>">
                    
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf (esc_attr__('Permanent Link to %s', 'mojitos'), the_title_attribute( 'echo=0' ) ); ?>" ><?php the_post_thumbnail('portfolio-thumb-3-col'); ?><h3><?php the_title(); ?></h3></a>
                    <?php portfolio_excerpt('portfolio_excerpt_length', 'portfolio_excerptmore'); ?>
                    <a class="button view-project-2" href="<?php the_permalink() ?>"><?php _e('View', 'mojitos'); ?></a>

                </li>
                
                <?php if ($count % 3 == 0) { echo '<div class="clearfix"></div>'; } ?>
                
                <?php elseif ( $column_no == 4 ) : ?>
                
                <li class="portfolio-item item-<?php echo $count; ?> <?php if ($count % 4 == 0) { echo 'last'; } ?>">
                    
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf (esc_attr__('Permanent Link to %s', 'mojitos'), the_title_attribute( 'echo=0' ) ); ?>" ><?php the_post_thumbnail('portfolio-thumb-4-col'); ?><h3><?php the_title(); ?></h3></a>
                    

                </li>
                
                <?php if ($count % 4 == 0) { echo '<div class="clearfix"></div>'; } ?>
                
                <?php elseif ( $column_no == 1 ) : ?>
                
                <li class="box">
                        <div class="post-info">
                        	<h3><?php the_title(); ?></h3>
                            <p class="date"><?php _e('Added on', 'mojitos'); ?> <?php echo get_the_date(); ?></p>
                            <?php portfolio_excerpt('portfolio_excerpt_length', 'portfolio_excerptmore'); ?>
                            <?php $port_client = get_post_meta( $post->ID, '_portinfo_client', true ); ?>
                            <?php if (!empty($port_client)) { ?>
                            <p><strong><?php _e('Client:', 'mojitos'); ?></strong> <?php echo $port_client;  ?>
                            </p>
                            <?php } ?>
                            <a class="button view-project-1" href="<?php the_permalink() ?>"><?php _e('View', 'mojitos'); ?></a>
                        </div>
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf (esc_attr__('Permanent Link to %s', 'mojitos'), the_title_attribute( 'echo=0' ) ); ?>" ><?php the_post_thumbnail('portfolio-thumb-1-col'); ?></a>
                 </li>
                
               
                
                <?php endif; ?>
                
                <?php endwhile; ?>    
    
                <?php else: ?>
                
                <h2 class="title"><?php _e('Sorry, no posts matched your criteria.', 'mojitos') ?></h2>
                
                <?php endif; ?>  
    
                </div><!-- #portfolio -->
        </div><!-- #primary -->
            
<?php get_footer(); ?>