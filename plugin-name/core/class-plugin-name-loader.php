<?php
/**
 * Register all actions and filters for the plugin
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/core
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/core
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Loader {

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Contaniner for the instance 'singleton' of this class
	 *
	 * @since 	1.0.0
	 * @access private
	 * @var object		Plugin_Name_Loader
	 */
	private static $instance;

	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	private function __construct() {

		$this->actions = array();
		$this->filters = array();
		$this->shortcodes = array();

	}

	/**
	 * Add a new action to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress action that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the action is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add a new filter to the collection to be registered with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         Optional. The priority at which the function should be fired. Default is 10.
	 * @param    int    $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	* Add a new shortcode to the collection to be registered with WordPress
	*
	* @since     1.0.0
	* @param     string        $tag           The name of the new shortcode.
    * @param     object        $component      A reference to the instance of the object on which the shortcode is defined.
    * @param     string        $callback       The name of the function that defines the shortcode.
	*/
	public function add_shortcode( $tag, $component, $callback, $priority = 10, $accepted_args = 1 ) {
	   	$this->shortcodes = $this->add( $this->shortcodes, $tag, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * A utility function that is used to register the actions and hooks into a single
	 * collection.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @param    array  $hooks            The collection of hooks that is being registered (that is, actions or filters).
	 * @param    string $hook             The name of the WordPress filter that is being registered.
	 * @param    object $component        A reference to the instance of the object on which the filter is defined.
	 * @param    string $callback         The name of the function definition on the $component.
	 * @param    int    $priority         The priority at which the function should be fired.
	 * @param    int    $accepted_args    The number of arguments that should be passed to the $callback.
	 * @return   array                                  The collection of actions and filters registered with WordPress.
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {

		$hooks[ $this->hook_index( $hook, $component, $callback ) ] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args,
		);

		return $hooks;

	}

	/**
	 * Remove a hook.
	 *
	 * Hook must have been added by this class for this remover to work.
	 *
	 * Usage Plugin_Name_Loader::get_instance()->remove( $hook, $component, $callback );
	 *
	 * @since      1.0.0
	 * @param      string               $hook             The name of the WordPress filter that is being registered.
	 * @param      object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param      string               $callback         The name of the function definition on the $component.
	 */
	public function remove( $hook, $component, $callback ) {
		$index = $this->hook_index( $hook, $component, $callback );
		if( isset( $this->filters[ $index ]  ) ) {
			remove_filter( $this->filters[ $index ][ 'hook' ],  array( $this->filters[ $index ][ 'component' ], $this->filters[ $index ][ 'callback' ] ) );
		}

		if( isset( $this->actions[ $index ] ) ) {
			remove_action( $this->actions[ $index ][ 'hook' ],  array( $this->filters[ $index ][ 'component' ], $this->filters[ $index ][ 'callback' ] ) );
		}
	}

	/**
	 * Utility function for indexing $this->hooks
	 *
	 * @since       1.0.0
	 * @access      protected
	 * @param      string               $hook             The name of the WordPress filter that is being registered.
	 * @param      object               $component        A reference to the instance of the object on which the filter is defined.
	 * @param      string               $callback         The name of the function definition on the $component.
	 *
	 * @return string
	 */
	protected function hook_index( $hook, $component, $callback ) {
		$component_name = ! empty( $component ) ? get_class( $component ) : 'Plugin_Name';
		return md5( $hook . $component_name . $callback );
	}

	/**
	 * Register the filters and actions with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		foreach ( $this->filters as $hook ) {
			$mixed_callback = ! empty( $hook[ 'component' ] ) ? array( $hook[ 'component' ], $hook[ 'callback' ] ) : $hook[ 'callback' ];
			add_filter( $hook[ 'hook' ], $mixed_callback, $hook[ 'priority' ], $hook['accepted_args'] );
		}

		foreach ( $this->actions as $hook ) {
			$mixed_callback = ! empty( $hook[ 'component' ] ) ? array( $hook[ 'component' ], $hook['callback'] ) : $hook[ 'callback' ];
			add_action( $hook[ 'hook' ], $mixed_callback, $hook[ 'priority' ], $hook[ 'accepted_args' ] );
		}

		foreach ( $this->shortcodes as $hook ) {
			$mixed_callback = ! empty( $hook[ 'component' ] ) ? array( $hook[ 'component' ], $hook[ 'callback' ] ) : $hook[ 'callback' ];
			add_shortcode( $hook[ 'hook' ], $mixed_callback );
		}

	}

	/**
	 * Get an instance of this class as singleton
	 *
	 * @since 			1.0.0
	 * @return object 	Plugin_Name_Loader
	 */
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new Plugin_Name_Loader();
		}

		return self::$instance;

	}

}
