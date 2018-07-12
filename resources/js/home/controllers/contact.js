const contactController = (function() {
  'use strict';

  let _this = {
    load: onLoad
  }

  function onLoad() {
    console.log('bar');
  }

  return _this;

}());


window['contactController'] = contactController;
export { contactController };
