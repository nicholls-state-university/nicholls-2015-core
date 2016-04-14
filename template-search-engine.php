<?php
/*
Template Name: Search Engine - Google Hosted
*/

// Make sure this page is not cached.
define( 'DONOTCACHEPAGE', 1 );

/** 
* Nicholls Full Page
*
* Filter function to be used to disable sidebar widgets on page templates.
*
*
* @since 0.1
*/
add_filter( 'sidebars_widgets', 'nicholls_core_widget_disable_filter' );
function nicholls_core_widget_disable_filter( $widget_groups ) {
	$widget_groups['primary'] = array();
	$widget_groups['secondary'] = array();
	return $widget_groups;
}

// Move the titles around - from nicholls_move_title()
function nicholls_move_search_title() {
	// Website Title
	remove_action( 'fnbx_header', 'fnbx_default_title' );
	// Website Description
	remove_action( 'fnbx_header', 'fnbx_default_description' );
	// Entry title
	remove_action( 'fnbx_template_loop_entry_title', 'fnbx_entry_title' );
	// Move the entry-title
	add_action( 'fnbx_header', 'fnbx_entry_title' );
}
add_action( 'fnbx_child_init', 'nicholls_move_search_title');

function nicholls_google_search_engine_js() {
?>
<script>
  (function() {
    var cx = '000006858127128462850:olq8lufqhkm';
    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
  })();
</script>
<?php
}
add_action( 'wp_head', 'nicholls_google_search_engine_js');

get_header(); 

?>

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

			<?php endwhile; // End of the loop. ?>
										
		<form method="get" id="searchform" action="<?php echo esc_url( get_permalink() ); ?>">
			<label for="s" class="assistive-text"><?php _e( 'Search', 'nicholls_theme_core' ); ?></label>
			<input type="text" class="field" name="q" id="q" placeholder="<?php esc_attr_e( 'Search', 'nicholls_theme_core' ); ?>" />
			<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'nicholls_theme_core' ); ?>" />
		</form>
		
	
<?php
$test_q_unallowed = array( 'Search...', 'nicholls', 'Nicholls' );
$test_q = trim( $_REQUEST['q'] );
?>

<?php if ( in_array( $test_q, $test_q_unallowed ) ): ?>
		<!-- Place this tag where you want the search results to render -->
		<gcse:searchresults-only autoSearchOnLoad="false"></gcse:searchresults-only>
<?php else: ?>
		<!-- Place this tag where you want the search results to render -->
		<gcse:searchresults-only></gcse:searchresults-only>
<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
