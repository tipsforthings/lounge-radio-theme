$(window).ready( function() {
  $windowHeight = $(window).height();
  $contentHeight = $('#content-wrapper').height();
  
  /** 
  Set the minimum height for the inner 
  content to always reach bottom of the 
  screen. 
  **/
  $('#inner-content').css({'min-height': $windowHeight});
  
  
  /**
  Set the height of the deezer widget
  to always equal the width.
  **/
  
  var deezerWidth = $('#deezerPlayer').width()
  
  $('#deezerPlayer').attr({'height': deezerWidth + 'px'});

  /**
    Retreive cookie for inverted colors and set body class if true
  **/
  if ($.cookie('inverted') == 'true') {
      $('body').addClass('inverted');
  }

  /**
    Menu toggle button
  **/
  $( "#menu-toggle" ).click(function(e) {
    e.preventDefault();
    if ($(this).hasClass('menu-open')) {
      $(this).text('Show Menu');
    } else {
      $(this).text('Hide Menu');
    };
    $(this).toggleClass("menu-open").toggleClass("menu-closed");
    $( "#primary-menu" ).slideToggle(350);
  });

});

$(window).resize( function() {
  var deezerWidth = $('#deezerPlayer').width()
  
  $('#deezerPlayer').attr({'height': deezerWidth + 'px'});
});

/**
  Functionality for invert colors button. Toggles the
  class of the BODY elements to inverted.
**/

$("#invert-colors").click(function(e) {
    e.preventDefault();
    $('body').toggleClass('inverted');
    if ($('body').hasClass('inverted')) {
      $.cookie('inverted', 'true', { expires: 7, path: '/' });    
    } else {
      $.cookie('inverted', 'false', { expires: 7, path: '/' });    
    }
});
