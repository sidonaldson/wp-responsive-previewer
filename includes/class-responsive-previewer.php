<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://twitter.com/sidonaldsoncode
 * @since      1.0.0
 *
 * @package    Responsive_Previewer
 * @subpackage Responsive_Previewer/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Responsive_Previewer
 * @subpackage Responsive_Previewer/includes
 * @author     sidonaldson <simondonaldson@gmail.com>
 */
class Responsive_Previewer {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Responsive_Previewer_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'Responsive Previewer';
		$this->version = '1.0.0';
		$this->load_dependencies();
		$this->build_admin();

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function build_admin() {

		$this->loader->add_action( 'do_meta_boxes', $this, 'create_meta_box', 15 );

	}

	/**
	 * Add a meta box
	 *
	 * @since    1.0.0
	 */
	public function create_meta_box() {
			add_meta_box(
				'responsive-previewer',
				'Responsive Previewer',
				function($post){
					if ( 'publish' == $post->post_status ) {
						$preview_link = esc_url( get_permalink( $post->ID ) );
					} else {
						$preview_link = set_url_scheme( get_permalink( $post->ID ) );
						$preview_link = esc_url( apply_filters( 'preview_post_link', add_query_arg( 'preview', 'true', $preview_link ), $post ) );
					}
					echo '<p>' . $preview_link . '?preview=true</p>';
					echo '<a class="button button-primary button-large" href="http://mobv.co/' . $preview_link . '?preview=true" target="wp-preview-' . (int) $post->ID .'">Open preview</a><br/>';
				},
				'post',
				'side',
				'high'
			);
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Responsive_Previewer_Loader. Orchestrates the hooks of the plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-responsive-previewer-loader.php';

		$this->loader = new Responsive_Previewer_Loader();

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Responsive_Previewer_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
