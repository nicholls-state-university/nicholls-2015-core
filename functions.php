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

// Include Jacket Core init file. Setup $jacket_core global and defautls
require_once( NICHOLLS_CORE_DIR . '/nicholls/jacket-core.php' );

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

	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'magnific-popup-css', get_template_directory_uri() . '/nicholls/css/magnific-popup.css' );
	wp_enqueue_script( 'magnific-popup-js', get_template_directory_uri() . '/nicholls/js/jquery.magnific-popup.min.js', array(), '20120206', true );

	wp_enqueue_style( 'slicknav-css', get_template_directory_uri() . '/nicholls/css/slicknav.min.css' );
	wp_enqueue_script( 'slicknav-js', get_template_directory_uri() . '/nicholls/js/jquery.slicknav.min.js', array(), '20120206', true );

	wp_enqueue_script( 'nicholls_core-js', get_template_directory_uri() . '/nicholls/js/nicholls-core.js', array(), '20120206', true );

	wp_enqueue_script( 'nicholls_core-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'nicholls_core-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Nicholls styles last in the cascade do overrides happen
	wp_enqueue_style( 'nicholls_core-style', get_stylesheet_uri() );

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
	global $wp_query, $current_user, $jacket_core;

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
		if ( !in_array( $widget_group, $jacket_core->widget_areas ) ) continue;
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

	echo "<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>";
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
<!--[if IE 8]>         <html <?php language_attributes('html'); ?> class="no-js lt-ie9"> <![endif]--><?php
}


/* ISSUE:: Functions test area below */

add_filter( 'jacket_core_custom_header', 'nicholls_custom_header');
/*
if ( $this->theme_support['custom-header'] ) {
	$this->custom_header = array(
		'no_header_text' => false,
		'header_textcolor' => '',
		'header_image' => '',
		'header_image_thumbnail' => '',
		'header_image_width' => null,
		'header_image_height' => null,
		'header_image_flex_width' => false,
		'header_image_flex_height' => false,
		'css_name' => '.header-',
		'css_bg_color' => 'transparent',
		'css_repeat' => 'no-repeat',
		'css_repeat_from_theme' => false, // Force repeat from Theme style.css
		'css_position_x' => 'center',
		'css_position_y' => 'top',
		'css_position_from_theme' => false, // Force position from Theme style.css
		'css_attachment' => '',
		'random_default' => false
	);
	$this->custom_header = apply_filters( 'jacket_core_custom_header',  $this->custom_header );
*/
function nicholls_custom_header( $header_args = array() ) {

	$header_args['css_name'] = '.site-header';

	return $header_args;
}

// Remember to remove _S custom backtround setup
remove_action( 'after_setup_theme', 'nicholls_core_custom_header_setup' );
add_action( 'after_setup_theme', 'nicholls_custom_headers_setup' );
/*
* Setup Nicholls Custom Headers.
*
* The first default is part of the filter, but we add other default headers here.
*
* @since 1.0
*/
function nicholls_custom_headers_setup() {
	global $jacket_core;

	$header_args = array(
		'default-image' => $jacket_core->custom_header['header_image'],
		'height' => $jacket_core->custom_header['header_image_height'],
		'width' => $jacket_core->custom_header['header_image_width'],
		'flex-height' => $jacket_core->custom_header['header_image_flex_width'],
		'flex-width' => $jacket_core->custom_header['header_image_flex_height'],
		'default-text-color' => $jacket_core->custom_header['header_textcolor'],
		'header-text' => $jacket_core->custom_header['no_header_text'],
		'random-default' => $jacket_core->custom_header['random_default'],
		'wp-head-callback' => 'jacket_core_custom_header_style',
		'admin-head-callback' => 'jacket_core_custom_header_admin_style',
	);

	add_theme_support( 'custom-header', $header_args );

	register_default_headers( array (
			'nicholls_default_header_a' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-1.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-1-thumbnail.jpg',
				'description' => __( 'Nicholls Fountain', 'nicholls_lang' )
			),
			'nicholls_default_header_c' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-2.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-2-thumbnail.jpg',
				'description' => __( 'Polk Hall', 'nicholls_lang' )
			),
			'nicholls_default_header_d' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-3.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-3-thumbnail.jpg',
				'description' => __( 'Elkins Hall', 'nicholls_lang' )
			),
			'nicholls_default_header_e' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-4.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-4-thumbnail.jpg',
				'description' => __( 'Nicholls Softball', 'nicholls_lang' )
			),
			'nicholls_default_header_f' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-5.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-5-thumbnail.jpg',
				'description' => __( 'Ellender Memorial Library', 'nicholls_lang' )
			),
			'nicholls_default_header_g' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-6.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-6-thumbnail.jpg',
				'description' => __( 'Nicholls Housing', 'nicholls_lang' )
			),
			'nicholls_default_header_h' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-7.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-7-thumbnail.jpg',
				'description' => __( 'Beauregard Hall', 'nicholls_lang' )
			),
			'nicholls_default_header_i' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-8.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-8-thumbnail.jpg',
				'description' => __( 'Ellender Memorial Library', 'nicholls_lang' )
			),
			'nicholls_default_header_j' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-9.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-9-thumbnail.jpg',
				'description' => __( 'John L. Guidry Stadium', 'nicholls_lang' )
			),
			'nicholls_default_header_k' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-10.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-10-thumbnail.jpg',
				'description' => __( 'Elkins Hall', 'nicholls_lang' )
			),
			'nicholls_default_header_l' => array (
				'url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-11.jpg',
				'thumbnail_url' => NICHOLLS_CORE_URL . '/nicholls/images/headers/header-11-thumbnail.jpg',
				'description' => __( 'Eternal Flame', 'nicholls_lang' )
			)
	) );

}


