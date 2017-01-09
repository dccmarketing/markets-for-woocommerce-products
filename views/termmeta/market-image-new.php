<?php
/**
 * Template part for displaying the new term meta fields.
 *
 * @package Markets_For_Woocommerce_Products
 */

wp_nonce_field( basename( __FILE__ ), 'nonce_market_image' );

?><div class="form-field term-market-image-wrap"><?php

	$atts['id'] 			= 'market-image';
	$atts['label'] 			= esc_html__( 'Market Image', 'markets-for-woocommerce-products' );
	$atts['name'] 			= 'market-image';

	$atts = apply_filters( 'markets-for-woocommerce-products-field-' . $atts['id'], $atts );

	include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/image-upload.php' );
	unset( $atts );

?></div>
<div class="form-field term-market-thumb-wrap"><?php

	$atts['id'] 			= 'market-thumb';
	$atts['label'] 			= esc_html__( 'Market Image', 'markets-for-woocommerce-products' );
	$atts['label-remove'] 	= esc_html__( 'Remove thumb', 'markets-for-woocommerce-products' );
	$atts['label-upload'] 	= esc_html__( 'Choose/Upload thumb', 'markets-for-woocommerce-products' );
	$atts['name'] 			= 'market-thumb';

	$atts = apply_filters( 'markets-for-woocommerce-products-field-' . $atts['id'], $atts );

	include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/image-upload.php' );
	unset( $atts );

?></div>
