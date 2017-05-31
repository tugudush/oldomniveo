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
 * Template Name: Full width page
 */

get_header(); ?>
	<header class="page-title">
                    <div class="col-width">
                        <h1><?php the_title(); ?></h1>
                    </div><!-- .col-width -->
                </header><!-- .entry-header -->
	<div class="col-width">
		<div id="primary" class="full-width">
			<div id="content" role="main">
            
				<div class="box clearfix">
					<?php the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>
                    
                </div><!-- box -->

				<?php comments_template( '', true ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>