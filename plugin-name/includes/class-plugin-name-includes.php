<?php

/**
 * The includes & helpers functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * The incldues & helpers functionality of the plugin.
 *
 * Defines the plugin name and version
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Includes {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for the helpers facing functionality.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for ...
		 */
		//require_once plugin_dir_path( dirname( __FILE__ ) ) .  'includes/class-plugin-name-class-name.php';
		//$class_name = new Plugin_Name_Class_Name( $this->get_plugin_name(), $this->get_version() );

		// Remember to 'require_once' all libraries and common class into this includes folder
		// and also instance all class you have except static functions here int this class

	}

	/**
	 * Some static help for admin & public
	 *
	 * @since    1.0.0
	 */
	public static function some_help() {


	}


}
