<?php

session_start();
$_SESSION['active'] = time();

if (isset($_SESSION['authenticated']) || isset($_SESSION['nt_auth'])) {
    App::authenticate($_SESSION['admin_email']);
    $auto_login = new AutoLogin($db_connection);
    $auto_login->checkCredentials();
}

clear_resets();

Router::load($routes)
  ->direct(
    Request::uri(),
    Request::method()
  );

unset(
  $_SESSION['input_data'],
  $_SESSION['messages'],
  $_SESSION['errors']
);
