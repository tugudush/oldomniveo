<!-- start content container -->
<div class="row">      
	<article class="col-md-<?php kuna_main_content_width_columns(); ?>">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                         
				<div <?php post_class(); ?>>
					<?php if ( has_post_thumbnail() ) : ?>                               
						<a class="featured-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
							<img class="lazy" src="<?php echo get_template_directory_uri() . '/img/placeholder.png' ?>" data-src="<?php the_post_thumbnail_url( 'kuna-single' ); ?>" alt="<?php the_title_attribute(); ?>" />
							<noscript>
								<?php the_post_thumbnail( 'kuna-single' ); ?>
							</noscript>
						</a>								               
					<?php endif; ?>	
					<div class="single-content row"> 
						<header class="col-md-4">
							<h2 class="page-header h1">                                
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>                            
							</h2>
							<div class="post-meta">
								<?php kuna_time_link(); ?>
								<?php kuna_posted_on(); ?>
								<?php kuna_entry_footer(); ?>
							</div><!-- .entry-summary -->
						</header>
						<div class="col-md-8">
							<div class="entry-summary">
								<?php the_content(); ?> 
							</div><!-- .entry-summary -->
							<?php wp_link_pages(); ?>
						</div>                                                             
					</div>
					<div class="single-footer row">
						<div class="col-md-4">
							<?php get_template_part( 'template-parts/template-part', 'postauthor' ); ?>
						</div>
						<div class="col-md-8">
							<?php comments_template(); ?> 
						</div>
					</div>
				</div>        
			<?php endwhile; ?>        
		<?php else : ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>    
	</article> 

	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->
