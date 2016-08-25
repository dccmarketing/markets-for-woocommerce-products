<?php

/**
 * The plugin bootstrap file
 *
 * @link              http://slushman.com
 * @since             1.0.0
 * @package           Markets_For_Woocommerce_Products
 *
 * @wordpress-plugin
 * Plugin Name:       Markets for WooCommerce Products
 * Plugin URI:        http://dccmarketing.com
 * Description:       Adds the Markets taxonomy to WooCommerce Products
 * Version:           1.1
 * Author:            Slushman
 * Author URI:        http://slushman.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       markets-for-woocommerce-products
 * Domain Path:       /languages
 */

 // If this file is called directly, abort.
 if ( ! defined( 'WPINC' ) ) { die; }

 // Used for referring to the plugin file or basename
 if ( ! defined( 'WOOCOMMERCE_MARKETS' ) ) {
 	define( 'WOOCOMMERCE_MARKETS', plugin_basename( __FILE__ ) );
 }

 /**
  * Runs during plugin activation.
  * This action is documented in classes/class-activator.php
  */
 register_activation_hook( __FILE__, array( 'Markets_For_Woocommerce_Products_Activator', 'activate' ) );

 /**
  * Code that runs during plugin deactivation.
  * This action is documented in classes/class-deactivator.php
  */
 register_deactivation_hook( __FILE__, array( 'Markets_For_Woocommerce_Products_Deactivator', 'deactivate' ) );

 /**
 * Autoloader function
 *
 * Will search both plugin root and includes folder for class
 *
 * @param string $class_name
 */
if ( ! function_exists( 'markets_for_woocommerce_products_autoloader' ) ) :

	function markets_for_woocommerce_products_autoloader( $class_name ) {

		$class_name = str_replace( 'Markets_For_Woocommerce_Products_', '', $class_name );
		$lower 		= strtolower( $class_name );
		$file      	= 'class-' . str_replace( '_', '-', $lower ) . '.php';
		$base_path 	= plugin_dir_path( __FILE__ );
		$paths[] 	= $base_path . $file;
		$paths[] 	= $base_path . 'classes/' . $file;

		/**
		 * plugin_name_autoloader_paths filter
		 */
		$paths = apply_filters( 'woocommerce-markets-autoloader-paths', $paths );

		foreach ( $paths as $path ) :

			if ( is_readable( $path ) ) {

				include_once( $path );
				return;

			}

		endforeach;

	} // markets_for_woocommerce_products_autoloader()

	spl_autoload_register( 'markets_for_woocommerce_products_autoloader' );

endif;

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
call_user_func( array( new Markets_For_Woocommerce_Products(), 'run' ) );
