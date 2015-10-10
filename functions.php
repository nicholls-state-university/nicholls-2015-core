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
$nicholls_core_theme_dir = array_pop( $jesse_james_core_theme_dir_src );
define( 'NICHOLLS_CORE_DIR', get_theme_root() . '/' . $jesse_james_core_theme_dir );
define( 'NICHOLLS_CORE_URL', get_theme_root_uri() . '/' . $jesse_james_core_theme_dir );

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
		'primary' => esc_html__( 'Primary Menu', nicholls_core ),
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
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

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
		'name'          => esc_html__( 'Sidebar', nicholls_core ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
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
	
	echo "<link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic|Lato:400,100,100italic,300,300italic,400italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>";
	/*
	font-family: 'Noto Serif', serif;
	font-family: 'Lato', sans-serif;
	*/
	
}