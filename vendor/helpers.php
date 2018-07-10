<?php

function formatDate($string, $format)
{
  $time = strtotime($string);
  return date($format, $time);
}

function session($collection, $key = [])
{
  if (count($key) == 0)
    return isset($_SESSION[$collection]);

  if (isset($_SESSION[$collection]))
    return $_SESSION[$collection][$key];

  return '';
}

function dd($value)
{
  var_dump($value);
  die();
}

function upload_file($file, $target_file) {
  if (file_exists($target_file)) unlink($target_file);
  if ($file["size"] > 500000) return false;
  if (move_uploaded_file($file["tmp_name"], $target_file))
      return true;
  return false;
}

function upload_img($file, $target_file) {
  if (!getimagesize($file["tmp_name"])) return false;
  $imageFileType = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
  if ($imageFileType != "jpg" && $imageFileType != "png" &&
      $imageFileType != "jpeg" && $imageFileType != "gif" ) return false;
  return upload_file($file, $target_file);
}

function clear_resets() {
  $resets = App::database('password_resets')->all();
  foreach ($resets as $reset) {
    if ((int)$reset->expiry < time())
      App::database('password_resets')->destroy_where('email', '=', $reset->email);
  }
}
