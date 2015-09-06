<?php
/**
 * ALXS Asia Europe functions and definitions
 *
 * @package ALXS Asia Europe
 * @since ALXS Asia Europe 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since ALXS Lounge 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( 'lounge_setup' ) ):
function lounge_setup() {


	load_theme_textdomain( 'lounge', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside' ) );
  add_theme_support('menus', 'lounge');
  add_theme_support( 'post-thumbnails' );
	register_nav_menus( array(
		'sidebar' => __( 'Sidebar', 'lounge' ),
		'footer' => __( 'Footer', 'lounge' ),
	) );

}
endif; // asiamedia_setup
add_action( 'after_setup_theme', 'lounge_setup' );
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/template-tags.php';


function lounge_register_custom_background() {
	$args = array(
		'default-color' => 'e9e0d1',
	);

	$args = apply_filters( 'lounge_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'lounge_register_custom_background' );
show_admin_bar(false);
function lounge_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Left Sidebar (Top)', 'lounge' ),
		'id' => 'left-top-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
	register_sidebar( array(
		'name' => __( 'Left Sidebar (Bottom)', 'lounge' ),
		'id' => 'left-bottom-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	register_sidebar( array(
		'name' => __( 'Bottom Content', 'lounge' ),
		'id' => 'bottom-content',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'lounge_widgets_init' );



function lounge_scripts() {
	wp_enqueue_style( 'viplounge-style', get_stylesheet_uri() );

	wp_enqueue_script( 'lounge-libs', get_template_directory_uri() . '/js/libs/libs.min.js', array(), '20120206', true );
	wp_enqueue_script( 'lounge-foundation', get_template_directory_uri() . '/js/libs/foundation.min.js', array(), '20120206', true );
	wp_enqueue_script( 'lounge-app', get_template_directory_uri() . '/js/app.min.js', array(), '20120206', true );

  wp_register_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
	wp_enqueue_style('font-awesome');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lounge_scripts' );

require get_template_directory() . '/inc/player-setup.php';

