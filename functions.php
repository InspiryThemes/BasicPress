<?php
/**
 * Basic Press functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Basic_Press
 */

if ( ! function_exists( 'basic_press_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function basic_press_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Basic Press, use a find and replace
	 * to change 'basic-press' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'basic-press', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'basic-press' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'basic_press_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'basic_press_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function basic_press_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'basic_press_content_width', 640 );
}
add_action( 'after_setup_theme', 'basic_press_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function basic_press_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'basic-press' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'basic-press' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'basic_press_widgets_init' );

if( !function_exists( 'basicpress_add_editor_style' ) ) :
    /**
     * Add editor style
     */
    function basicpress_add_editor_style() {
        add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
    }
    add_action( 'admin_init', 'basicpress_add_editor_style' );
endif;

if ( ! function_exists( 'basic_press_styles' ) ) {
    /**
     * Enqueue styles.
     */
    function basicpress_styles()
    {

        $template_directory_uri = get_template_directory_uri();

        if (!is_admin()) :

            // bootstrap
            wp_enqueue_style(
                'bootstrap',
                $template_directory_uri . '/css/bootstrap/bootstrap.css',
                array(),
                '4.0.0'
            );

            // bootstrap
            wp_enqueue_style(
                'main',
                $template_directory_uri . '/css/main.css',
                array(),
                '1.0.0'
            );

            wp_enqueue_style('basicpress-style', get_stylesheet_uri());

        endif;


    }

    add_action('wp_enqueue_scripts', 'basicpress_styles');
}

if ( ! function_exists( 'basicpress_scripts' ) ) {
    /**
     * Enqueue scripts.
     */
    function basicpress_scripts()
    {

        // navigation
        wp_enqueue_script(
            'basic-press-navigation',
            get_template_directory_uri() . '/js/navigation.js',
            array(),
            '20151215',
            true
        );

        // skip link focus fix
        wp_enqueue_script(
            'basic-press-skip-link-focus-fix',
            get_template_directory_uri() . '/js/skip-link-focus-fix.js',
            array(),
            '20151215',
            true
        );

        // tether
        wp_enqueue_script(
            'tether',
            get_template_directory_uri() . '/js/tether.min.js',
            array('jquery'),
            '4.0.0',
            true
        );

        // bootstrap
        wp_enqueue_script(
            'bootstrap',
            get_template_directory_uri() . '/js/bootstrap.min.js',
            array('tether'),
            '4.0.0',
            true
        );

        // comment reply
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        // custom
        wp_enqueue_script(
            'basicpress',
            get_template_directory_uri() . '/js/basicpress.js',
            array('jquery'),
            '1.0.0',
            true
        );
    }

    add_action('wp_enqueue_scripts', 'basicpress_scripts');
}

if( ! function_exists( 'basicpress_debugging_info' ) ) {
    /**
     * Display commented debugging info in the site head
     */
    function basicpress_debugging_info() {

        if ( is_feed() ) return;

        $theme = wp_get_theme();
        $child = "";

        if( is_child_theme() ) {

            $child  = "- - - - - - - - - - -\n";
            $child .= "ChildTheme: " . $theme->get( 'Name' ) . "\n";
            $child .= "ChildTheme Version: " . $theme->get( 'Version' ) . "\n";
            $child .= "ChildTheme Installed: " . $theme->get( 'Template' ) . "\n\n";

            $theme = wp_get_theme( $theme->get( 'Template' ) );
        }

        $info  = "\n\n<!--\n";
        $info .= "Debugging Info for the theme support: \n\n";
        $info .= "Theme: " . $theme->get( 'Name' ) . "\n";
        $info .= "Version: " . $theme->get( 'Version' ) . "\n";
        $info .= "Installed: " . $theme->get_template() . "\n";

        $info .= $child;

        //memory setting, peak usage and number of active plugins
        $info .= "ML:" . trim( @ini_get( 'memory_limit' ) , 'M' ) . " PU:" . ( ceil( memory_get_peak_usage() / 1000 / 1000 ) ) . " AP:" . count( get_option( 'active_plugins' ) ) ."\n";
        $info .= "WP:" . get_bloginfo( 'version' ) . "\n";

        $info .= "-->\n\n";
        echo apply_filters( 'basicpress_debugging_info', $info );
    }

    add_action( 'wp_head', 'basicpress_debugging_info', 1000 );
    add_action( 'admin_print_scripts', 'basicpress_debugging_info', 1000 );
}

/**
 * Load Theme
 */
require_once( get_template_directory() . '/load-theme/load-theme.php' );
