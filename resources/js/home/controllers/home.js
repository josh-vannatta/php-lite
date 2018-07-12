const homeController = (function() {
  'use strict';

  let _this = {
    load: onLoad
  }

  function onLoad() {
    console.log('foo');
  }

  return _this;

}());


window['homeController'] = homeController;
export { homeController };
