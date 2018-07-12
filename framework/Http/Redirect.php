<?php

class Redirect
{
  public static function back($data = [])
  {
    foreach ($data as $key => $value) {
      $_SESSION[$key] = $value;
    }
    $back = $_SERVER['HTTP_REFERER'];
    header("Location: {$back}");
    die();
  }

  public static function url($url, $data = [])
  {
    foreach ($data as $key => $value) {
      $_SESSION[$key] = $value;
    }

    header("Location: $url");
    die();
  }
}
