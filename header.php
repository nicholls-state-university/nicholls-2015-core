<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @packageNicholls 2015 Core
 */

?><?php do_action( 'nicholls-page-start' ); ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="google-site-verification" content="m8Cj8r6-iwttNBQu4C-KGyXG13dMjahXqtU-LG0NT6c" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nicholls_core' ); ?></a>
<?php get_template_part( 'nicholls/header', 'core' ); ?>
<div id="page" class="hfeed site">

<?php
// Remove header for homepage template
if ( !is_page_template( array( 'template-homepage.php', 'template-homepage-test.php', 'template-elementor-page-no-sidebars-no-header.php', 'template-elementor-page-no-sidebars-no-header-no-title.php' ) ) ) :
?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">

				<h1 class="site-title clear-group"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span></h1>

<?php
$site_description = get_bloginfo( 'description' );
if ( !empty( $site_description ) ) {
	echo '<p class="site-description"><span>' . $site_description . '</span></p>';
}
?>

		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'nicholls_core' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
<?php
// Remove header for homepage template
endif;
?>

	<div id="content" class="site-content">

<div id="nicholls-nav-go-to-wrapper" class="nicholls-nav-go-wrapper- nicholls-nav-go-to-wrapper-">
	<div id="nicholls-nav-go-to" class="nicholls-nav-go- nicholls-nav-go-to-">

	<span>Go To &darr;</span>
	<span><a href="#widgets-primary">Navigation &amp; Information</a></span>
	<span><a href="#nicholls-site-footer">Other Information</a></span>

	</div>
</div>
