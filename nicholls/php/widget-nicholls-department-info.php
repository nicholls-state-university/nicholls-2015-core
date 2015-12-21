<?php
/**
 * Nicholls Department information widget
 *
 * @since 2.8.0
 */

if ( !class_exists('WP_Widget_Nicholls_Department') ) {
	class WP_Widget_Nicholls_Department extends WP_Widget {

		function WP_Widget_Nicholls_Department() {
			$widget_ops = array('classname' => 'nicholls-department-widget', 'description' => 'Nicholls Department Information' );
			$control_ops = array('width' => 400, 'height' => 350);
			$this->WP_Widget('nicholls_department_info', 'Nicholls Department Information', $widget_ops, $control_ops);
		}

		function widget( $args, $instance ) {
			extract($args);

			$widget_options = get_option( 'nicholls_core_theme_options' );
			$title = get_bloginfo( 'name' );
			if ( !empty( $widget_options[ 'title_prefix' ] ) )
					$title = $widget_options[ 'title_prefix' ] . ' &raquo; ' . $title;

			echo $before_widget;

			echo $before_title . $title . $after_title;

			fnbx_html_tag( array(
				'tag' => 'div',
				'tag_type' => 'open',
				'id' => 'nicholls-department-info',
				'class' => 'nicholls-department-info-',
				'tag_content_after' => "\n",
			) );

			if ( !empty( $widget_options['address_location'] ) )
				$this->html_field_display( 'Office Location', 'department-address-location-', '<br />' . $widget_options['address_location'] );
			if ( !empty( $widget_options['address_mailing'] ) || !empty( $widget_options['address_cityzip'] ) )
				$this->html_field_display( 'Mailing Address', 'department-address-mailing-', '<br />' .$widget_options['address_mailing'] . '<br />' .  $widget_options['address_cityzip'] );
			if ( !empty( $widget_options['phone'] ) )
				$this->html_field_display( 'Phone', 'department-phone-', ' ' . $widget_options['phone'] );
			if ( !empty( $widget_options['fax'] ) )
				$this->html_field_display( 'Fax', 'department-fax-', ' ' . $widget_options['fax'] );

			if ( !empty( $widget_options['email_address'] ) ) {
				$email = fnbx_html_tag( array(
					'tag' => 'a',
					'href' => 'mailto:' . $widget_options['email_address'],
					'tag_content' => $widget_options['email_name'],
					'tag_content_after' => "\n",
					'return' => true
				) );

				$this->html_field_display( 'E-mail', 'department-email-', ' ' . $email );
			}

			if ( !empty( $widget_options['note'] ) )
				$this->html_field_display( '', 'department-note-', $widget_options['note'] );

			fnbx_html_tag( array(
				'tag' => 'div',
				'tag_type' => 'close',
				'tag_content_after' => "\n"
			) );

			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			return $instance;
		}

		function form( $instance ) {
			fnbx_html_tag( array(
				'tag' => 'strong',
				'tag_content' => 'This widget has no settings!!',
				'tag_content_after' => '<br />Look at the Nicholls menu item to set department info'
			) );
		}

		function html_field_display( $title = '', $class = '', $info_contents = '' ) {
			if ( $info_contents == '' ) return;

			if ( $title != '' ) {
				$info = fnbx_html_tag( array(
					'tag' => 'strong',
					'tag_content' => $title . ':',
					'tag_content_after' => $info_contents,
					'return' => true
				) );
			} else {
				$info = $info_contents;
			}

			fnbx_html_tag( array(
				'tag' => 'div',
				'class' => $class,
				'tag_content' => $info,
				'tag_content_after' => "\n",
			) );

			echo $contents;
		}



	}

	// Register Nicholls Widget Class
	function nicholls_widgets_init() {
		register_widget('WP_Widget_Nicholls_Department');
	}
	add_action('widgets_init', 'nicholls_widgets_init', 1);
}


/**
* Theme Administration
*
* These functions setup and control the theme interface
* @author Jess Planck
* @version 1.0
*/


