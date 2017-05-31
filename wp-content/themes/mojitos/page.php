<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */

get_header(); ?>
	<header class="page-title">
                    <div class="col-width">
                        <h1><?php the_title(); ?></h1>
                    </div><!-- .col-width -->
                </header><!-- .entry-header -->
	<div class="col-width">
		<div id="primary">
			<div id="content" role="main">
            
				<div class="col-2-box box clearfix">
					<?php the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>
                    
                	<div class="clearfix"></div>
                        
                    <?php comments_template( '', true ); ?>
                        
                 </div><!-- box -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php if ( of_get_option('layout','layout-2cr') != 'layout-1c') {
	get_sidebar();
} ?>
<?php get_footer(); ?>