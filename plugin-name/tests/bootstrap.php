<?php

require_once dirname( __FILE__ ) . '/wp-tests/functions.php';

function _manually_load_environment() {

	// Add your theme …
	switch_theme('theme-name');

	// Update array with plugins to include ...
	$plugins_to_active = array(
		'plugin-name/plugin-name.php'
	);

	update_option( 'active_plugins', $plugins_to_active );

}
tests_add_filter( 'muplugins_loaded', '_manually_load_environment' );

require dirname( __FILE__ ) . '/wp-tests/bootstrap.php';
