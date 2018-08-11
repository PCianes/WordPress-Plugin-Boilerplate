<?php
/**
 * The gutenberg-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/gutenberg
 */

/**
 * The gutenberg-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the gutenberg-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/gutenberg
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Gutenberg {

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
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for the Gutenberg facing functionality.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The static class responsible for dynamic callbacks from PHP to Gutenberg
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'gutenberg/class-plugin-name-render-dynamic.php';
	}

	/**
	 * Add new custom categories for blocks
	 *
	 * @since    1.0.0
	 */
	public function add_custom_blocks_categories( $categories, $post ) {

		if ( $post->post_type !== 'post' ) {
			return $categories;
		}

		return array_merge(
			$categories,
			array(
				array(
					'slug' => 'plugin-name',
					'title' => __( 'Plugin_Name', 'plugin-name' ),
				),
			)
		);
	}

	/**
	 * Enqueue all Gutenberg blocks assets for only backend editor.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_all_blocks_assets_editor() {

		wp_enqueue_script(
			'plugin-name-gutenberg-editor',
			plugin_dir_url( __FILE__ ) . 'dist/blocks.build.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'dist/blocks.build.js' )
		);

		wp_enqueue_style(
			'plugin-name-gutenberg-editor',
			plugin_dir_url( __FILE__ ) . 'dist/blocks.editor.build.css',
			array( 'wp-edit-blocks' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'dist/blocks.editor.build.css' )
		);

	}

	/**
	 * Enqueue all Gutenberg blocks assets for both frontend + backend.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_all_blocks_assets() {

		wp_enqueue_style(
			'plugin-name-gutenberg',
			plugin_dir_url( __FILE__ ) . 'dist/blocks.style.build.css',
			array( 'wp-blocks' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'dist/blocks.style.build.css' )
		);
	}

	/**
	 * Enqueue all Gutenberg blocks assets for only frontend
	 *
	 * @since    1.0.0
	 */
	public function enqueue_all_blocks_assets_frontend() {

		/**
		 * If in the backend, bail out.
		 *
		 * @since    1.0.0
		 */
		if ( is_admin() ) {
			return;
		}

		wp_enqueue_script(
			'plugin-name-gutenberg-frontend',
			plugin_dir_url( __FILE__ ) . 'src/frontend.blocks.js',
			array(),
			filemtime( plugin_dir_path( __FILE__ ) . 'src/frontend.blocks.js' )
		);
	}

	/**
	 * Allow to work in Gutenberg with dynamic blocks
	 *
	 * @since    1.0.0
	 */
	public function register_dynamic_blocks() {

		/**
		 * Only load if Gutenberg is available.
		 */
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		/**
		 * Hook server side rendering into render callback
		 */
		register_block_type( 'plugin-name/block-name-dynamic', array(
			'attributes'      => array(
				'number' => array(
					'type' => 'number',
					'default' => 5
				),
			),
			'render_callback' => array( Plugin_Name_Render_Dynamic::class, 'block_name_dynamic'),
		 	)
		);

	}

	/**
	 * Allow to work in Gutenberg with some meta fields
	 *
	 * @since    1.0.0
	 */
	public function register_meta_fields() {

		register_meta(
			'post',
			'plugin-name-meta-key-name',
			array(
				'type'         => 'string', //'number'
				'single'       => true,
				'show_in_rest' => true,
			 )
		);

	}

	/**
	 * Add Gutenberg templates to post types
	 *
	 * @since    1.0.0
	 */
	public function add_templates_to_post_types( $args, $post_type ) {

		if ( 'post' == $post_type ) {

			$args['template_lock'] = true;
			$args['template']      = [
				[
					'core/image',
					[
						'align' => 'left',
					],
				],
				[
					'core/paragraph',
					[
						'placeholder' => 'The only thing you can add',
					],
				],
			];
		}

		return $args;

	}

}
