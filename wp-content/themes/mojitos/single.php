<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */

get_header(); ?>
	<header class="page-title">
        	<div class="col-width">
                <h1>
                <?php
					$blog_page = of_get_option('blog_page'); //Gets the page name and gives us access to the ID
					echo ($blog_page) ? get_the_title($blog_page):'The Blog';
				?>
                </h1>
            </div><!-- .col-width -->
		</header><!-- .entry-header -->
	<div class="col-width">
    
		<div id="primary">

			<div id="content" role="main">
                	
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                
                	<div class="recent-post box clearfix">
                    
						<?php get_template_part( 'content', 'single' ); ?>
                        
                        <div class="clearfix"></div>
                        
                        <?php comments_template( '', true ); ?>
                        
                     </div><!-- box -->

				<?php endwhile; // end of the loop. ?>
                
			</div><!-- #content -->
		</div><!-- #primary -->

<?php if ( of_get_option('layout','layout-2cr') != 'layout-1c') {
	get_sidebar();	
} ?>

<?php get_footer(); ?>