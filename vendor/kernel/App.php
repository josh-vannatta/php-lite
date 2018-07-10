<?php

class App
{

  protected static $registry = [];
  public static $admin;

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

  public static function database($table)
  {
    return static::$registry['database']->select($table);
  }

  public static function view($location, $data = [])
  {
    extract($data);
    $app = static::$registry['config']['app'];
    require $app['kernel'] . "/views/" . $location . '.view.php';
  }

  public static function render($location, $data = [])
  {
    extract($data);
    $app = static::$registry['config']['app'];

    ob_start();
    include($app['kernel'] . "/views/" . $location . '.view.php');
    $template = ob_get_contents();
    ob_end_clean();

    return $template;
  }


  public static function uri($request)
  {
    return strpos($_SERVER['REQUEST_URI'], $request);
  }

  public static function authenticate($email)
  {
    $admin = static::database('admins')
      ->where('email', '=', $email)[0];

    $admin->permissions = unserialize($admin->permissions);
    static::$registry['admin'] = $admin;
  }


  public static function login($email)
  {
    session_regenerate_id(true);
    $_SESSION['admin_email'] = $email;
    $_SESSION['authenticated'] = true;
    if (isset($_POST['remember'])) {
      $auto_login = new AutoLogin(
        Connection::make(App::get('config')['database'])
      );
      $auto_login->persistentLogin();
    }
    Redirect::url('/admin/dashboard');
  }

  public static function admin($key='')
  {
    if (isset(static::$registry['admin'])){
      $admin = static::$registry['admin'];
      if ($key == '') return $admin;
      return $admin->$key;
    }
    return false;
  }

  public static function email_connect($sender, $name, $recipient, $subject, $body) {
      $mail = new PHPMailer\PHPMailer\PHPMailer(true);
      $email_config = static::$registry['config']['email'];

      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = $email_config['host'];
      $mail->SMTPAuth = true;
      $mail->Username = $email_config['username'];
      $mail->Password = $email_config['password'];
      $mail->SMTPSecure = $email_config['enc_type'] ;
      $mail->Port = $email_config['port'];
      $mail->setFrom($sender, $name);
      $mail->addAddress($recipient);
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $body;

      return $mail;
  }

}
