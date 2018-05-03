<?php

/**
 * The tests functionality of the plugin.
 * Set all methods with 'test' at the beginning of the name.
 *
 * @link       plugin
 * @since      1.0.0
 *
 * @package    Plugin
 * @subpackage Plugin/tests
 */

/**
 * The tests functionality of the plugin.
 *
 * Defines the plugin tests with PHPUNIT & WP_UnitTestCase
 *
 * @package    Plugin
 * @subpackage Plugin/tests
 * @author     plugin <plugin@plugin.com>
 */
class Test_Sample extends WP_UnitTestCase {

	/**
	 * Put here the code to use in all functions of the test class like $user = new User;
	 *
	 * @since    1.0.0
	 */
	public function setUp(){

		parent::setUp();

		//self::factory()->post
		//self::factory()->attachment
		//self::factory()->comment
		//self::factory()->user
		//self::factory()->term
		//self::factory()->category
		//self::factory()->tag
		//self::factory()->bookmark
		//self::factory()->blog
		//self::factory()->network

		//Creates a new object and returns its ID from the database
		//create( $args = array(), $generation_definitions = null )

		//Creates a new object and returns its full object (such as a WP_Post instance
		//create_and_get( $args = array(), $generation_definitions = null )

		//Creates multiple new objects and returns their IDs in an array.
		//create_many( $count, $args = array(), $generation_definitions = null )

		$user_ids = self::factory()->user->create_many( 25 );

		$user_id = self::factory()->user->create();

		$post_id = self::factory()->post->create( array( 'post_author' => $user_id ) );

	}

	/**
	 * Some basic demo test
	 *
	 * @since    1.0.0
	 */
	public function test_some_examples() {

		//$this->assertSame();
		//$this->assertEquals();
		$this->assertTrue( true );
		//$this->assertFalse();
		//$this->assertArrayHasKey();
		//$this->assertEmpty();
		//$this->assertCount();
		//$this->assertInstanceOf();

		$my_theme = wp_get_theme();
		$this->assertTrue( 'theme-name' == $my_theme->get( 'TextDomain' ) );

		$this->assertTrue( is_plugin_active('plugin-name/plugin-name.php') );

	}

	/**
	 * The code to run after finish the tests in this class
	 *
	 * @since    1.0.0
	 */
	public function tearDown(){

		 parent::tearDown();

	}

}
