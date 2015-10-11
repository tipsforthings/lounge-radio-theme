<div id="lounge-player">
  <div id="lounge-player-controls">
    <?php if (get_theme_mod('lounge_player_gradient_enabled') != 'false' ) { ?>
      <div id="lounge-player-gradient"></div>
    <?php } ?>
    <div class="lounge-player-element">
      <div class="lounge-player-button-wrapper">
        <a href="#" class="lounge-player-button" id="lounge-player-play"><i class="fa fa-play"></i></a>
      </div>
    </div>
    <div class="lounge-player-element lounge-status-element">
      <div id="lounge-player-status" class="lounge-player-status">
        <marquee><?php lounge_player_info() ?></marquee>
      </div>
      <div id="lounge-player-volume" class="lounge-player-volume">
        <input type="text" id="lounge-volume-slider" data-slider="true" data-slider-range="0 , 100" value="90">
      </div>
    
    </div>
  </div>
  <div class="clearfix"></div>
</div>