/**
* Nicholls Core Admin Settings
*
* Function used for an array to describe the options held in nicholls_core_theme_options
*
* @since 0.4
*/
function nicholls_core_admin_get_setting_config() {

	$setting[0] = array(
		'name' => 'address_location',
		'description' => 'Office Location and Building',
		'section' => 'contact',
		'type' => 'input'
	);
	$setting[1] = array(
		'name' => 'address_mailing',
		'description' => 'Office Mailing Address',
		'section' => 'contact',
		'type' => 'input'
	);
	$setting[2] = array(
		'name' => 'address_cityzip',
		'description' => 'Office Mailing City, State, and Zip Code',
		'section' => 'contact',
		'type' => 'input'
	);
	$setting[3] = array(
		'name' => 'phone',
		'description' => 'Office Phone Number',
		'section' => 'contact',
		'type' => 'input'
	);
	$setting[4] = array(
		'name' => 'fax',
		'description' => 'Office Fax Number',
		'section' => 'contact',
		'type' => 'input'
	);
	$setting[5] = array(
		'name' => 'email_name',
		'description' => 'Office Contact Email Display Name',
		'section' => 'contact',
		'type' => 'input'
	);
	$setting[6] = array(
		'name' => 'email_address',
		'description' => 'Office Contact Email Address',
		'section' => 'contact',
		'type' => 'input'
	);
	$setting[7] = array(
		'name' => 'note',
		'description' => 'Office Hours or Short Note',
		'section' => 'contact',
		'type' => 'textarea'
	);
	$setting[8] = array(
		'name' => 'title_prefix',
		'description' => 'Website Title Prefix (leave blank for NONE)',
		'section' => 'advanced',
		'type' => 'input'
	);
	$setting[9] = array(
		'name' => 'site_remove_dates',
		'description' => 'Do not display date on post pages.',
		'section' => 'advanced',
		'type' => 'checkbox'
	);
	$setting[10] = array(
		'name' => 'site_remove_post_meta',
		'description' => 'Do not display meta-information on post pages.',
		'section' => 'advanced',
		'type' => 'checkbox'
	);

	return $setting;
}


// Setup admin area for Nicholls Theme - for the old stuff
function nicholls_common_admin_setup() {

	// Add Menu
	add_menu_page( 'Nicholls Theme Options', 'Nicholls Theme Options' , 'delete_others_posts' , 'nicholl_common', 'nicholls_common_admin', FNBX_CORE_URL . '/library/images/admin-icon.png');

	// Register Settings
	add_action( 'admin_init', 'nicholls_common_admin_settings_register' );

	if ( $_GET['page'] == 'nicholls_common' ) {

		// Use action to enqueue javascript
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'nicholls-admin-js' , FNBX_CORE_URL . '/library/js/nicholls-admin.js', array( 'jquery' ), '1.0' );

	}

}
add_action( 'admin_menu' , 'nicholls_common_admin_setup' );

function nicholls_common_admin_settings_register() {
	// Register Nicholls Settings
	register_setting( 'nicholls_core_theme_options', 'nicholls_core_theme_options', 'nicholls_core_theme_options_validate' );

	add_settings_section('nicholls_core_theme_admin_contact', 'Department Contact Information', 'nicholls_core_theme_admin_section_contact_text', 'nicholls_core_theme_admin');
	add_settings_section('nicholls_core_theme_admin_advanced', 'Advanced Nicholls Theme Options', 'nicholls_core_theme_admin_section_advanced_text', 'nicholls_core_theme_admin');


	$nicholls_core_fields = nicholls_core_admin_get_setting_config();

	foreach( $nicholls_core_fields as $nicholls_core_field ) {

		$field_callback = 'nicholls_core_theme_admin_setting_string';

		if ( $nicholls_core_field['type'] == 'textarea' ) $field_callback = 'nicholls_core_theme_admin_setting_textarea';
		if ( $nicholls_core_field['type'] == 'checkbox' ) $field_callback = 'nicholls_core_theme_admin_setting_checkbox';

		add_settings_field('nicholls_core_theme_admin_' . $nicholls_core_field['name'], $nicholls_core_field['description'], $field_callback, 'nicholls_core_theme_admin', 'nicholls_core_theme_admin_' . $nicholls_core_field['section'], $nicholls_core_field['name'] );

	}

	if ( is_super_admin() )
		add_settings_field('nicholls_core_theme_admin_reset', 'Reset Front Page', 'nicholls_core_theme_admin_section_emergency_reset', 'nicholls_core_theme_admin', 'nicholls_core_theme_admin_advanced', $nicholls_core_field['name'] );
}