// gets included in the site header
function jacket_core_custom_header_style() {
   global $jacket_core;

	 if ( !isset( $jacket_core->custom_header['css_name'] ) || empty( $jacket_core->custom_header['css_name'] ) ) return;

   $css_txt = '';

   $css_image = get_header_image();


   // ISSUE:: Random images don't work!
   if ( empty($css_image) ) {
	   $css_image = get_random_header_image();
   }


   if ( empty( $css_image ) ) $css_image = $jacket_core->custom_header['header_image'];

   $h_height = apply_filters( 'jacket_core_custom_header_css_background_height',  get_custom_header()->height );
   $h_width = apply_filters( 'jacket_core_custom_header_css_background_width',  get_custom_header()->width );

   if ( !empty( $h_height ) ) $css_txt .= "\n height: " . $h_height . 'px;';
   if ( !empty( $h_width ) ) $css_txt .= "\n width: " . $h_width . 'px;';

   if ( !empty( $jacket_core->custom_header['css_bg_color'] ) ) $css_txt .= "\n background-color: " . $jacket_core->custom_header['css_bg_color'] . ';';

   if ( !empty( $css_image ) ) {
	   $css_image = apply_filters( 'jacket_core_custom_header_css_background_url',  $css_image );
	   $css_txt .= "\n background-image: " . ' url("' . $css_image . '");';
	   if ( !isset( $jacket_core->custom_header['css_repeat_from_theme'] ) && $jacket_core->custom_header['css_repeat_from_theme'] != true ) {
		   if ( !empty( $jacket_core->custom_header['css_repeat'] ) ) $css_txt .= "\n background-repeat: " . $jacket_core->custom_header['css_repeat'] . ';';
	   }
	   if ( !isset( $jacket_core->custom_header['css_position_from_theme'] ) && $jacket_core->custom_header['css_position_from_theme'] != true ) {
		   if ( !empty( $jacket_core->custom_header['css_position_x'] ) ) $css_position_txt .= ' ' . $jacket_core->custom_header['css_position_x'];
		   if ( !empty( $jacket_core->custom_header['css_position_y'] ) ) $css_position_txt .= ' ' . $jacket_core->custom_header['css_position_y'];

			if ( !empty( $$css_position_txt ) ) $css_txt .= "\n background-position: " . $css_position_txt . ';';
	   }
	}

	$css_txt = apply_filters( 'jacket_core_custom_header_css_background',  $css_txt );

   if ( empty( $css_txt ) ) return;

?><style type="text/css">
<?php echo $jacket_core->custom_header['css_name']; ?> {
<?php echo $css_txt . "\n"; ?>
}
</style><?php

}

// gets included in the admin header
function jacket_core_custom_header_admin_style() {
	global $jacket_core;

	if ( !empty( $jacket_core->custom_header['css_repeat'] ) )
		$css_background_repeat = $jacket_core->custom_header['css_repeat'];
	else
		$css_background_repeat = 'no-repeat';

	 ?><style type="text/css">
		#headimg {
			width: <?php echo get_custom_header()->width; ?>px;
			height: <?php echo get_custom_header()->height; ?>px;
			background-repeat: <?php echo $css_background_repeat; ?>;
		}
	</style>
<?php
}
