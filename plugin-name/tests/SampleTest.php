<?php

/**
 * The tests functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/tests
 */

/**
 * The tests functionality of the plugin.
 *
 * Defines the plugin tests with PHPUNIT
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/tests
 * @author     Your Name <email@example.com>
 */
class SampleTest extends WP_UnitTestCase {

	/**
	 * Some basic demo test
	 *
	 * @since    1.0.0
	 */
	public function testTrueAssetsToTrue() {

		$this->assertTrue( true );

	}

	/**
	 * Some basic demo test 2
	 *
	 * @since    1.0.0
	 */
	public function testWPSample() {

		$my_theme = wp_get_theme();
		$this->assertTrue( 'theme-name' == $my_theme->get( 'TextDomain' ) );

		$this->assertTrue( is_plugin_active('plugin-name/plugin-name.php') );
	}

}
