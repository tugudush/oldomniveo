<?php
/**
 * @package WordPress
 * @subpackage Mojitos
 */

get_header(); ?>
		
        <header class="page-title">
        <div class="col-width">
        	<?php $portfolio_page = of_get_option('portfolio_page'); //Gets the page name and gives us access to the ID ?>
			<h1><?php echo get_the_title( $portfolio_page ); ?></h1>
		</div><!-- .col-width -->
		</header><!-- .entry-header -->
        <div class="col-width">
		<div id="primary" class="full-width">
			<div id="content" role="main" >
			
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'portfolio', get_post_format() ); ?>

			<?php endwhile; // end of the loop. ?>
				
			</div><!-- #content -->
		</div><!-- #primary -->
        
<?php get_footer(); ?>