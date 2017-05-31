<?php
/**
 * @package WordPress
 * @subpackage Mojitos
 * Template Name: Testimonial page
 * Description: show list of testimonial
 */
get_header(); ?>

                <header class="page-title">
                    <div class="col-width">
                        <h1><?php the_title(); ?></h1>
                    </div><!-- .col-width -->
                </header><!-- .entry-header -->
				<div class="col-width">	
                <div id="primary" class="full-width">
                      <div id="content">
                          <ul class="clearfix testimonial">
                          <?php /* Start the Loop */ ?>
                          
                          <?php $query = new WP_Query( 'post_type=testimonial&posts_per_page=-1' ); ?>
                          <?php $count = 0; while ( $query->have_posts() ) : $query->the_post(); $count++; ?>
    					  <?php $company = get_post_meta( $post->ID, '_testimonial_company', true );  ?>
                          <li <?php if ($count % 4 == 0) { echo 'class="last"'; } ?>>
                            <div class="client-say"><?php the_content(); ?></div><!-- .client-say -->
                            <span class="client-name">- <?php the_title();  ?></span>
                            <span class="client-company"><?php echo ($company) ? $company:'' ; ?>
                            </span>
                            
                          </li>
    					  <?php if ($count % 4 == 0) { echo '<div class="clearfix"></div>'; } ?>
                        <?php endwhile; wp_reset_query();  ?>	
                    	</ul><!-- .box -->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>