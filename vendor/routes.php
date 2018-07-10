<?php
// Login Routes
  $router->get('admin', 'LoginController@index');
  $router->post('admin/login', 'LoginController@login');
  $router->get('admin/logout', 'LoginController@logout');
  $router->get('admin/login/confirm', 'LoginController@confirm');

// Password Reset Routes
  $router->get('admin/forgot-password', 'ResetsController@index');
  $router->post('admin/password/attempt', 'ResetsController@attempt');
  $router->get('admin/reset-password', 'ResetsController@edit');
  $router->post('admin/password/update', 'ResetsController@update');

// Admin Routes
  $router->get('admin/dashboard', 'AdminController@dashboard');
  $router->get('admin/messages/clear', 'AdminController@clearMessages');
  $router->get('admin/system/accounts', 'AdminController@index');
  $router->get('admin/system/create', 'AdminController@create');
  $router->post('admin/system/store', 'AdminController@store');
  $router->post('admin/system/delete', 'AdminController@destroy');
  $router->get('admin/system/profile={email}', 'AdminController@edit');
  $router->post('admin/system/update', 'AdminController@update');
  $router->post('admin/system/update_password', 'AdminController@update_password');

// News Routes
  $router->get('admin/news/all/page={page}', 'NewsController@index');
  $router->get('admin/news/create', 'NewsController@create');
  $router->post('admin/news/store', 'NewsController@store');
  $router->get('admin/news/edit/item={id}', 'NewsController@edit');
  $router->post('admin/news/update', 'NewsController@update');
  $router->post('admin/news/delete', 'NewsController@destroy');

// Public Routes
  $router->get('news/page={page}', 'PublicController@main');
  $router->get('news', 'PublicController@basic');
  $router->get('news/release/{title}', 'PublicController@release');
  $router->get('contact', 'PublicController@contact');
  $router->post('{from}/email', 'PublicController@contactEmail');
  $router->get('investors', 'PublicController@investors');

// Error 404
