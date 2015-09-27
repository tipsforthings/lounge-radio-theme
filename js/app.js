$(window).ready( function() {
  $windowHeight = $(window).height();
  $contentHeight = $('#content-wrapper').height();
 
  if ($('#menu-toggle').css('display') == 'none') {
    $('#content-wrapper, #secondary').css({'height': $windowHeight + 'px'});
    $('#content-wrapper').children('.columns').css({'height': $contentHeight + 'px'});
  }

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
  var windowHeight = $(window).height();
  if ($('#menu-toggle').css('display') == 'block') {
    $('#content-wrapper, #secondary').css({'min-height': ''});
    $('#content-wrapper').children('.columns').css({'min-height': ''});
  } else {
    $('#content-wrapper, #secondary').css({'min-height': windowHeight + 'px'});
    $('#content-wrapper').children('.columns').css({'min-height': $contentHeight + 'px'});
  }
});
$("#invert-colors").click(function(e) {
    e.preventDefault();
    $('body').toggleClass('inverted');
    
});
