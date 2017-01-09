<?php

/**
 * The taxonomy-specific functionality of the plugin.
 *
 * Defines a taxonomy and other related functionality.
 *
 * @since 		1.0.0
 *
 * @package 	Markets_For_Woocommerce_Products
 * @subpackage 	Markets_For_Woocommerce_Products/classes
 * @author		Slushman <chris@slushman.com>
 */
class Markets_For_Woocommerce_Products_Taxonomy_Market {

	/**
	 * The term meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The term meta data.
	 */
	private $meta;

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
	 * Constructor
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

	} // __construct()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_term_meta() {

		// register_meta( $meta_type, $meta_key, $sanitize_callback, $auth_callback );

		register_meta( 'term', 'market-image', '' );
		register_meta( 'term', 'market-thumb', '' );

	} // add_term_meta()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 		= 'nonce_market_image';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->plugin_name ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * $fields[] 	= array( 'field-name', 'field-type', 'Field Label' );
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_term_fields() {

		$fields = array();

		$fields[] 	= array( 'market-image', 'hidden', '' );
		$fields[] 	= array( 'market-thumb', 'hidden', '' );
		$fields[] 	= array( 'market-file', 'url', '' );

		return $fields;

	} // get_term_fields()

	/**
	 * Returns the requested term meta.
	 *
	 * @exits 		If $term_id, $key, or $type are empty.
	 * @param 		int 		$term_id 		The term ID.
	 * @param  		string 		$key 			The meta key.
	 * @param  		string 		$type    		The data type.
	 * @return 		string 						The sanitized meta data.
	 */
	private function get_term_meta_value( $term_id, $key, $type ) {

		if ( empty( $term_id ) || empty( $key ) || empty( $type ) ) { return; }

		$value 		= get_term_meta( $term_id, $key, true );
		$sanitizer 	= new Markets_For_Woocommerce_Products_Sanitize();

		return $sanitizer->clean( $value, $type );

	} // get_term_meta_value()

	/**
	 * Includes the view for the term meta edit fields.
	 *
	 * @exits 		If not in the admin.
	 * @exits 		If not on the product_market taxonomy.
	 * @param 		object 		$term 		The term object
	 */
	public function market_image_edit( $term ) {

		if ( ! is_admin() ) { return; }
		if ( 'product_market' !== $term->taxonomy ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/termmeta/market-image-edit.php' );

	} // market_image_edit()

	/**
	 * Includes the view for the new term meta fields.
	 */
	public function market_image_new() {

		if ( ! is_admin() ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/termmeta/market-image-new.php' );

	} // market_image_new()

	/**
	 * Creates a new taxonomy for a custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public static function new_taxonomy_market() {

		$tax_name 	= 'product_market';

		$opts['hierarchical']							= TRUE;
		//$opts['meta_box_cb'] 							= '';
		$opts['public']									= TRUE;
		$opts['query_var']								= $tax_name;
		$opts['show_admin_column'] 						= FALSE;
		$opts['show_in_nav_menus']						= TRUE;
		$opts['show_tag_cloud'] 						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';

		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';

		$opts['labels']['add_new_item'] 				= esc_html__( 'Add New Market', 'markets-for-woocommerce-products' );
		$opts['labels']['add_or_remove_items'] 			= esc_html__( 'Add or remove markets', 'markets-for-woocommerce-products' );
		$opts['labels']['all_items'] 					= esc_html__( 'Markets', 'markets-for-woocommerce-products' );
		$opts['labels']['choose_from_most_used'] 		= esc_html__( 'Choose from most used markets', 'markets-for-woocommerce-products' );
		$opts['labels']['edit_item'] 					= esc_html__( 'Edit Market' , 'markets-for-woocommerce-products');
		$opts['labels']['menu_name'] 					= esc_html__( 'Markets', 'markets-for-woocommerce-products' );
		$opts['labels']['name'] 						= esc_html__( 'Markets', 'markets-for-woocommerce-products' );
		$opts['labels']['new_item_name'] 				= esc_html__( 'New Market Name', 'markets-for-woocommerce-products' );
		$opts['labels']['not_found'] 					= esc_html__( 'No Markets Found', 'markets-for-woocommerce-products' );
		$opts['labels']['parent_item'] 					= esc_html__( 'Parent Market', 'markets-for-woocommerce-products' );
		$opts['labels']['parent_item_colon'] 			= esc_html__( 'Parent Market:', 'markets-for-woocommerce-products' );
		$opts['labels']['popular_items'] 				= esc_html__( 'Popular Markets', 'markets-for-woocommerce-products' );
		$opts['labels']['search_items'] 				= esc_html__( 'Search Markets', 'markets-for-woocommerce-products' );
		$opts['labels']['separate_items_with_commas'] 	= esc_html__( 'Separate Markets with commas', 'markets-for-woocommerce-products' );
		$opts['labels']['singular_name'] 				= esc_html__( 'Market', 'markets-for-woocommerce-products' );
		$opts['labels']['update_item'] 					= esc_html__( 'Update Market', 'markets-for-woocommerce-products' );
		$opts['labels']['view_item'] 					= esc_html__( 'View Market', 'markets-for-woocommerce-products' );

		$opts['rewrite']['ep_mask']						= EP_NONE;
		$opts['rewrite']['hierarchical']				= FALSE;
		$opts['rewrite']['slug']						= esc_html__( 'market', 'markets-for-woocommerce-products' );
		$opts['rewrite']['with_front']					= FALSE;

		$opts = apply_filters( 'markets-for-woocommerce-products-taxonomy-options', $opts );

		register_taxonomy( $tax_name, 'product', $opts );

	} // new_taxonomy_market()

	/**
	 * Saves term meta data
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @param 		int 		$term_id 		The term ID
	 * @return 		array 		$ids 			An array of the meta IDs.
	 */
	public function validate_meta( $term_id ) {

		if ( ! current_user_can( 'edit_posts' ) ) { return $term_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 >= $nonce_check ) { return $term_id; }

		$metas = $this->get_term_fields();
		$ids = array();

		foreach ( $metas as $meta ) {

			$value 		= ( empty( $this->meta[$meta[0]][0] ) ? '' : $this->meta[$meta[0]][0] );
			$sanitizer 	= new Markets_For_Woocommerce_Products_Sanitize();
			$new_value 	= $sanitizer->clean( $_POST[$meta[0]], $meta[1] );
			$ids 		= update_term_meta( $term_id, $meta[0], $new_value );

			unset( $value );
			unset( $sanitizer );
			unset( $new_value );

		} // foreach

		return $ids;

	} // validate_meta()

} // class
