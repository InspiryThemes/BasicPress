<?php
/**
 * Customizer settings with default controls
 */


if ( ! function_exists( 'basicpress_default_customizer' ) ) :
    function basicpress_default_customizer( WP_Customize_Manager $wp_customize ) {


    }

    add_action( 'customize_register', 'basicpress_default_customizer' );
endif;


if ( ! function_exists( 'inspiry_default_defaults' ) ) :
    /**
     * Set default values for settings
     *
     * @param WP_Customize_Manager $wp_customize
     */
    function inspiry_default_defaults( WP_Customize_Manager $wp_customize ) {
        $settings_ids = array(
            'inspiry_header_top_bar',
        );

        basicpress_initialize_defaults( $wp_customize, $settings_ids );
    }

    add_action( 'customize_save_after', 'inspiry_default_defaults' );
endif;