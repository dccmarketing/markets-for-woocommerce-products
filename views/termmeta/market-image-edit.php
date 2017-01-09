<?php
/**
 * Template part for displaying the new term meta fields.
 *
 * @package Markets_For_Woocommerce_Products
 */

wp_nonce_field( basename( __FILE__ ), 'nonce_market_image' );

?><tr class="form-field term-market-image-wrap">
	<th scope="row"><label for="market-image"><?php

		esc_html_e( 'Market Image', 'markets-for-woocommerce-products' );

	?></label></th>
	<td><?php

	$atts['id'] 			= 'market-image';
	$atts['name'] 			= 'market-image';

	$meta = $this->get_term_meta_value( $term->term_id, $atts['id'], 'hidden' );

	if ( ! empty( $meta ) ) {

		$atts['value'] = $meta;

	}

	$atts = apply_filters( 'markets-for-woocommerce-products-field-' . $atts['id'], $atts );

	include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/image-upload.php' );
	unset( $atts );

	?></td>
</tr>
<tr class="form-field term-market-thumb-wrap">
	<th scope="row"><label for="market-thumb"><?php

		esc_html_e( 'Market Thumbnail', 'markets-for-woocommerce-products' );

	?></label></th>
	<td><?php

	$atts['id'] 			= 'market-thumb';
	$atts['label-remove'] 	= esc_html__( 'Remove thumb', 'markets-for-woocommerce-products' );
	$atts['label-upload'] 	= esc_html__( 'Choose/Upload thumb', 'markets-for-woocommerce-products' );
	$atts['name'] 			= 'market-thumb';

	$meta = $this->get_term_meta_value( $term->term_id, $atts['id'], 'hidden' );

	if ( ! empty( $meta ) ) {

		$atts['value'] = $meta;

	}

	$atts = apply_filters( 'markets-for-woocommerce-products-field-' . $atts['id'], $atts );

	include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/image-upload.php' );
	unset( $atts );

	?></td>
</tr>
