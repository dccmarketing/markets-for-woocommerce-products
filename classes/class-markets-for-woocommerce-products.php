<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Markets_For_Woocommerce_Products
 * @subpackage Markets_For_Woocommerce_Products/classes
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
 * @package    Markets_For_Woocommerce_Products
 * @subpackage Markets_For_Woocommerce_Products/classes
 * @author     Slushman <chris@slushman.com>
 */
class Markets_For_Woocommerce_Products {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Markets_For_Woocommerce_Products_Loader    $loader    Maintains and registers all hooks for the plugin.
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

		$this->plugin_name = 'markets-for-woocommerce-products';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_taxonomy_hooks();

	} // __construct()

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		$this->loader 		= new Markets_For_Woocommerce_Products_Loader();
		$this->sanitize 	= new Markets_For_Woocommerce_Products_Sanitize();

	} // load_dependencies()

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Markets_For_Woocommerce_Products_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Markets_For_Woocommerce_Products_i18n();

		$this->loader->action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	} // set_locale()

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Markets_For_Woocommerce_Products_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	} // define_admin_hooks()

	/**
	 * Register all of the hooks related to the taxonomy.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_taxonomy_hooks() {

		$plugin_taxonomy = new Markets_For_Woocommerce_Products_Taxonomy_Market( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'init', $plugin_taxonomy, 'new_taxonomy_market' );
		$this->loader->action( 'init', $plugin_taxonomy, 'add_term_meta' );
		$this->loader->action( 'product_market_edit_form_fields', $plugin_taxonomy, 'market_image_edit', 99 );
		$this->loader->action( 'product_market_add_form_fields', $plugin_taxonomy, 'market_image_new', 99 );
		$this->loader->action( 'edit_product_market', $plugin_taxonomy, 'validate_meta' );
		$this->loader->action( 'create_product_market', $plugin_taxonomy, 'validate_meta' );

	} // define_taxonomy_hooks()

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
	 * @return    Markets_For_Woocommerce_Products_Loader    Orchestrates the hooks of the plugin.
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

} // class
