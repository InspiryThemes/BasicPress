<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Basic_Press
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<meta name="description" content="<?php

	if ( is_single() ) {
		single_post_title('', true);
	} else {
		bloginfo('name'); echo " - "; bloginfo('description');
	}

?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div class="site-header">
		<div class="container">
			<div class="row">
				<header id="masthead" role="banner">
					<div class="col-lg-6">
						<div class="site-branding">
							<?php

								$logo_path        = get_option('theme_sitelogo');
								$retina_logo_path = get_option('theme_sitelogo_retina');

								// site logo img or title with description
								basicpress_site_logo( $logo_path, $retina_logo_path );

							?>
						</div><!-- .site-branding -->
					</div>

					<div class="col-lg-6">
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'basic-press' ); ?></button>
							<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
						</nav><!-- #site-navigation -->
					</div>
				</header><!-- #masthead -->
			</div>
		</div>
	</div>



	<div id="content" class="site-content">
