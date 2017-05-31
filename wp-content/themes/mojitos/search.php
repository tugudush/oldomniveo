<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */

get_header(); ?>
		<header class="page-title">
        	<div class="col-width">
                <h1>
                <?php _e('Search Results', 'mojitos'); ?>
                </h1>
            </div><!-- .col-width -->
		</header><!-- .entry-header -->
		<div class="col-width">
		<section id="primary">
			<div id="content" role="main">
            	<div class="box">

			<?php if ( have_posts() ) : ?>
					
                    <h3 class="box-title">
					<?php printf( __( 'Search Results for: %s', 'mojitos' ), '<span>' . get_search_query() . '</span>' ); ?>
                    </h3>
				<?php /* Start the Loop */ ?>
				<?php $count = 0; while ( have_posts() ) : the_post(); $count++; ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', 'index' );
					?>

				<?php endwhile; ?>

				<?php mojitos_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'mojitos' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mojitos' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
            
            </div><!-- box -->

			</div><!-- #content -->
		</section><!-- #primary -->

<?php if ( of_get_option('layout','layout-2cr') != 'layout-1c') {
	get_sidebar();
} ?>
<?php get_footer(); ?>