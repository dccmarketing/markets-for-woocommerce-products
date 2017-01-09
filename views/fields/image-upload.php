<?php

/**
 * Provides the markup for an upload field
 *
 * Saves the Image ID in the hidden input.
 *
 * @package    Markets_For_Woocommerce_Products
 */
$defaults['class'] 			= 'widefat';
$defaults['description'] 	= __( '', 'markets-for-woocommerce-products' );
$defaults['id'] 			= '';
$defaults['label'] 			= __( '', 'markets-for-woocommerce-products' );
$defaults['label-remove'] 	= __( 'Remove image', 'markets-for-woocommerce-products' );
$defaults['label-upload'] 	= __( 'Choose/Upload image', 'markets-for-woocommerce-products' );
$defaults['name'] 			= '';
$defaults['placeholder'] 	= __( '', 'markets-for-woocommerce-products' );
$defaults['value'] 			= '';
$atts 						= wp_parse_args( $atts, $defaults );
$remove_class 				= ( empty( $atts['value'] ) ? 'hide' : '' );
$upload_class 				= ( empty( $atts['value'] ) ? '' : 'hide' );
$preview_class 				= ( empty( $atts['value'] ) ? 'image-upload-preview bordered' : 'image-upload-preview' );
$thumbnail 					= ( empty( $atts['value'] ) ? '' : wp_get_attachment_image_src( $atts['value'] )[0] );

?><div class="image-upload-field"><?php

	if ( ! empty( $atts['label'] ) ) :

		?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php echo wp_kses( $atts['label'], array( 'code' => array() ) ); ?>: </label><?php

	endif;

	?><div class="<?php echo esc_attr( $preview_class ); ?>" id="<?php echo esc_attr( $atts['id'] . '-img' ); ?>" style="background-image:url(<?php echo esc_url( $thumbnail ); ?>);"></div>
	<input <?php

		if ( ! empty( $atts['data'] ) ) {

			foreach ( $atts['data'] as $key => $value ) {

				?>data-<?php echo $key; ?>="<?php echo esc_attr( $value ); ?>"<?php

			}

		}

		?>id="<?php echo esc_attr( $atts['id'] ); ?>"
		name="<?php echo esc_attr( $atts['name'] ); ?>"
		type="hidden"
		value="<?php echo esc_attr( $atts['value'] ); ?>" />
	<a href="#" class="<?php echo esc_attr( $upload_class ); ?>" id="upload-img"><?php
		echo wp_kses( $atts['label-upload'], array( 'code' => array() ) );
	?></a>
	<a href="#" class="<?php echo esc_attr( $remove_class ); ?>" id="remove-img"><?php
		echo wp_kses( $atts['label-remove'], array( 'code' => array() ) );
	?></a>
</div><!-- .image-upload-field -->
<p class="description"><?php echo wp_kses( $atts['description'], array( 'code' => array() ) ); ?></p>
