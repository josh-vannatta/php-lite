<?php

class Request
{

  public static function uri()
  {
    return trim(
      parse_url(
        $_SERVER['REQUEST_URI'], PHP_URL_PATH
      ), '/'
    );
  }

  public static function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  public static function input($name)
  {
    $method = $_GET;
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
      $method = $_POST;

    $values = [];

    foreach ($method as $key => $value){
      if (is_array($name)){
        foreach ($name as $input) {
          if ($key == $input) $values[$key] = trim($value);
        }
        continue;
      }
      if ($key == $name) return trim($value);
    }
    return $values;
  }

  public static function all()
  {
    $input_data = [];
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
      foreach ($_GET as $key => $value)
        $input_data[$key]=$value;

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
      foreach ($_POST as $key => $value)
        $input_data[$key]=$value;

    return $input_data;
  }

  public function contains($value)
  {
    return strpos($_SERVER['REQUEST_URI'], $value);
  }

}
