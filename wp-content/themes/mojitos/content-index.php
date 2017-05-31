<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */
?>
	
	<div class="article-container <?php global $count; echo ($count == 1) ? 'no-line':''; ?>">
	<article id="post-<?php the_ID(); ?>" <?php echo ( has_post_thumbnail() ) ? post_class('has-thumb'):post_class(); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mojitos' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                                <div class="entry-meta">
									<?php
										/* translators: used between list items, there is a space after the comma */
										$categories_list = get_the_category_list( __( ', ', 'mojitos' ) );
										if ( $categories_list ):
									?>
									<?php printf( __( '<span class="%1$s">in</span> %2$s', 'mojitos' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
									$show_sep = true; ?>
									<?php endif; // End if categories ?>
                                </div><!-- .entry-meta -->
                            </header><!-- .entry-header -->
                            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'mojitos' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_post_thumbnail('multiple-thumb'); ?></a>
                            <div class="entry-summary">
								<?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mojitos' ) ); ?>
                            </div><!-- .entry-summary -->
                            
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                        <footer class="entry-meta">
                                <?php mojitos_posted_on(); ?>
                                <?php if ( comments_open() ) : ?>
                                <span class="leave-reply"><?php comments_popup_link( __( '<span class="reply">Reply</span>', 'mojitos' ), __( '<span class="reply">Replies:</span> 1', 'mojitos' ), __( '<span class="reply">Replies:</span> %', 'mojitos' ) ); ?></span>
                                <?php endif; // End if comments_open() ?>
                        </footer><!-- .entry-meta -->
    </div><!-- article-container -->