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
          position: absolute;
          left: 0px;
          top: 0px;
          width: 100%;
          height: 100%;
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

var audio = null;
soundManager.setup({
  url: '<?php bloginfo('template_url'); ?>/swf/',
  flashVersion: 9,
  preferFlash: false,
  onready: function() {
    audio = soundManager.createSound({
      id: 'vipradio',
      url: "http://<?php echo get_theme_mod( 'lounge_player_url' ); ?>:<?php echo get_theme_mod( 'lounge_player_port' ); ?>/;",
      autoLoad: true,
      autoPlay: false,
      volume: 90,
      multiShot: false
    });
  }
});

$(document).ready(function() {
  $( "#lounge-player-play" ).click(function(e) {
    e.preventDefault();
    if (audio.playState == 0) {
      soundManager.play('vipradio');
    } else {
      soundManager.stop('vipradio');
      soundManager.unload('vipradio');
      soundManager.play('vipradio');
    }
  });
  $( "#lounge-player-stop" ).click(function(e) {
    e.preventDefault();
    soundManager.stop('vipradio');
    soundManager.unload('vipradio');
  });
});
</script>
<?php }
add_action('wp_print_footer_scripts' , 'lounge_player_setup');


