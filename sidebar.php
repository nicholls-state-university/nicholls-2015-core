<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @packageNicholls 2015 Core
 */

if ( is_active_sidebar( 'primary' ) ) {
	echo '<div id="widgets-primary" class="widget-area widgets-primary-" role="complementary">';
	dynamic_sidebar( 'primary' );
	echo '</div><!-- #primary -->';
}

if ( is_active_sidebar( 'secondary' ) ) {
	echo '<div id="widgets-secondary" class="widget-area widgets-secondary-" role="complementary">';
	dynamic_sidebar( 'secondary' );
	echo '</div><!-- #secondary -->';
}
