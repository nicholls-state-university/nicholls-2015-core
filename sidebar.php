<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @packageNicholls 2015 Core
 */

if ( ! is_active_sidebar( 'primary' ) ) {
	return;
}
?>

<div id="primary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'primary' ); ?>
</div><!-- #secondary -->
