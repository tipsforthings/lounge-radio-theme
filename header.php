<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VIP Lounge
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<title><?php wp_title('') ?></title>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a href="#" id="invert-colors" class="fa fa-4x fa-eye"></a>

<div id="page" class="hfeed site" >
  <div id="content-wrapper" class="row">
    <div class="large-3 medium-4 small-12 sidebar-column columns">
      <?php get_sidebar(); ?>	
    </div>
    <div class="large-9 medium-8 small-12 columns" id="inner-content">
	    <div id="content" class="site-content">
