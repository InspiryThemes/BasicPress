<?php

if( ! function_exists( 'basicpress_logo_img' ) ) {
    /**
     * Display logo image
     * @since   1.0.0
     * @param   $logo_url // logo img url
     * @param   $retina_logo_url // retina logo image url
     * @return  void
     */
    function basicpress_logo_img( $logo_url, $retina_logo_url ){

        global $is_IE;

        if( ! empty( $logo_url ) && ! empty( $retina_logo_url ) && ! $is_IE ) {
            echo '<img alt="'. esc_attr( get_bloginfo( 'name' ) ) .'" src="'. esc_url( $logo_url ) .'" srcset="'. esc_url( $logo_url ) .', '. esc_url( $retina_logo_url ) .' 2x">';
        } else if( ! empty( $logo_url ) ) {
            echo '<img alt="'.  esc_attr( get_bloginfo( 'name' ) ) .'" src="'. esc_url( $logo_url ) .'">';
        } else {
            echo '<img alt="'.  esc_attr( get_bloginfo( 'name' ) ) .'" src="'. esc_url( $retina_logo_url ) .'">';
        }
    }
}

if( ! function_exists( 'basicpress_site_logo' ) ) {
    /**
     * Display logo image or site title with description
     * @since   1.0.0
     * @param   $logo_path // logo img url
     * @param   $retina_logo_path // retina logo image url
     * @return  void
     */
    function basicpress_site_logo( $logo_path, $retina_logo_path )
    {

        if (!empty($logo_path) || !empty($retina_logo_path)) {
            ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" title="<?php bloginfo('name'); ?>">
                <?php basicpress_logo_img( $logo_path, $retina_logo_path ); ?>
            </a>
            <?php
        } else {
            ?>
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                      rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php

            $description = get_bloginfo('description');
            if ($description) {
                echo '<small class="tag-line">';
                echo esc_html($description);
                echo '</small>';
            }
        }
    }
}