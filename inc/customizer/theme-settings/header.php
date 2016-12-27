<?php
/**
 * Customizer settings for Header
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


        /**
         * Header Panel
         */
        $wp_customize->add_section( 'inspiry_header_panel', array(
            'title' => esc_html__( 'Header', 'inspiry-tourpress' ),
            'priority' => 160
        ) );

        $wp_customize->add_setting( 'inspiry_header_top_bar', array(
            'type' => 'option',
            'default' => 'show',
            'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control( 'inspiry_header_top_bar', array(
            'label'      => 'Search Form',
            'section'    => 'inspiry_header_panel',
            'settings'   => 'inspiry_header_top_bar',
            'type'       => 'radio',
            'choices'    => array(
                'show'   => 'Show',
                'hide'   => 'Hide',
            ),
        ) );


    }

    add_action( 'customize_register', 'inspiry_header_customizer' );
endif;


if ( ! function_exists( 'inspiry_header_defaults' ) ) :
    /**
     * Set default values for header settings
     *
     * @param WP_Customize_Manager $wp_customize
     */
    function inspiry_header_defaults( WP_Customize_Manager $wp_customize ) {
        $header_settings_ids = array(
            'inspiry_header_top_bar',
        );
        inspiry_initialize_defaults( $wp_customize, $header_settings_ids );
    }

    add_action( 'customize_save_after', 'inspiry_header_defaults' );
endif;