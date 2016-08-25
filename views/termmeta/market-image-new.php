<?php
/**
 * Template part for displaying the new term meta fields.
 *
 * @package Markets_For_Woocommerce_Products
 */

wp_nonce_field( basename( __FILE__ ), 'nonce_market_image' );

?><div class="form-field term-market-image-wrap"><?php

	$atts 					= array();
	$atts['description'] 	= esc_html__( '', 'markets-for-woocommerce-products' );
	$atts['id'] 			= 'market-image';
	$atts['label'] 			= esc_html__( 'Market Image', 'markets-for-woocommerce-products' );
	$atts['label-remove'] 	= esc_html__( 'Remove image', 'markets-for-woocommerce-products' );
	$atts['label-upload'] 	= esc_html__( 'Choose/Upload image', 'markets-for-woocommerce-products' );
	$atts['name'] 			= 'market-image';
	$atts['value'] 			= '';

	$atts = apply_filters( 'markets-for-woocommerce-products-field-' . $atts['id'], $atts );

	include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/image-upload.php' );

?></div>
