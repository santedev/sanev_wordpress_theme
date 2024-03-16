<?php
/**
 * sanev_WooCommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sanev_WooCommerce
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sanev_woocommerce_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on sanev_WooCommerce, use a find and replace
		* to change 'sanev_woocommerce' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'sanev_woocommerce', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'sanev_woocommerce' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'sanev_woocommerce_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'sanev_woocommerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sanev_woocommerce_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'sanev_woocommerce_content_width', 640 );
}
add_action( 'after_setup_theme', 'sanev_woocommerce_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sanev_woocommerce_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'sanev_woocommerce' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'sanev_woocommerce' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'sanev_woocommerce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sanev_woocommerce_scripts() {
	wp_enqueue_style( 'sanev_woocommerce-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'sanev_woocommerce_main', get_template_directory_uri() . '/css/main.css', _S_VERSION );
	wp_enqueue_style( 'sanev_woocommerce_main_style', get_template_directory_uri() . '/css/style.css', _S_VERSION );
	wp_style_add_data( 'sanev_woocommerce-style', 'rtl', 'replace' );

	wp_enqueue_script( 'sanev_woocommerce_mobile_bar', get_template_directory_uri() . '/js/mobileBar.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'sanev_woocommerce_theme_toggler', get_template_directory_uri() . '/js/themeToggler.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sanev_woocommerce_scripts', 0);



/**
 * Custom fonts.
 */