function nicholls_core_theme_admin_section_emergency_reset() {
	$reset_nonce= wp_create_nonce('emergency_reset');

	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_content' => '<a href="' . site_url() . '/?emergency_reset=yes&_wpnonce=' . $reset_nonce . '">Reset Cache for Emergency Notices</a>'
	) );

}

function nicholls_core_theme_admin_section_contact_text() {
	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_content' => 'Contact information will be shown only if you have the Nicholls information widget in your sidebar.'
	) );
}

function nicholls_core_theme_admin_section_advanced_text() {
	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_content' => 'These are advanced options. If you do not understand these options, please contact the Website Manager before you make further changes.'
	) );
}

function nicholls_core_theme_admin_setting_string( $field_name ) {
	$options = get_option('nicholls_core_theme_options');

	fnbx_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'name' => 'nicholls_core_theme_options['. $field_name . ']',
		'value' => $options[ $field_name ]
	) );
}

function nicholls_core_theme_admin_setting_textarea( $field_name ) {
	$options = get_option('nicholls_core_theme_options');

	fnbx_html_tag( array(
		'tag' => 'textarea',
		'name' => 'nicholls_core_theme_options['. $field_name . ']',
		'tag_content' => $options[ $field_name ]
	) );
}

function nicholls_core_theme_admin_setting_checkbox( $field_name ) {
	$options = get_option('nicholls_core_theme_options');

	$html_default = array(
		'tag' => 'input',
		'tag_type' => 'single',
		'name' => 'nicholls_core_theme_options['. $field_name . ']',
		'value' => 1,
		'type' => 'checkbox'
	);

	if ( $options[ $field_name ] == 1 ) {
		$html_default['checked'] = 'checked';
	}

	fnbx_html_tag( $html_default );

}

function nicholls_core_theme_options_validate( $input ) {
	$newinput = $input;

	return $newinput;
}

/**
* Write out a message to the admin screen
*
* $args are mixed arrays. First $args array should contain the following keys:
* - type: HTML input tag type.
* - name: String to be used for oject HTML class and id names
* - value: Default value for form element.
* - return: Boolean to return string or echo HTML
* - tag_content: for this case a button can have enclosed elements (defaults to value)
*
* @param array $args
* @since 0.4
* @return string|void
*/
function nicholls_common_admin_message( $message = '', $return = false ) {

	$args_default = array(
		'tag' => 'div',
		'id' => 'nicholls-admin-message',
		'class' => 'updated settings-error',
		'tag_content' => '<p>' . $message . '</p>',
		'return' => $return
	);

	if ( $args_default['return'] == true ) return fnbx_html_tag( $args_default );

	fnbx_html_tag( $args_default );
}



function nicholls_common_admin() {
	fnbx_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'open',
		'class' => 'wrap'
	) );

	if ( $_REQUEST['saved'] ) nicholls_common_admin_message( 'Settings saved.' );
	if ( $_REQUEST['reset'] ) nicholls_common_admin_message( 'Settings reset.' );

	fnbx_html_tag( array(
		'tag' => 'h2',
		'tag_content' => 'Nicholls Theme Options'
	) );

	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_content' => 'Options for your Nicholls Department website.'
	) );

	fnbx_html_tag( array(
		'tag' => 'form',
		'tag_type' => 'open',
		'action' => 'options.php',
		'method' => 'post'
	) );

	// WordPress settings API
	settings_fields('nicholls_core_theme_options');
	do_settings_sections('nicholls_core_theme_admin');

	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_type' => 'open',
		'class' => 'submit'
	) );

	fnbx_html_tag( array(
		'tag' => 'input',
		'tag_type' => 'single',
		'name' => 'Submit',
		'type' => 'submit',
		'class' => 'button-primary',
		'value' => esc_attr('Save Changes')
	) );

	fnbx_html_tag( array(
		'tag' => 'p',
		'tag_type' => 'close',
	) );

	fnbx_html_tag( array(
		'tag' => 'form',
		'tag_type' => 'close'
	) );

	fnbx_html_tag( array(
		'tag' => 'div',
		'tag_type' => 'close',
	) );
}
