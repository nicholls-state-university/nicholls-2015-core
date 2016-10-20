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
?>
<div id="form-gs-container" class="form-gs-container- hide">
	<form id="gs" name="gs" enctype="application/x-www-form-urlencoded" action="//www.nicholls.edu/search" method="get">
		<input id="q" name="q" class="input-q-" type="text" value=""/>
		<input id="sort" name="sort" class="input-sort-" type="hidden" value="date:D:L:d1"/>
		<input id="output" name="output" class="input-output-" type="hidden" value="xml_no_dtd"/>
		<input id="oe" name="oe" class="input-oe-" type="hidden" value="UTF-8"/>
		<input id="ie" name="ie" class="input-ie-" type="hidden" value="UTF-8"/>
		<input id="client" name="client" class="input-client-" type="hidden" value="default_frontend"/>
		<input id="proxystylesheet" name="proxystylesheet" class="input-proxystylesheet-" type="hidden" value="default_frontend"/>
		<input id="numgm" name="numgm" class="input-numgm-" type="hidden" value="5"/>
		<input id="site" name="site" class="input-site-" type="hidden" value="default_collection"/>
		<input id="search" name="search" class="input-search-" type="submit" value="search"/>
	</form>
</div>
<?php
}
