<?php
/**
 *Nicholls 2015 Core functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @packageNicholls 2015 Core
 */

// Define theme core file location and uri using the current script file location
$nicholls_core_theme_dir_src = explode( '/' , dirname( __FILE__ ) ); // Limit some pass by reference errors.
$nicholls_core_theme_dir = array_pop( $nicholls_core_theme_dir_src );
define( 'NICHOLLS_CORE_DIR', get_theme_root() . '/' . $nicholls_core_theme_dir );
define( 'NICHOLLS_CORE_URL', get_theme_root_uri() . '/' . $nicholls_core_theme_dir );

// Include Files, ISSUE:: This should be better organized or moved to plugins.
require_once( NICHOLLS_CORE_DIR . '/nicholls/php/widget-nicholls-department-info.php' );

if ( ! function_exists( 'nicholls_core_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nicholls_core_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based onNicholls 2015 Core, use a find and replace
	 * to change nicholls_core to the name of your theme in all the template files.
	 */
	load_theme_textdomain( nicholls_core, get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'nicholls_core' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */

/*
  add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
**/

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'nicholls_core_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // nicholls_core_setup
add_action( 'after_setup_theme', 'nicholls_core_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nicholls_core_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'nicholls_core_content_width', 640 );
}
add_action( 'after_setup_theme', 'nicholls_core_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nicholls_core_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Primary', 'nicholls_core' ),
		'id'            => 'primary',
		'description'   => 'Primary sidebar after content container',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title widgettitle">',
		'after_title'   => '</h3>',
	) );

  register_sidebar( array(
		'name'          => esc_html__( 'Secondary', 'nicholls_core' ),
		'id'            => 'secondary',
		'description'   => 'Secondary sidebar after content container and primary area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title widgettitle">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'nicholls_core_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nicholls_core_scripts() {
	wp_enqueue_style( 'nicholls_core-style', get_stylesheet_uri() );

	wp_enqueue_script( 'nicholls_core-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'nicholls_core-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'nicholls_core_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* ----- Nicholls Core Starts Here ------
*/

/**
* FNBX HTML Tag
*
* Core utility function for the writing and manipulation of HTML tags.
*
* @since 1.0
* @echo string
*/
if ( !function_exists( 'fnbx_html_tag' ) ) {
	function fnbx_html_tag( $html = array() ) {

		if ( empty( $html ) ) return;

		$attributes = '';
		$composite = '';
		$spacer = '';
		if ( !isset( $html['return'] ) ) $html['return'] = false;
		$reserved = array(
			'tag', 'tag_type', 'attributes', 'tag_content', 'tag_content_before', 'tag_content_after', 'return'
		);

		foreach ( $html as $name => $option ) {
			if ( in_array( $name, $reserved ) ) continue;
			$attributes .= $name . '="' . $option . '" ';
		}

		if ( isset( $html['attributes'] ) ) $attributes .= $html['attributes'] . ' ' . $attributes;

		if ( $attributes != '' ) {
			$attributes = rtrim( $attributes );
			$spacer = ' ';
		}

		if ( !isset( $html['tag_type'] ) ) $html['tag_type'] = 'default';

		if ( isset( $html['tag_content_before'] ) ) $composite .= $html['tag_content_before'];

		switch ( $html['tag_type'] ) {
			case 'single':
				if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];
				if ( isset( $html['tag'] ) ) $composite .= '<' . $html['tag'] . $spacer . $attributes . '/>';
				break;
			case 'open':
				if ( isset( $html['tag'] ) ) $composite .= '<' . $html['tag'] . $spacer . $attributes . '>';
				if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];
				break;
			case 'close':
				if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];
				if ( isset( $html['tag'] ) ) $composite .= '</' . $html['tag'] . '>';
				break;
			case 'attributes':
				$composite = $attributes;
				break;
			case 'default':
				if ( isset( $html['tag'] ) ) $composite .= '<' . $html['tag'] . $spacer . $attributes . '>';
				if ( isset( $html['tag_content'] ) ) $composite .= $html['tag_content'];
				if ( isset( $html['tag'] ) ) $composite .= '</' . $html['tag'] . '>';
				break;
		}

		if ( isset( $html['tag_content_after'] ) ) $composite .= $html['tag_content_after'];

		if ( $html['return'] == true ) return $composite ;

		echo $composite;
	}
}

/**
* FNBX Date Class Function
*
* Taken from the old Sandbox Theme. The function provides date classes
* message pandering for donations for FNBX. Drop a dime in the bucket if you like, but it's really
* a ridiculous message to urge you to find or develop a child theme. Laugh, cry, or remove the code!
*
* @since 1.0
*/
function nicholls_core_date_classes( $t, $p = '' ) {
	$c = array();
	$t = $t + ( get_option('gmt_offset') * 3600 );
	$c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
	$c[] = $p . 'm' . gmdate( 'm', $t ); // Month
	$c[] = $p . 'd' . gmdate( 'd', $t ); // Day
	$c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
	return $c;
}

add_filter( 'body_class', 'nicholls_core_body_class_filter' );
/**
* Body Class Filter
*
* Adds various sematic classes the BODY tag.
*
* @since 1.0
* @return array
*/
function nicholls_core_body_class_filter( $classes ) {
	global $wp_query, $current_user;

	// It's surely WordPress, right?
	$classes[] = 'wordpress';

	// Applies the time- and date-based classes (below) to BODY element
	//$date_classes = fnbx_date_classes( time() );
	$classes = array_merge( $classes, nicholls_core_date_classes( time() ) );

	// Special classes for BODY element when a single post
	if ( is_single() ) {
		the_post();

		// Adds classes for the month, day, and hour when the post was published
		if ( isset( $wp_query->post->post_date ) )
			$classes = array_merge( $classes, nicholls_core_date_classes( mysql2date( 'U', $wp_query->post->post_date ), 's-' ) );

		// Adds category classes for each category on single posts
		if ( $cats = get_the_category() )
			foreach ( $cats as $cat )
				$classes[] = 's-category-' . $cat->slug;

		// Adds tag classes for each tags on single posts
		if ( $tags = get_the_tags() )
			foreach ( $tags as $tag )
				$classes[] = 's-tag-' . $tag->slug;

		// Adds author class for the post author
		$classes[] = 's-author-' . sanitize_title_with_dashes( strtolower( get_the_author_meta( 'login' ) ) );

		rewind_posts();
	// Page author for BODY on 'pages'
	} elseif ( is_page() ) {
		the_post();
		$classes[] = 'page pageid-' . $wp_query->post->ID;
		$classes[] = 'page-author-' . sanitize_title_with_dashes( strtolower( get_the_author_meta('login') ) );

		rewind_posts();
	}

	if ( is_singular() ) $classes[] = 's-' . str_ireplace( '/', '', get_page_uri( $wp_query->post->ID ) );

	$widget_groups = wp_get_sidebars_widgets();
	foreach ( $widget_groups as $widget_group => $widget_elements ) {
		if ( $widget_group == 'wp_inactive_widgets' ) continue;
		$classes[] =  'widgets-' . sanitize_title_with_dashes( $widget_group ) . ( empty( $widget_elements ) ? '-inactive' : '-active' );
	}

	$classes = apply_filters( 'fnbx_body_class',  $classes );

	return $classes;
}

add_action( 'wp_head', 'nicholls_core_fonts_google' );
/**
* Google Fonts
*
* Fonts: Lato, Alegreya
* https://www.google.com/fonts#UsePlace:use/Collection:Lato:300,400,700,900,300italic,400italic,700italic,900italic|Alegreya:400italic,700italic,900italic,400,700,900
*
*/
function nicholls_core_fonts_google() {

	//OLD echo "<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic|Alegreya:400italic,700italic,900italic,400,700,900' rel='stylesheet' type='text/css'>";

	echo "<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic%7CLato:400,100,100italic,300,300italic,400italic,700,700italic,900italic,900' rel='stylesheet' type='text/css' />";
	/*
	font-family: 'Noto Serif', serif;
	font-family: 'Lato', sans-serif;
	*/

}

add_action( 'nicholls-page-start', 'nicholls_ie_support_classes' );
/*
* Add classes to starting HTML DOM to help specify Internet Explorer fixes
*/
function nicholls_ie_support_classes() {
?><!--[if lt IE 7]>      <html <?php language_attributes('html'); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html <?php language_attributes('html'); ?> class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html <?php language_attributes('html'); ?> class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><?php
}
