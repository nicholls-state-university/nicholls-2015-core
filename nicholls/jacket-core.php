<?php
/**
 * _S Jacket Core
 *
 * Contains the jacket_core class, initialization, and functions designed to
 * be used with the _S WordPress theme.
 *
 * @package _S Jacket Core
 */

/**
* _S Jacket Core
 *
 * Initial Jacket Core class to specify some basic filteralble options and
 * functions.
 *
 * @package _S Jacket Core
 * @since 1.0
 */

if ( !class_exists( 'jacket_core' ) ) {

  /**
  * Jacket_Core Theme Framework Class
  *
  * This class gathers up
  * @package Jacket_Core
  * @subpackage Jacket_Core Class
  */
  class jacket_core {

    /**
    * Initialize private variables. Set for php4 compatiblity.
    */
    var $theme_support;
    var $content_width;

    var $custom_header;
    var $custom_background;

    var $tempalte_file;
    var $template_name;
    var $template_part_name;

    /**
    * Magic function used by PHP5 as the constructor
    */
    function __construct() {
      $this->jacket_core();
    }

    /**
    * Constructor initializes private variables. Set for php4 compatiblity.
    */
    function jacket_core() {
      global $content_width;

      // Set global $content_width for WordPress images
      $this->content_width = apply_filters( 'jacket_core_content_width', 532 );
      $content_width = $this->content_width;

      // Set and filter WordPress theme support features
      $this->theme_support = array(
        'automatic-feed-links' => true,
        'post-thumbnails' => true,
        'nav-menu' => true,
        'post-formats' => true,
        'custom-header' => true,
        'custom-background' => true,
        'editor-style' => true,
        'htmlfour' => false
      );
      $this->theme_support = apply_filters( 'jacket_core_theme_support', $this->theme_support );

      // Custom Headers
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

      }

      // Custom Backgrounds
      if ( $this->theme_support['custom-background'] ) {
        $this->custom_background = array(
          'background_image' => '',
          'css_name' => 'body',
          'css_bg_color' => '',
          'css_repeat' => 'no-repeat',
          'css_position_x' => 'center',
          'css_position_y' => 'top',
          'css_attachment' => ''
        );
        $this->custom_background = apply_filters( 'jacket_core_custom_background',  $this->custom_background );
      }

      $this->template_parts = array();

      // BETA! Filter to capture current public view template file.
      add_filter( 'template_include', array(&$this, 'template_include_filter') );

    }

    /**
    * Template  Filter
    *
    * Store the file name with path of current loaded template in view.
    * uses template_include filter to store info into $Jacket_Core object
    *
    * @since 1.0
    * @return string
    */
    function template_include_filter( $template ) {
      $this->template_file = $template;
      return $template;
    }

    /**
    * Get Template Part Filter
    *
    * Store information about the current view so it can be used in
    * the get_template_part file.
    *
    * @uses do_action( "get_template_part{$slug}", $slug, $name );
    * @since 1.0
    * @return string
    */
    function get_template_part_filter( $slug, $name ) {
      $this->template_part_name = $name;
      return;
    }

  }

}

/*

// My Notes with a simple Class Object doing WordPress filter majic.
class Profanity_Filter() {

// This is for PHP5, which uses a new magical function as the constructor
function __construct() {
$this->Profanity_Filter();
}

// On intitialazation of the object we add the filters, actions etc.
function Profanity_Filter() {
add_filter('the_content', array(&$this, 'filter'));
add_filter('comment_text', array(&$this, 'filter'));
}

// The class filter
function filter( $unfiltered_text ) {
$profane_things = array('water', 'cold', 'fast', 'cheese');
$clean_things = array('wine', 'hot', 'slow', 'pasta');
$filtered_text = str_replace($profane_things, $clean_things, $unfiltered_text);
return $filtered_text;
}

}

$profanity_filter = new Profanity_Filter;
*/

/**
* Jacket Core HTML Tag
*
* Core utility function for the writing and manipulation of HTML tags.
*
* @since 1.0
* @echo string
*/
if ( !function_exists( 'jacket_core_html_tag' ) ) {
	function jacket_core_html_tag( $html = array() ) {

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
* Varibale definitions
*/


add_action( 'init', 'jacket_core_init');
/**
* Jacket Core Init
*
* Initialize Jackt Core. A good place for defining variables. Also makes this
* global more accessible.
*
* @since 1.0
* @echo string
*/
function jacket_core_init() {
  global $jacket_core;
  // Initialize $jacket_core global variable.
  $jacket_core = new Jacket_Core;
  // Action - Jacket Core Loaded
  do_action( 'jacket_core_loaded');  
}


/**
* File inclusions and requires
*/

// Include specific Nicholls Widget function
require_once( NICHOLLS_CORE_DIR . '/nicholls/php/widget-nicholls-department-info.php' );