function sanev_woocommerce_fonts(){
	if ( !is_admin() ){
		wp_register_style( 'Poppins', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' );
		wp_enqueue_style( 'Poppins' );
		wp_register_style( 'Source sans 3', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap' );
		wp_enqueue_style( 'Source sans 3' );
	}
 }
 add_action( 'wp_enqueue_scripts', 'sanev_woocommerce_fonts' );

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

function remove_unwanted_sections($wp_customize) {
    // Remove the "Colors" section
    $wp_customize->remove_section('colors');
}
add_action('customize_register', 'remove_unwanted_sections');


function sanev_customize_register ( $wp_customize ) {
	$wp_customize->add_section('snv_colors', array(
		'title' => __('Theme Colors', 'sanev'),
		'priority' => 30,
	));
	$wp_customize->add_section('snv_dark_mode_colors', array(
		'title' => __('Theme Dark Mode Colors', 'sanev_dark_mode'),
		'priority' => 30,
	));

	$wp_customize->add_setting('snv_primary_color', array(
		'default' => '#ffcdc9',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_bg_primary_color', array(
		'default' => '#ffcdc9',
		'transport' => 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'snv_primary_color_control', array(
		'label' => __('Text primary color', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_primary_color',
	)));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'snv_bg_primary_color_control', array(
		'label' => __('Background primary color', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_bg_primary_color',
	)));

	$wp_customize->add_setting('snv_secondary_color', array(
		'default' => '#007bff',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_bg_secondary_color', array(
		'default' => '#007bff', 
		'transport' => 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'snv_secondary_color_control', array(
		'label' => __('Text secondary color', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_secondary_color',
	)));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'snv_bg_secondary_color_control', array(
		'label' => __('Background secondary color', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_bg_secondary_color',
	)));

	$wp_customize->add_setting('snv_black_color', array(
		'default' => '#ffcdc8',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_bg_black_color', array(
		'default' => '#ffcdc8',
		'transport' => 'refresh',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'snv_black_color_control', array(
		'label' => __('Text black', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_black_color',
	)));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'snv_bg_black_color_control', array(
		'label' => __('Background black', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_bg_black_color',
	)));
	
	$wp_customize->add_setting('snv_white_color', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_bg_white_color', array(
    	'default' => '#ffffff',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_white_color_control', array(
		'label' => __('Text White', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_white_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_bg_white_color_control', array(
		'label' => __('Background White', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_bg_white_color',
	)));

	$wp_customize->add_setting('snv_muted_color', array(
		'default' => '#999999',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_bg_muted_color', array(
		'default' => '#f2f2f2',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_muted_color_control', array(
		'label' => __('Text Muted', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_muted_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_bg_muted_color_control', array(
		'label' => __('Background Muted', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_bg_muted_color',
	)));



	$wp_customize->add_setting('snv_var_primary_color', array(
		'default' => '#f2f2f2',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_primary_color_dark', array(
		'default' => '#ytuytu',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_primary_color_control', array(
		'label' => __('Primary', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_primary_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_primary_color_control_dark', array(
		'label' => __('Primary (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_primary_color_dark',
	)));

	$wp_customize->add_setting('snv_var_secondary_color', array(
		'default' => '#262626',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_secondary_color_dark', array(
    	'default' => '#262626',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_secondary_color_control', array(
		'label' => __('Secondary', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_secondary_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_secondary_color_control_dark', array(
		'label' => __('Secondary (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_secondary_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_accent_color', array(
		'default' => '#f8ffb8',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_accent_color_dark', array(
		'default' => '#f8ffb8',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_accent_color_control', array(
		'label' => __('Accent', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_accent_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_accent_color_control_dark', array(
		'label' => __('Accent (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_accent_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_main_color', array(
		'default' => '#edecf5',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_main_color_dark', array(
		'default' => '#edecf5',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_main_color_control', array(
		'label' => __('Main', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_main_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_main_color_control_dark', array(
		'label' => __('Main (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_main_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_light_bg_color', array(
		'default' => '#1e3852',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_light_bg_color_dark', array(
		'default' => '#1e3852',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_light_bg_color_control', array(
		'label' => __('Light Background', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_light_bg_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_light_bg_color_control_dark', array(
		'label' => __('Light Background (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_light_bg_color_dark',
	)));

	$wp_customize->add_setting('snv_var_dark_bg_color', array(
		'default' => '#1e3852',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_dark_bg_color_dark', array(
		'default' => '#1e3852',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_dark_bg_color_control', array(
		'label' => __('Dark Background', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_dark_bg_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_dark_bg_color_control_dark', array(
		'label' => __('Dark Background (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_dark_bg_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_menu_bg_color', array(
		'default' => '#031629',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_menu_bg_color_dark', array(
    	'default' => '#031629',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_menu_bg_color_control', array(
		'label' => __('Menu Background', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_menu_bg_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_menu_bg_color_control_dark', array(
		'label' => __('Menu Background (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_menu_bg_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_menu_text_color', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_menu_text_color_dark', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_menu_text_color_control', array(
		'label' => __('Menu Text Color', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_menu_text_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_menu_text_color_control_dark', array(
		'label' => __('Menu Text Color (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_menu_text_color_dark',
	)));

	$wp_customize->add_setting('snv_var_focus_color', array(
		'default' => '#2d22ff',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_focus_color_dark', array(
		'default' => '#2d22ff',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_focus_color_control', array(
		'label' => __('Focus', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_focus_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_focus_color_control_dark', array(
		'label' => __('Focus (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_focus_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_hover_color', array(
		'default' => '#12197e',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_hover_color_dark', array(
		'default' => '#12197e',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_hover_color_control', array(
		'label' => __('Hover', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_hover_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_hover_color_control_dark', array(
		'label' => __('Hover (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_hover_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_white_color', array(
		'default' => '#ffffff',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_white_color_dark', array(
    	'default' => '#ffffff',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_white_color_control', array(
		'label' => __('White', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_white_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_white_color_control_dark', array(
		'label' => __('White (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_white_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_muted_color', array(
		'default' => '#ababab',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_muted_color_dark', array(
    	'default' => '#ababab',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_muted_color_control', array(
		'label' => __('Muted', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_muted_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_muted_color_control_dark', array(
		'label' => __('Muted (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_muted_color_dark',
	)));
	
	$wp_customize->add_setting('snv_var_black_color', array(
		'default' => '#05050b',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_black_color_dark', array(
    	'default' => '#05050b',
    	'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_black_color_control', array(
		'label' => __('Black', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_black_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_black_color_control_dark', array(
		'label' => __('Black (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_black_color_dark',
	)));

	$wp_customize->add_setting('snv_var_warning_color', array(
    'default' => '#e1ce3f',
    'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_warning_color_dark', array(
		'default' => '#e1ce3f',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_warning_color_control', array(
		'label' => __('Warning', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_warning_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_warning_color_control_dark', array(
		'label' => __('Warning (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_warning_color_dark',
	)));

	$wp_customize->add_setting('snv_var_info_color', array(
		'default' => '#24669f',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_info_color_dark', array(
		'default' => '#24669f',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_info_color_control', array(
		'label' => __('Info', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_info_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_info_color_control_dark', array(
		'label' => __('Info (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_info_color_dark',
	)));

	$wp_customize->add_setting('snv_var_success_color', array(
		'default' => '#11671e',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_success_color_dark', array(
		'default' => '#11671e',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_success_color_control', array(
		'label' => __('Success', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_success_color',
	)));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_success_color_control_dark', array(
		'label' => __('Success (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_success_color_dark',
	)));

	$wp_customize->add_setting('snv_var_alert_color', array(
		'default' => '#c70e0e',
		'transport' => 'refresh',
	));
	$wp_customize->add_setting('snv_var_alert_color_dark', array(
		'default' => '#c70e0e',
		'transport' => 'refresh',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_alert_color_control', array(
		'label' => __('Alert', 'sanev'),
		'section' => 'snv_colors',
		'settings' => 'snv_var_alert_color',
	)));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'snv_var_alert_color_control_dark', array(
		'label' => __('Alert (Dark Mode)', 'sanev_dark_mode'),
		'section' => 'snv_dark_mode_colors',
		'settings' => 'snv_var_alert_color_dark',
	)));	
}

add_action('customize_register', 'sanev_customize_register');

function sanev_customize_css() { ?>
	<style type="text/css">
		:root {
			--primary: <?php echo get_theme_mod('snv_var_primary_color', '#f2f2f2'); ?>;
			--secondary: <?php echo get_theme_mod('snv_var_secondary_color', '#f2f2f2'); ?>;
			--accent: <?php echo get_theme_mod('snv_var_accent_color', '#f2f2f2'); ?>;
			--main: <?php echo get_theme_mod('snv_var_main_color', '#f2f2f2'); ?>;
			--light-bg: <?php echo get_theme_mod('snv_var_light_bg_color', '#f2f2f2'); ?>;
			--dark-bg: <?php echo get_theme_mod('snv_var_dark_bg_color', '#f2f2f2'); ?>;
			--menu-bg: <?php echo get_theme_mod('snv_var_menu_bg_color', '#f2f2f2'); ?>;
			--menu-text-color: <?php echo get_theme_mod('snv_var_menu_text_color', '#f2f2f2'); ?>;
			--focus: <?php echo get_theme_mod('snv_var_focus_color', '#f2f2f2'); ?>;
			--hover: <?php echo get_theme_mod('snv_var_hover_color', '#f2f2f2'); ?>;
			--white: <?php echo get_theme_mod('snv_var_white_color', '#f2f2f2'); ?>;
			--muted: <?php echo get_theme_mod('snv_var_muted_color', '#f2f2f2'); ?>;
			--black: <?php echo get_theme_mod('snv_var_black_color', '#f2f2f2'); ?>;
			--success: <?php echo get_theme_mod('snv_var_success_color', '#f2f2f2'); ?>;
			--warning: <?php echo get_theme_mod('snv_var_warning_color', '#f2f2f2'); ?>;
			--alert: <?php echo get_theme_mod('snv_var_alert_color', '#f2f2f2'); ?>;
			--info: <?php echo get_theme_mod('snv_var_info_color', '#f2f2f2'); ?>;
		}

		.dark-mode {
			--primary: <?php echo get_theme_mod('snv_var_primary_color_dark', '#f2f2f2'); ?>;
			--secondary: <?php echo get_theme_mod('snv_var_secondary_color_dark', '#f2f2f2'); ?>;
			--accent: <?php echo get_theme_mod('snv_var_accent_color_dark', '#f2f2f2'); ?>;
			--main: <?php echo get_theme_mod('snv_var_main_color_dark', '#f2f2f2'); ?>;
			--light-bg: <?php echo get_theme_mod('snv_var_light_bg_color_dark', '#f2f2f2'); ?>;
			--dark-bg: <?php echo get_theme_mod('snv_var_dark_bg_color_dark', '#f2f2f2'); ?>;
			--menu-bg: <?php echo get_theme_mod('snv_var_menu_bg_color_dark', '#f2f2f2'); ?>;
			--menu-text-color: <?php echo get_theme_mod('snv_var_menu_text_color_dark', '#f2f2f2'); ?>;
			--focus: <?php echo get_theme_mod('snv_var_focus_color_dark', '#f2f2f2'); ?>;
			--hover: <?php echo get_theme_mod('snv_var_hover_color_dark', '#f2f2f2'); ?>;
			--white: <?php echo get_theme_mod('snv_var_white_color_dark', '#f2f2f2'); ?>;
			--muted: <?php echo get_theme_mod('snv_var_muted_color_dark', '#f2f2f2'); ?>;
			--black: <?php echo get_theme_mod('snv_var_black_color_dark', '#f2f2f2'); ?>;
			--success: <?php echo get_theme_mod('snv_var_success_color_dark', '#f2f2f2'); ?>;
			--warning: <?php echo get_theme_mod('snv_var_warning_color_dark', '#f2f2f2'); ?>;
			--alert: <?php echo get_theme_mod('snv_var_alert_color_dark', '#f2f2f2'); ?>;
			--info: <?php echo get_theme_mod('snv_var_info_color_dark', '#f2f2f2'); ?>;
		}

		.bg-primary {
			background: <?php echo get_theme_mod( 'snv_bg_primary_color' ); ?>;
		}
		.primary {
			color: <?php echo get_theme_mod( 'snv_primary_color' ); ?>;
		}
		.bg-secondary {
			background: <?php echo get_theme_mod( 'snv_bg_secondary_color' ); ?>;
		}
		.secondary {
			color: <?php echo get_theme_mod( 'snv_secondary_color' ); ?>;
		}
		.bg-black {
			background: <?php echo get_theme_mod( 'snv_bg_black_color' ); ?>;
		}
		.black {
			color: <?php echo get_theme_mod( 'snv_black_color' ); ?>;
		}
		.bg-white {
			background: <?php echo get_theme_mod( 'snv_bg_white_color' ); ?>;
		}
		.white {
			color: <?php echo get_theme_mod( 'snv_white_color' ); ?>;
		}
		.bg-muted {
			background: <?php echo get_theme_mod( 'snv_bg_muted_color' ); ?>;
		}
		.muted {
			color: <?php echo get_theme_mod( 'snv_muted_color' ); ?>;
		}
	</style>
<?php }

/*
add_action('wp_head', 'sanev_customize_css');
*/
