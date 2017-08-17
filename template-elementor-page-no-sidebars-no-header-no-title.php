<?php
/*
Template Name: Elementor - Full Page, No Sidebars, No Header, No Title
*/

/**
* Nicholls Full Page
*
* Filter function to be used to disable sidebar widgets on page templates.
*
*
* @since 0.1
*/
add_filter( 'sidebars_widgets', 'nicholls_core_widget_disable_filter' );

// Header
get_header();

?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page-no-title' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
