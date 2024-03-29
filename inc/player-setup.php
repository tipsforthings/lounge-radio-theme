<?php 
function soundmanager_init() {
	if ( ((get_theme_mod('lounge_player_enabled')) == true) && (!is_customize_preview()) ) {

  	wp_enqueue_script( 'soundmanager', get_template_directory_uri() . '/js/soundmanager2-jsmin.js', array(), '20120206', true );
	}
}
add_action ('wp_enqueue_scripts' , 'soundmanager_init');

function lounge_player_styles()
{
    ?>
        <style type="text/css">
          #lounge-player .lounge-player-button { color:<?php echo get_theme_mod('lounge_player_primary', '#000000'); ?>; }
          <?php if ( get_theme_mod('lounge_player_gradient_enabled') == true ) { ?>
          #lounge-player-gradient {
          background-image: -moz-linear-gradient(to bottom, rgba(255,255,255,0.125) 5%, rgba(255,255,255,0.125) 45%, rgba(255,255,255,0.15) 52%, rgba(0,0,0,0.01) 51%, rgba(0,0,0,0.1) 95%);
          background-image: linear-gradient(to bottom, rgba(255,255,255,0.125) 5%, rgba(255,255,255,0.125) 45%, rgba(255,255,255,0.15) 50%, rgba(0,0,0,0.1) 51%, rgba(0,0,0,0.1) 95%);
          }
          <?php } ?>
        </style>
    <?php
}
add_action( 'wp_head', 'lounge_player_styles');

function lounge_player_setup() { 


?>
<script>


$(document).ready(function() {
  $('.lounge-player-status, .lounge-player-volume').fadeIn(100);
  $audio = null;
  $level = null;
  $status = false;

  if ($.cookie('player-volume') != null) {
    $level = $.cookie('player-volume');
  } else {
    $level = 90;
  }

  if ($.cookie('play-status') == 'true') {
    if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
      $status = false;
    } else {
      $status = true;
      $('#lounge-player-play i').removeClass('fa-play').addClass('fa-stop');
    }
  } else {
    $status = false;
  }

  $("#lounge-volume-slider").bind("slider:changed", function (event, data) {
    var $level = (data.value);
    soundManager.setVolume($level);
    $.cookie('player-volume', $level, { expires: 7, path: '/' });
  });

  soundManager.setup({
    url: '<?php bloginfo('template_url'); ?>/swf/',
    flashVersion: 9,
    preferFlash: false,
    onready: function() {
      audio = soundManager.createSound({
        id: 'vipradio',
        url: "http://<?php echo get_theme_mod( 'lounge_player_url' ); ?>:<?php echo get_theme_mod( 'lounge_player_port' ); ?>/;",
        autoLoad: true,
        autoPlay: $status,
        volume: $level,
        multiShot: false
      });
    }
  });
  $( "#lounge-player-play" ).click(function(e) {
    e.preventDefault();
    if (audio.playState == 0) {
      soundManager.play('vipradio');
      $.cookie('play-status', 'true', { expires: 7, path: '/' });
      $('#lounge-player-play i').addClass('fa-stop').removeClass('fa-play');
    } else {
      soundManager.stop('vipradio');
      soundManager.unload('vipradio');
      $.cookie('play-status', 'false', { expires: 7, path: '/' });
      $('#lounge-player-play i').removeClass('fa-stop').addClass('fa-play');
    }
    
  });
});


</script>
<?php }
add_action('wp_print_footer_scripts' , 'lounge_player_setup');


if ( ! function_exists( 'lounge_player_info' ) ) :

function lounge_player_info() {
  $url = "http://alxs.co.uk:8000/stats?sid=1&mode=viewxml";
  $nice_url = urlencode($url);
  $sc_stats = simplexml_load_file($nice_url);
  $servertitle = $sc_stats->SERVERTITLE;
  $songtitle = $sc_stats->SONGTITLE;
  
	if ( (get_theme_mod('lounge_stream_title')) != '' ) {
    $servertitle =  (get_theme_mod('lounge_stream_title'));
  }
	if ( (get_theme_mod('lounge_stream_desc')) != '' ) {
    $songtitle =  (get_theme_mod('lounge_stream_desc'));
  }

  echo '<strong>' . $servertitle . '</strong> | ' . $songtitle . ' <span class="label">Live</span>';
}
endif;

if ( ! function_exists( 'lounge_player_volume' ) ) :

function lounge_player_volume() {
  
}
endif;
