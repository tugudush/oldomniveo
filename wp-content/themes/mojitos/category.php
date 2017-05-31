<?php
/**
 * The template for displaying Category Archive pages.
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
		<?php  $portfoliotag =  get_categories('taxonomy=category'); ?>               
                <?php  if (isset($portfoliotag)) : ?>
                <div class="filter">
                    <ul>
                     	<li><a href="<?php echo get_permalink( $page ); ?>">latest</a></li>
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
		<section id="primary">
			<div id="content" role="main">
            	<div class="recent-post box">
					
                    <h3 class="box-title">
					<?php
						printf( __( 'Category: %s', 'mojitos' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?>
                    </h3>

					<?php $categorydesc = category_description(); if ( ! empty( $categorydesc ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>
				

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