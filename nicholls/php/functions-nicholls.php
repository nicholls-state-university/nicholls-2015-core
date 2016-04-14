<?php

/**
* Nicholls - Google Verification for analytics
*
* Initialize the home.php template display differently for this view
*
*/
function nicholls_google_verify() {
	echo '<meta name="google-site-verification" content="m8Cj8r6-iwttNBQu4C-KGyXG13dMjahXqtU-LG0NT6c" />';
}

/**
* Echo the form for the Nicholls Google Mini Search engine
*
* @since 0.4
*/
function nicholls_form_google_search() {
	echo nicholls_get_form_google_search();
}

/**
* Return the form for the Nicholls Google Mini Search engine
*
* @since 0.4
*/
function nicholls_get_form_google_search() {

	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'text', 'name' => 'q', 'class' => 'input-q-', 'value' => 'Search...', 'size' => 13, 'maxlength' => 256, 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'sort', 'value' => 'date:D:L:d1', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'output', 'value' => 'xml_no_dtd', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'oe', 'value' => 'UTF-8', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'ie', 'value' => 'UTF-8', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'client', 'value' => 'default_frontend', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'proxystylesheet', 'value' => 'default_frontend', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'numgm', 'value' => '5', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array( 'type' => 'hidden', 'name' => 'site', 'value' => 'default_collection', 'return' => true ) );
	$form_google_search_content .= jacket_core_form_input( array(
		'type' => 'submit',
		'name' => 'search',
		'value' => 'search',
		'tag_content' => 'Search',
		'return' => true
	) );

	return jacket_core_form( 'gs', 'http://www.nicholls.edu/search', 'get', $form_google_search_content, true );

}
