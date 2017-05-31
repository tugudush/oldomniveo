<?php
/**
 * The template used to display Tag Archive pages
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
					$page = of_get_option('blog_page'); //Gets the page name and gives us access to the ID
					echo ($page) ? get_the_title($page):'The Blog';
				?>
                </h1>
            </div><!-- .col-width -->
		</header><!-- .entry-header -->
        
        <div class="col-width">

		<section id="primary">
			<div id="content" role="main">
            
            	<?php the_post(); ?>
            
            	<div class="recent-post box">
        	
                <h3 class="box-title">
                <?php
						printf( __( 'Tag Archives: %s', 'mojitos' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?>
                </h3>
            
				</header>
                
                <?php rewind_posts(); ?>

				<?php /* Start the Loop */ ?>
				<?php $count = 0; while ( have_posts() ) : the_post(); $count++; ?>

					<?php get_template_part( 'content', 'index' ); ?>

				<?php endwhile; ?>

				<?php mojitos_content_nav( 'nav-below' ); ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php if ( of_get_option('layout','layout-2cr') != 'layout-1c') {
	get_sidebar();
} ?>
<?php get_footer(); ?>