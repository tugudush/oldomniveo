<?php
/**
 * The template for displaying search forms in mojitos
 *
 * @package WordPress
 * @subpackage mojitos
 * @since mojitos 0.1
 */
?>
	<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'mojitos' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'mojitos' ); ?>" />
	</form>
