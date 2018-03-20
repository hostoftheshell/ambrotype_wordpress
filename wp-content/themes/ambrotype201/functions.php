<?php
/**
 * Ambrotype201 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Ambrotype201
 */

if ( ! function_exists( 'ambrotype201_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ambrotype201_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ambrotype201, use a find and replace
		 * to change 'ambrotype201' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ambrotype201', get_template_directory() . '/languages' );

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
		function register_my_menus() {
			register_nav_menus(
				array(
					'primary' => esc_html__( 'Header', 'ambrotype201'),
					'social' => esc_html__( 'Social Media', 'ambrotype201'),
					)
				);
		}
		add_action( 'init', 'register_my_menus' );

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
		add_theme_support( 'custom-background', apply_filters( 'ambrotype201_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 75,
			'width'       => 268,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ambrotype201_setup' );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function ambrotype201_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'ambrotype201-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'ambrotype201_resource_hints', 10, 2 );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ambrotype201_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ambrotype201_content_width', 640 );
}
add_action( 'after_setup_theme', 'ambrotype201_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ambrotype201_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ambrotype201' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ambrotype201' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ambrotype201_widgets_init' );

/**
 * Enqueue scripts and styles.
 */


function ambrotype201_scripts() {
	
	// Enqueue Google Fonts: Inconsolata, Open Sans 
	wp_enqueue_style('ambrotype201-fonts', 'https://fonts.googleapis.com/css?family=Inconsolata:400,700|Open+Sans:400,400i,700');
	
	wp_register_script( 'FontAwesome', 'https://use.fontawesome.com/releases/v5.0.2/js/all.js', null, null, true );
	wp_enqueue_script('FontAwesome');
	
	// // all styles
	// wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css', array(), 20141119 );
	// wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css', array(), 20141119 );
	// // all scripts
	// wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20120206', true );
	// wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '20120206', true );

	wp_enqueue_style( 'ambrotype201-style', get_stylesheet_uri() );
	// Navigation
	wp_enqueue_script( 'ambrotype201-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	// dropDown Menu
	wp_localize_script('ambrotype201-navigation', 'ambrotype201ScreenReaderText', array(
		'expand' => __('Expand child menu', 'ambrotype201'),
		'collapse' => __('Collapse child menu', 'ambrotype201')
	));
	
	wp_enqueue_script( 'ambrotype201-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ambrotype201_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Customize Woocommerce Single Product Page
 */

// rating
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating,', 10);
// category
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
// tabs : review | description
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

// Change ADD TO CART button
add_filter( 'woocommerce_product_single_add_to_cart_text', 'wc_wdo_custom_single_addtocart_text' );
function wc_wdo_custom_single_addtocart_text() {
    return "Réservez !"; //  Change "Réservez !" with the text you want to see
}


// /**
//  * Load bc_custom
//  */
// require_once TEMPLATEPATH . '/inc/bc_custom.php';
// /**
//  * Display bc_custom
//  */
// add_filter('pre_get_posts', 'bc_get_posts');

// function bc_get_posts( $query) {
// 	if (is_home())
// 	$query->set( 'post_type', ['studio', 'post']);
// 	return $query;
// }
