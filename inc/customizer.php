<?php
/**
 * VIP Lounge Theme Customizer.
 *
 * @package VIP Lounge
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function lounge_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'lounge_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function lounge_customize_preview_js() {
	wp_enqueue_script( 'lounge_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'lounge_customize_preview_js' );

function lounge_customizer( $wp_customize ) {
  $wp_customize->add_panel( 'lounge_player_panel', array(
      'priority'       => 1,
      'title'          => 'Player',
      'description'    => 'All settings related to the shoutcast radio player. This not only contains the source configuration, but also some styling tweaks as well.',
  ) );
  $wp_customize->add_section( 'lounge_logo_section' , array(
      'title'       => __( 'Logo', 'lounge' ),
      'priority'    => 30,
      'description' => 'Upload a logo to replace the default site name and description in the header',
  ) );
  $wp_customize->add_section( 'lounge_player_base_section' , array(
      'title'       => __( 'General', 'lounge' ),
      'priority'    => 30,
      'description' => 'General settings.',
      'panel' => 'lounge_player_panel',
  ) );
  $wp_customize->add_section( 'lounge_player_colours_section' , array(
      'title'       => __( 'Colours', 'lounge' ),
      'priority'    => 31,
      'description' => 'All colour related settings..',
      'panel' => 'lounge_player_panel',
  ) );
  $wp_customize->add_setting( 'lounge_logo' );
  $wp_customize->add_setting( 'lounge_border_color', array(
      'default' =>  '#000000',
      'transport' => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_header_color', array(
      'default' =>  '#000000',
      'transport' => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_menu_color', array(
      'default' =>  '#000000',
      'transport' => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_menu_hover_color', array(
      'default' =>  '#FFFFFF',
      'transport' => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_menu_hover_bg', array(
      'default' =>  '#000000',
      'transport' => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_display_desc' );
  $wp_customize->add_setting( 'lounge_player_url' );
  $wp_customize->add_setting( 'lounge_player_port' );
  $wp_customize->add_setting( 'lounge_player_primary', array(
      'default' =>  '#000000',
      'transport' => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_player_background', array(
      'default' =>  '#FFFFFF',
      'transport' => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_display_title' , array(
      'default'     => 'false',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_player_enabled' , array(
      'default'     => 'false',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_player_mode' , array(
      'default'     => 'icecast',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_player_primary' , array(
      'default'     => '#000000',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_display_desc' , array(
      'default'     => '',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_stream_title' , array(
      'default'     => '',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_stream_desc' , array(
      'default'     => '',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_setting( 'lounge_player_gradient_enabled' , array(
      'default'     => 'true',
      'transport'   => 'refresh',
  ) );
  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lounge_logo', array(
      'label'    => __( 'Logo', 'lounge' ),
      'settings' => 'lounge_logo',
      'section' => 'lounge_logo_section'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_display_title', array (
      'label'   =>    __( 'Display Title', 'lounge' ),
      'settings' => 'lounge_display_title',
      'section' => 'lounge_logo_section',
      'type' => 'select',
      'choices' => array (
        'true' => __('True', 'lounge'),
        'false' => __('False', 'lounge')
      ),
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_display_desc', array (
      'label'   =>    __( 'Display Description', 'lounge' ),
      'settings' => 'lounge_display_desc',
      'section' => 'lounge_logo_section',
      'type' => 'select',
      'choices' => array (
        'true' => __('True', 'lounge'),
        'false' => __('False', 'lounge')
      ),
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_player_enabled', array (
      'label'   =>    __( 'Player Enabled', 'lounge' ),
      'settings' => 'lounge_player_enabled',
      'section' => 'lounge_player_base_section',
      'type' => 'select',
      'choices' => array (
        'true' => __('True', 'lounge'),
        'false' => __('False', 'lounge')
      ),
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_player_mode', array (
      'label'   =>    __( 'Player Mode', 'lounge' ),
      'settings' => 'lounge_player_mode',
      'section' => 'lounge_player_base_section',
      'type' => 'select',
      'choices' => array (
        'icecast' => __('Icecast', 'lounge'),
        'shoutcast' => __('Shoutcast', 'lounge')
      ),
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_p_title', array (
      'label'   =>    __( 'Title', 'lounge' ),
      'settings' => 'lounge_stream_title',
      'section' => 'lounge_player_base_section',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_p_desc', array (
      'label'   =>    __( 'Description', 'lounge' ),
      'settings' => 'lounge_stream_desc',
      'section' => 'lounge_player_base_section',
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_p_gradient_enabled', array (
      'label'   =>    __( 'Player Gradient', 'lounge' ),
      'settings' => 'lounge_player_gradient_enabled',
      'section' => 'lounge_player_colours_section',
      'type' => 'select',
      'choices' => array (
        'true' => __('True', 'lounge'),
        'false' => __('False', 'lounge')
      ),
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_p_url', array(
      'label'    => __( 'Source URL/IP', 'lounge' ),
      'settings' => 'lounge_player_url',
      'section' => 'lounge_player_base_section'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lounge_p_primary', array(
      'label'    => __( 'Primary Colour', 'lounge' ),
      'settings' => 'lounge_player_primary',
      'section' => 'lounge_player_colours_section'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lounge_p', array(
      'label'    => __( 'Header Colour', 'lounge' ),
      'settings' => 'lounge_header_color',
      'section' => 'colors'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lounge_b', array(
      'label'    => __( 'Border Colour', 'lounge' ),
      'settings' => 'lounge_border_color',
      'section' => 'colors'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lounge_m_primary', array(
      'label'    => __( 'Menu Primary Colour', 'lounge' ),
      'settings' => 'lounge_menu_color',
      'section' => 'colors'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lounge_m_color', array(
      'label'    => __( 'Menu Hover Colour', 'lounge' ),
      'settings' => 'lounge_menu_hover_color',
      'section' => 'colors'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lounge_m_bg', array(
      'label'    => __( 'Menu Hover Background', 'lounge' ),
      'settings' => 'lounge_menu_hover_bg',
      'section' => 'colors'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'lounge_p_background', array(
      'label'    => __( 'Background Colour', 'lounge' ),
      'settings' => 'lounge_player_background',
      'section' => 'lounge_player_colours_section'
  ) ) );
  $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'lounge_p_port', array(
      'label'    => __( 'Port Number', 'lounge' ),
      'settings' => 'lounge_player_port',
      'section' => 'lounge_player_base_section'
  ) ) );
}
add_action( 'customize_register', 'lounge_customizer' );
