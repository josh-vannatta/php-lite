<?php
/* ROUTING
 * ----------------------
 * Set your routes here by defining the http method,
 * url, and controller action.
 * $router->method('url/{stub}', 'controller@action')
 *
 * Visit the setup routes to generate tables for
 * sessions and password resets, then **delete them**.
 */

// Login Routes
  $router->get('register', 'LoginController@index');
  $router->post('login', 'LoginController@login');
  $router->get('logout', 'LoginController@logout');
  $router->get('login/confirm', 'LoginController@confirm');

// Password Reset Routes
  $router->get('forgot-password', 'ResetsController@index');
  $router->post('password/attempt', 'ResetsController@attempt');
  $router->get('reset-password', 'ResetsController@edit');
  $router->post('password/update', 'ResetsController@update');

// User Routes
  $router->get('signup', 'UsersController@create');
  $router->post('account/store', 'UsersController@store');
  $router->get('account/{email}', 'UsersController@index');
  $router->get('account/{email}/edit', 'UsersController@edit');
  $router->post('account/update', 'UsersController@update');
  $router->post('account/update_password', 'UsersController@update_password');
  $router->post('account/delete', 'UsersController@destroy');

// Home Routes
  $router->get('', 'HomeController@index');
  $router->get('migrate', 'HomeController@migrate');
  $router->get('migrate-confirm', 'HomeController@migrateConfirm');
  $router->post('{from}/email', 'PublicController@contactEmail');
  $router->get('error/page/does/not/exist', 'HomeController@error');
