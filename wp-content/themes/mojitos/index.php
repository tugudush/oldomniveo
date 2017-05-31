<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage mojitos
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
    			<?php  $portfoliotag =  get_categories('taxonomy=category'); ?>               
                <?php  if (isset($portfoliotag)) : ?>
                <div class="filter">
                    <ul>
                     	<li><a class="current_item" href="<?php echo get_permalink( $page ); ?>"><?php _e('latest', 'mojitos'); ?></a></li>
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
		<div id="primary">
			<div id="content" role="main">
           		<div class="recent-post box">
                
				<?php /* Start the Loop */ ?>
				<?php $count = 0; while ( have_posts() ) : the_post(); $count++; ?>

					<?php get_template_part( 'content', 'index' ); ?>

				<?php endwhile; ?>
				
				<?php mojitos_content_nav( 'nav-below' ); ?>
				</div><!-- box -->
			</div><!-- #content -->
		</div><!-- #primary -->
        
<?php if ( of_get_option('layout','layout-2cr') != 'layout-1c') {
	get_sidebar();
} ?>
<?php get_footer(); ?>