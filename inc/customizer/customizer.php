<?php
/**
 * Basic Press Theme Customizer.
 *
 * @package Basic_Press
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function basic_press_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'basic_press_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function basic_press_customize_preview_js() {
	wp_enqueue_script( 'basic_press_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'basic_press_customize_preview_js' );


if ( ! function_exists( 'basicpress_sanitize' ) ) :
    /**
     * Default sanitize function to use where no sanitization needed.
     * It's to fulfil sanitization function requirement while adding a
     * customizer setting.
     *
     * @param Mixed
     * @return Mixed
     */
    function basicpress_sanitize( $value ) {
        return $value;
    }
endif;



/**
 * Customizer Settings
 */
require_once( get_template_directory() . '/inc/customizer/theme-settings/theme-settings.php' );