<?php

if( ! function_exists( 'basicpress_site_logo' ) ) {
    /**
     * Display logo image
     * @since   1.0.0
     * @param   $logo_url        // image name
     * @param   $logo_url_retina // image format
     * @return  void
     */
    function basicpress_site_logo( $logo_url, $logo_url_retina ){

        global $is_IE;

        if( ! empty( $logo_url ) && ! empty( $logo_url_retina ) && ! $is_IE ) {
            echo '<img alt="'. esc_attr( get_bloginfo( 'name' ) ) .'" src="'. esc_url( $logo_url ) .'" srcset="'. esc_url( $logo_url ) .', '. esc_url( $logo_url_retina ) .' 2x">';
        } else if( ! empty( $logo_url ) ) {
            echo '<img alt="'.  esc_attr( get_bloginfo( 'name' ) ) .'" src="'. esc_url( $logo_url ) .'">';
        } else {
            echo '<img alt="'.  esc_attr( get_bloginfo( 'name' ) ) .'" src="'. esc_url( $logo_url_retina ) .'">';
        }
    }
}