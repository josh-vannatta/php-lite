const coreElements = (function() {
  'use strict';

  return {
    bind: bind
  }

  function bind() {
    $('#app').css('padding-bottom',
      $('.sticky-footer').innerHeight() + 'px'
    )

    $(window).resize(function() {
      $('#app').css('padding-bottom',
        $('.sticky-footer').innerHeight() + 'px'
      )
    });
  }

}());

export { coreElements };
