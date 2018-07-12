<?php
  $vendor_loc = $base_url . 'app/kernel/';
  $routes = $vendor_loc.'routes.php';
  $core = $vendor_loc.'core.php';
  require $vendor_loc.'helpers.php';
  require $base_url . 'vendor/autoload.php';

  App::bind('config', require $vendor_loc.'config.php');

  $db_connection = Connection::make(
    App::get('config')['database']
  );

  App::bind('database',
    new QueryBuilder($db_connection)
  );

  $handler = new PersistentSessionHandler(
    $db_connection
  );
  session_set_save_handler($handler);
