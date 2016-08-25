<?php

/**
 * Fired during plugin activation
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Markets_For_Woocommerce_Products
 * @subpackage Markets_For_Woocommerce_Products/classes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Markets_For_Woocommerce_Products
 * @subpackage Markets_For_Woocommerce_Products/classes
 * @author     Slushman <chris@slushman.com>
 */
class Markets_For_Woocommerce_Products_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( __FILE__ ) . 'class-taxonomy-market.php';

		Markets_For_Woocommerce_Products_Taxonomy_Market::new_taxonomy_market();

		flush_rewrite_rules();

	} // activate()

} // class
