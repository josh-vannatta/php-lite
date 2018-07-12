const routes = (function() {
  'use strict';
  return [
    { path: '/', controller: 'homeController@load' },
    { path: '/home', controller: 'homeController@load' },
    { path: '/contact', controller: 'contactController@load' }
  ];

}());

export { routes };
