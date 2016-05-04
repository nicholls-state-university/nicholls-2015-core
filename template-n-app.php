<?php
/*
Template Name: N-App - Remove header, No Sidebars
*/

/**
* N-APP Template
*
* Special page template for embeding pages inside mobile apps.
* We remove some header graphics.
*
*/
// Query string to set request to change dislpay for embeded usage
$n_app = $_GET['n-app'];
?>
<?php if ( $n_app != 'true' ): ?>
<?php get_header(); ?>
<?php else: ?>
<?php do_action( 'nicholls-page-start' ); ?><!DOCTYPE html>
	<html <?php language_attributes(); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nicholls_core' ); ?></a>
	<div id="page" class="hfeed site">
<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( $n_app != 'true' ): ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php else:  ?>

	</div><!-- #content -->
<?php /** commented out for easier merging..
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nicholls_core' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'nicholls_core' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'nicholls_core' ), 'nicholls_core', '<a href="http://automattic.com/" rel="designer">Automattic</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
**/ ?>
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
<?php endif; // n-app query string check ?>
