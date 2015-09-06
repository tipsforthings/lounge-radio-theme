<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lounge
 */

?>

<div id="secondary" class="widget-area" role="complementary">
  <div id="sidebar-brand " class="top-to-bottom">

    <img id="sidebar-logo" src='<?php echo esc_url( get_theme_mod( 'lounge_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
    <?php if( (get_theme_mod( 'lounge_display_title' ) == 'true') ) { ?>
  	  <h3 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
  	<?php } ?>
    <?php if( (get_theme_mod( 'lounge_display_desc' ) == 'true') ) { ?>
  	  <p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
  	<?php } ?>
  </div>
	<?php if ( (get_theme_mod('lounge_player_enabled')) == true ) { ?>
	  <?php require get_template_directory() . '/template-parts/player.php'; ?>
	<?php } ?>
	<?php dynamic_sidebar( 'left-top-sidebar' ); ?>
	<aside id="sidebar-navigation" class="">
	<nav id="site-navigation" class="main-navigation " role="navigation">   
		<?php wp_nav_menu( array( 'theme_location' => 'sidebar', 'menu_id' => 'primary-menu' ) ); ?>
	</nav><!-- #site-navigation -->
	<a href="#" id="menu-toggle" class="button radius menu-closed">Show Menu</a>
	</aside>
	<?php dynamic_sidebar( 'left-bottom-sidebar' ); ?>
</div><!-- #secondary -->
