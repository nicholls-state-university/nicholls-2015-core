<?php
/**
Template Name: Homepage TEST Template
*/

/**
* Template for front page or home page.
*
* @package Nicholls 2015 Home Theme
* @subpackage Template
*/

// Slider is Active
global $n_homepage_slider_active;
$n_homepage_slider_active = true;

/**
* Nicholls Theme Home init action
*
* Initialize the home.php template display differently for this view
*
*/
function nicholls_homepage_init() {

	// Google Webmaster Tools verification
	add_action( 'wp_head', 'nicholls_google_verify' );

	// if ( function_exists( 'nicholls_google_analytics' ) ) add_action( 'fnbx_wp_head_after', 'nicholls_google_analytics' );

}
add_action( 'after_setup_theme', 'nicholls_homepage_init' );

?>

<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="n-home-section-primary" class="n-home-section-primary-">

				<?php echo n_homepage_slider_get_slider( 'photo' ); ?>

<!-- debug start -->				
<?php echo n_homepage_slider_get_slider( 'photo', true ); ?>
<!-- debug end -->
				
				
				<?php if ( function_exists( 'nicholls_homepage_calendar_feed' ) ) nicholls_homepage_calendar_feed(); ?>

			</div>



<div id="n-section-video" class="n-section-video-">
<div class="n-background-colonel-pride">
</div>
<?php echo n_homepage_slider_get_slider( 'video' ); ?>
</div>

<?php echo n_homepage_slider_get_slider( 'infographic' ); ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
