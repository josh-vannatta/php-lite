const homeController = (function() {
  'use strict';

  let _this = {
    index: index
  }

  function index() {
    console.log('Home controller working!');
  }

  return _this;

}());


window['homeController'] = homeController;
export { homeController };
