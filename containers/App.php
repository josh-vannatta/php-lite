<?php

class App
{

  protected static $registry = [];

  public static function bind($key, $value)
  {
    static::$registry[$key] = $value;
  }

  public static function get($key)
  {
    if (!array_key_exists($key, static::$registry)) {
      throw new Exception("No {$key} is bound in the container.");
    }
    return static::$registry[$key];
  }

  public static function database($table = '')
  {
    return static::$registry['database']->select($table);
  }

  public static function view($location, $data = [])
  {
    extract($data);
    require static::directory('views') . $location . '.view.php';
  }

  public static function render($location, $data = [])
  {
    extract($data);

    ob_start();
    include(static::directory('views') . $location . '.view.php');
    $template = ob_get_contents();
    ob_end_clean();

    return $template;
  }

  public static function directory($key='')
  {
    if (isset(static::$registry['config']['app']['directory'])){
      $directory = static::$registry['config']['app']['directory'];
      if ($key == '') return $directory;
      return $directory[$key];
    }
    return false;
  }

  public static function authenticate($unique_key)
  {
    $authenticated = static::$registry['config']['app'];
    $validated = static::database($authenticated['model'])
      ->where($auth['unique_key'], '=', $unique_key)[0];

    static::$registry['authenticated'] = $authenticated;
  }



  public static function auth($key='')
  {
    if (isset(static::$registry['authenticated'])){
      $auth = static::$registry['authenticated'];
      if ($key == '') return $auth;
      return $auth->$key;
    }
    return false;
  }

  public static function session($key='') {
    if (isset(static::$registry['config']['auth']['session'])) {
      $session = static::$registry['config']['auth']['session'];
      if ($key == '') return $session;
      if (isset($session[$key])) return $session[$key];
    }
    return false;
  }

  public static function login($unique_key)
  {
    session_regenerate_id(true);
    $_SESSION[static::session('key')] = $unique_key;
    $_SESSION['authenticated'] = true;
    if (isset($_POST['remember'])) {
      $auto_login = new AutoLogin(
        Connection::make(App::get('config')['database'])
      );
      $auto_login->persistentLogin();
    }
  }
}
