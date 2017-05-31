<?php
/**
 * @package WordPress
 * @subpackage Mojitos
 */
?>
<div class="entry-summary">
	<div class="control-nav single-page">
        <a class="view-all" href="<?php echo get_permalink( of_get_option('portfolio_page') ); ?>"><?php _e('back to main', 'mojitos'); ?></a>
        <span class="previous-entry"><?php previous_post_link('%link') ?></span><span class="next-entry"><?php next_post_link('%link'); ?></span>
    </div><!-- .control-nav -->
    
	<div class="box">
	<header class="entry-header">
		<h1 class="entry-title">
      	<?php the_title(); ?>
    	</h1>
  	</header><!-- .entry-header -->
    <div class="entry-content ">
    <?php the_excerpt(); ?>
    </div><!-- .entry-content -->
    </div><!-- .box -->
    <div class="portfolio-meta box">	
		<?php $tag_list = get_the_term_list( $post->ID, 'portfolio_tag', '',', ', '' );
        if ( '' != $tag_list ) { ?>
            	
    	<div class="categories"> <span><?php _e('Categorized:', 'mojitos'); ?></span> <?php echo $tag_list; ?> </div>
                
    	<?php } ?>
        <?php 
		$port_client = get_post_meta( $post->ID, '_portinfo_client', true ); 
        $port_year = get_post_meta( $post->ID, '_portinfo_year', true );
        $port_tools = get_post_meta( $post->ID, '_portinfo_tools', true ); 
        $port_role = get_post_meta( $post->ID, '_portinfo_role', true ); 
        $port_link = get_post_meta( $post->ID, '_portinfo_link', true ); 
		?>
        <?php if ( $port_client != '' ||  $port_year != '' || $port_tools != '' || $port_role != '' || $port_link != ''  ) : ?>
        <ul>
        
			<?php if (!empty($port_client)) { ?>
            <li class="client"><span><?php _e('Client:', 'mojitos'); ?></span><br />
                <?php echo $port_client;  ?></li>
            <?php } ?>
            <?php if (!empty($port_year)) { ?>
            <li class="year"><span><?php _e('Year:', 'mojitos'); ?></span><br />
                <?php echo $port_year;  ?></li>
            <?php } ?>
            
            <?php if (!empty($port_tools)) { ?>
            <li class="tools"><span><?php _e('Tools:', 'mojitos'); ?></span><br />
                <?php echo $port_tools;  ?></li>
            <?php } ?>
            
            <?php if (!empty($port_role)) { ?>
            <li class="role"><span><?php _e('Role:', 'mojitos'); ?></span><br />
                <?php echo $port_role;  ?></li>
            <?php } ?>
            
            <?php if (!empty($port_link)) { ?>
            <li class="link"><span><?php _e('Link:', 'mojitos'); ?></span><br />
                <?php echo $port_link;  ?>
            
            </li>
            <li class="box-link">
                <a href="<?php echo $port_link; ?>" target="_blank"><?php _e('View project', 'mojitos'); ?></a>
            </li><!-- .box-link -->
            <?php } ?>
            
        </ul><!-- ul -->
         <?php endif; ?>
    </div><!-- .portfolio-meta -->

    <?php edit_post_link( __( '[Edit]', 'mojitos' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- .entry-summary -->
<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		<div class="box">
        
		<?php the_content(); ?>
      		
      	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( '<span>Pages:</span>', 'mojitos' ), 'after' => '</div>' ) ); ?>
    	
  	<div class="clearfix"></div>
	<?php comments_template( '', true ); ?>
	</div><!-- .box -->
</article><!-- #post-<?php the_ID(); ?> -->