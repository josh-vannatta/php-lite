const passiveElements = (function() {
  'use strict';

  return {
    bind: bind,
    reducers: []
  }

  function bind() {
    // General
    $('.passive').parent().mouseenter(function(){ $(this).addClass('hover') });
    $('.passive').parent().mouseleave(function(){ $(this).removeClass('hover') });
    $('.passive').parent().click(function(){
      if (!$(this).hasClass('active')) $(this).addClass('active');
      else $(this).removeClass('active');
     });
    $('#app').click(()=>$('.passive').removeClass('active'));
    // Carat
    $('.passive.carat-down').replaceWith(function(){
      return carat($(this)[0].className)
    });
    // Closers
    $('.passive.close-me').click(function() {
      $(this).parent().addClass('animated fadeOut');
      setTimeout(()=>$(this).parent().addClass('hidden'), 300);
    })
    // Dropdowns
    let dropdownHosts = $('.passive.dropdown').parent();
    if (!dropdownHosts.hasClass('active')) dropdownHosts.addClass('collapsed');
    else dropdownHosts.find('.dropdown').css('height', function() {
      return `${$(this)[0].scrollHeight}px`;
    });
    dropdownHosts.click(function() {
      if ($(this).hasClass('collapsed')) {
        $('.sidenav-item > a.passive').parent().removeClass('active');
        $('.passive.dropdown').css('height', '0');
        $(this).find('.dropdown').css('height', function() {
          return `${$(this)[0].scrollHeight}px`;
        });
        $('.passive.dropdown').parent().addClass('collapsed');
        $(this).removeClass('collapsed');
        return;
      }
      $('.passive.dropdown').css('height', '0');
      $('.passive.dropdown').parent().addClass('collapsed');
    });
    $('.sidenav-item > .passive').click(()=>{
      $('.sidenav-item > .passive').parent().removeClass('active');
      $('.passive.dropdown').css('height', '0');
      $('.passive.dropdown').parent().addClass('collapsed');
      $(this).parent().addClass('active')
    })
    // Reducer
    let reduceHosts = $(`[reduce-role='parent']`);
    reduceHosts.css('position', 'relative');
    if (reduceHosts.hasClass('reduced'))
      reduceHosts.css('overflow', 'hidden');
    else reduceHosts.css('overflow', 'visible');
    reduceHosts.css('height',
      reduceHosts.find(`[reduce-role='head']`).outerHeight() +
      reduceHosts.find(`[reduce-role='body']`).outerHeight() + 'px'
    )
    reduceHosts.css('min-height', 'max-content');
    $(`[reducer]`).click(function(){
      if (!$(this).attr('reduce-control')) {
        let parent = $(this).closest(`[reduce-role='parent']`);
        $(this).attr('reduce-control', passiveElements.reducers.length);
        passiveElements.reducers.push({
          control: $(this), parent: parent,
          head: parent.find(`[reduce-role='head']`),
          body: parent.find(`[reduce-role='body']`)
        })
      }
      let _this = passiveElements.reducers[$(this).attr('reduce-control')];
      _this.parent.css('transition', Math.floor(_this.body.outerHeight() / 80) / 10 + 's');
      if (_this.parent.hasClass('reduced')) {
        _this.parent.removeClass('reduced');
        _this.parent.css('height', _this.head.outerHeight() + _this.body.outerHeight() + 'px');
        setTimeout(()=>{
          _this.parent.css('overflow', 'visible');
          _this.parent.css('min-height', 'max-content');
        }, 500);
        return;
      }
      _this.parent.addClass('reduced');
      _this.parent.css('height', _this.head.outerHeight() - 2 + 'px');
      _this.parent.css('min-height', 'unset');
      _this.parent.css('overflow', 'hidden');
    })
  }

  function carat(className) {
    let c = JSX.html('figure', {className: className}, insert('div', 2));
    return JSX.createElement(c)
  }

  function insert(el, amt = 1) {
    let inserts = [];
    for (amt; amt > 0; amt--) inserts.push(
      JSX.html(el, {className: 'insert'})
    );
    return inserts;
  }

}());

export { passiveElements };
