<?php
/**
 * Customizer settings for Site Identity
 */

if ( ! function_exists( 'inspiry_site_identity_customizer' ) ) :
    function inspiry_site_identity_customizer( WP_Customize_Manager $wp_customize ) {

        /**
         * Site Identity (logo)
         */
        $wp_customize->add_setting( 'theme_sitelogo', array(
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_sitelogo', array(
            'label' => esc_html__( 'Site Logo', 'inspiry-tourpress' ),
            'section' => 'title_tagline',   // id of site identity section - Ref: https://developer.wordpress.org/themes/advanced-topics/customizer-api/
            'settings' => 'theme_sitelogo',
            'priority' => 100,
        ) ) );

        /**
         * Site Identity ( retina logo)
         */
        $wp_customize->add_setting( 'theme_sitelogo_retina', array(
            'type' => 'option',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_sitelogo_retina', array(
            'label' => esc_html__( 'Site Retina Logo', 'inspiry-tourpress' ),
            'description' => esc_html__( 'Upload double size of your default logo image. For example, if your default logo image size is 185px by 24px then your retina logo image size should be 370px by 48px.', 'inspiry-tourpress' ),
            'section' => 'title_tagline',
            'settings' => 'theme_sitelogo_retina',
            'priority' => 110,
        ) ) );

    }

    add_action( 'customize_register', 'inspiry_site_identity_customizer' );
endif;