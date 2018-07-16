const routes = (function() {
  'use strict';
  return [
    { path: '/', controller: 'homeController@index' },
    { path: '/home', controller: 'homeController@index' },
    { path: '/register', controller: 'loginController@create'},
    { path: '/login', controller: 'loginController@index'}
  ];

}());

export { routes };
