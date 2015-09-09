<?php

/*
  Plugin Name: Showreel
  Plugin URI: http://www.alxs.co.uk
  Version: 1.0.0
  Author: Alex Scott
  Description: Showreel is a restaurant management plugin.  Create dinner menus, take reservations and send and receive notifications with your customers.
  Text Domain: showreel
  License: GPLv3
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


if(!class_exists('Showreel'))
{
    class Showreel
    {

    }
}
if(class_exists('Showreel'))
{
    $showreel = new Showreel();
}

if (isset($showreel)) {
    function load_custom_admin_scripts() {
      wp_register_style( 'smoothness', 'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
      wp_register_script( 'main', plugins_url( '/js/main.js', __FILE__ ), array(), '', true );
      wp_register_script( 'jquery-ui', 'http://code.jquery.com/ui/1.10.3/jquery-ui.js', array(), '', true );
      wp_register_script( 'jquery-time', plugins_url( '/js/jquery-time.js', __FILE__ ), array(), '', true );
      wp_register_style( 'jquery-time', plugins_url( '/css/jquery-time.css', __FILE__ ));
      wp_enqueue_script( 'jquery' );
      wp_enqueue_script( 'jquery-ui' );
      wp_enqueue_script( 'jquery-time' );
      wp_enqueue_script( 'main' );
      wp_enqueue_style( 'smoothness' );
      wp_enqueue_style( 'jquery-time' );
    }
    add_action( 'admin_enqueue_scripts', 'load_custom_admin_scripts' );

    function shows_init() {
    $labels = array(
      'name'               => _x( 'Shows', 'post type general name' ),
      'singular_name'      => _x( 'Show', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'show' ),
      'add_new_item'       => __( 'Add New Show' ),
      'edit_item'          => __( 'Edit Show' ),
      'new_item'           => __( 'New Show' ),
      'all_items'          => __( 'All Shows' ),
      'view_item'          => __( 'View Show' ),
      'search_items'       => __( 'Search Shows' ),
      'not_found'          => __( 'No shows found' ),
      'not_found_in_trash' => __( 'No shows found in the Trash' ), 
      'parent_item_colon'  => '',
      'menu_name'          => 'Showreel'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our shows with descriptions',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'none' ),
      'has_archive'   => false,
      'menu_icon' => 'dashicons-list-view',
      'show_in_nav_menu' => true,
      'show_in_menu' => true,
      'taxonomies' => array('genres', 'day'),
    );
    register_post_type( 'shows', $args );
  }
  add_action( 'init', 'shows_init' );

  function my_genres() {
    $labels = array(
      'name'              => _x( 'Genres', 'taxonomy general name' ),
      'singular_name'     => _x( 'Genre', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Genres' ),
      'all_items'         => __( 'All Genres' ),
      'parent_item'       => __( 'Parent Genre' ),
      'parent_item_colon' => __( 'Parent Genre:' ),
      'edit_item'         => __( 'Edit Genre' ), 
      'update_item'       => __( 'Update Genre' ),
      'add_new_item'      => __( 'Add New Genre' ),
      'new_item_name'     => __( 'New Genre' ),
      'menu_name'         => __( 'Genres' ),
    );
    $args = array(
      'labels' => $labels,
      'hierarchical' => true,
    );
    register_taxonomy( 'genres', 'shows', $args );
  }
  add_action( 'init', 'my_genres', 0 );
  function days() {
    $labels = array(
      'name'              => _x( 'Days', 'taxonomy general name' ),
      'singular_name'     => _x( 'Day', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Days' ),
      'all_items'         => __( 'All Days' ),
      'edit_item'         => __( 'Edit Day' ), 
      'update_item'       => __( 'Update Day' ),
      'add_new_item'      => __( 'Add New Day' ),
      'new_item_name'     => __( 'New Day' ),
      'menu_name'         => __( 'Day' ),
    );
    $args = array(
      'labels' => $labels,
      'supports'      => array( 'none' ),
      'has_archive'   => false,
    );
    register_taxonomy( 'days', 'shows', $args );
  }
  add_action( 'init', 'days', 0 );

  function custom_edit_shows_columns( $showcolumn, $post_id ) {
    switch ( $showcolumn ) {
      case "title":
        $title = get_post_meta($post_id, 'post_title', true);
        echo $title;
      break;

      case "_showdescription":
        $showdescription = get_post_meta($post_id, '_showdescription', true);
        echo $showdescription;
      break;

      case "_showprice":
        $showprice = get_post_meta($post_id, '_showprice', true);
        echo $showprice;
      break;

    }
  }
  add_action( "manage_posts_custom_column", "custom_edit_shows_columns", 10, 2 );


  /** Shows Functions **/
  
  function showreel_add_show_meta() {

	  $screens = array( 'shows' );

	  foreach ( $screens as $screen ) {

		  add_meta_box(
			  'showreel_show',
			  __( 'Show Details', 'showreel' ),
			  'showreel_show_details',
			  $screen, 
			  'normal', 
			  'high'
		  );
	  }
  }

  add_action( 'add_meta_boxes', 'showreel_add_show_meta' );

  function showreel_show_details() {
	  global $post;
	
	  echo '<input type="hidden" name="showmeta_noncename" id="showmeta_noncename" value="' . 
	  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	  $title = get_post_meta($post->ID, 'title', true);
	  $showname = get_post_meta($post->ID, '_showname', true);
	  $showdescription = get_post_meta($post->ID, '_showdescription', true);
	
    echo '<p>Show Name:</p>';
    echo '<input type="text" name="post_title" value="' . $title  . '" class="widefat" />';
    echo '<p>Description:</p>';
    wp_editor( $showdescription, '_showdescription', $settings = array() );
    echo '<input type="submit" name="_time" value="" class="widefat submit" />';

  }

  function showreel_save_shows_meta($post_id, $post) {
	
	  if ( !wp_verify_nonce( $_POST['showmeta_noncename'], plugin_basename(__FILE__) )) {
	  return $post->ID;
	  }

	  // Is the user allowed to edit the post or page?
	  if ( !current_user_can( 'edit_post', $post->ID ))
		  return $post->ID;

	  $shows_meta['title'] = $_POST['post_title'];
	  $shows_meta['_showname'] = $_POST['_showname'];
	  $shows_meta['_showdescription'] = $_POST['_showdescription'];
	
	
	  foreach ($shows_meta as $key => $value) {
		  if( $post->post_type == 'revision' ) return;
		  $value = implode(',', (array)$value);
		  if(get_post_meta($post->ID, $key, FALSE)) {
			  update_post_meta($post->ID, $key, $value);
		  } else {
			  add_post_meta($post->ID, $key, $value);
		  }
		  if(!$value) delete_post_meta($post->ID, $key);
	  }

  }

  add_action('save_post', 'showreel_save_shows_meta', 1, 2); // save the custom fields

  function add_new_shows_columns($shows_columns) {
      $new_columns['cb'] = '<input type="checkbox" />';
      $new_columns['title'] = __('Show Name', 'post_title');
      $new_columns['_showdescription'] = __('Description', '_showdescription');
      return $new_columns;
  }

  add_filter('manage_edit-shows_columns' , 'add_new_shows_columns');

  /** Genres Widget **/
  



  class GenresTaxonomyWidget extends WP_Widget
  {
      public function __construct()
      {
          parent::__construct(
              'genres_taxonomy_widget',
              'Showreel Genres',
              array('description' => 'Allows you to create a new sidebar widget to display your different genre options!')
          );
      }

      public function widget($args, $instance)
      {
          $title = apply_filters('widget_title', $instance['title'] );
          $taxonomy = 'genres';
          $term_args=array(
            'hide_empty' => false
          );
          $tax_terms = get_terms($taxonomy,$term_args);
          echo $before_widget;
          ?><aside class="widget widget_showreel_genres">
          
          <div id="showreel_genres_wrap">
          <?php
          // Display the widget title 
          if ( $title ) ?>
          
              <h2 class="widget-title"><?php echo $before_title . $title . $after_title; ?></h2>
          
          <ul id="genres-list" class="showreel_widget_list">
          <?php
          foreach ($tax_terms as $tax_term) {
          echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
          }
          ?>
          </ul>
          </div>
          </aside>
              <?php
          echo $after_widget;
      }

      public function form($instance)
      {
        //Set up some default widget settings.
        $defaults = array( 'title' => __('Genres', 'example') );
        $instance = wp_parse_args( (array) $instance, $defaults ); 
        
        // Widget Title: Text Input 
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
 <?php
      }

      public function update($new_instance, $old_instance)
      {
        $instance = $old_instance;
     
        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );
     
        return $instance;
      }

  }

  add_action('widgets_init', 'init_genres_taxonomy_widget');
  function init_genres_taxonomy_widget()
  {
      register_widget('GenresTaxonomyWidget');
  }

  
  /** Day Requirements Widget **/


  class DaysTaxonomyWidget extends WP_Widget
  {
      public function __construct()
      {
          parent::__construct(
              'days_taxonomy_widget',
              'Showreel Days',
              array('description' => 'Allows you to create a new sidebar widget to display your different days!')
          );
      }

      public function widget($args, $instance)
      {
          $taxonomy = 'days';
          $term_args=array(
            'hide_empty' => false
          );
          $tax_terms = get_terms($taxonomy,$term_args);
          echo $before_widget;
          
          ?>
          <ul id="days-list" class="showreel_widget_list">
          <?php
          foreach ($tax_terms as $tax_term) {
          echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
          }
          ?>
          </ul>
              <?php
          echo $after_widget;
      }

      public function form($instance)
      {
          $field_data = array(
              'title' => array(
                  'id'    => $this->get_field_id('title'),
                  'name'  => $this->get_field_name('title'),
                  'value' => (isset($instance['title'])) ? $instance['title'] : __('Days')
              )
          );

      }

      public function update($new_instance, $old_instance)
      {
          $instance['title'] = strip_tags($new_instance['title']);

          return $instance;
      }

  }

  add_action('widgets_init', 'init_days_taxonomy_widget');
  function init_days_taxonomy_widget()
  {
      register_widget('DaysTaxonomyWidget');
  }

}
?>
