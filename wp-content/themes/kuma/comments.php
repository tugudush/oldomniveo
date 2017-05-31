<?php if ( !post_password_required() && ( is_single() || is_page() ) ) : ?>
	<div class="comments-template">
		<?php if ( have_comments() && comments_open() ) : ?>
			<h4 id="comments"><?php comments_number( __( 'Leave a Comment', 'kuna' ), __( 'One Comment', 'kuna' ), '%' . __( ' Comments', 'kuna' ) ); ?></h4>
			<ul class="commentlist list-unstyled">
				<?php 
				wp_list_comments();
				paginate_comments_links();

				if ( is_singular() ) {
					wp_enqueue_script( 'comment-reply' );
				}
				?>
			</ul>
			<?php 
			comment_form();
		else :
			if ( comments_open() ) :
				comment_form();
			endif;
		endif;
		?>
	</div>
<?php endif; ?>
