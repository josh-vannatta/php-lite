<?php

class ValidatorRules {
  protected $messages = [];

  protected function title($input, $params)
  {
    var_dump($params['max']);
    return true;
  }

  protected function required($input, $bool)
  {
    $this->messages['required'] = ' is required';
    return (strlen($input) > 0);
  }

  protected function max($input, $amount)
  {
    $this->messages['max'] = " must be a maximum of $amount characters";
    return (strlen($input) <= $amount);
  }

  protected function min($input, $amount)
  {
    $this->messages['min'] = " must be a minimum of $amount characters";
    return (strlen($input) >= $amount);
  }

  protected function date($input, $type)
  {
    $ymd= '/^(?:\2)(?:[0-9]{2})?[0-9]{2}([\/-])(1[0-2]|0?[1-9])([\/-])(3[01]|[12][0-9]|0?[1-9])$/';
    $dmy= '/^(3[01]|[12][0-9]|0?[1-9])([\/-])(1[0-2]|0?[1-9])([\/-])(?:[0-9]{2})?[0-9]{2}$/';
    $mdy= '/^(1[0-2]|0?[1-9])([\/-])(3[01]|[12][0-9]|0?[1-9])([\/-])(?:[0-9]{2})?[0-9]{2}$/';

    $this->messages['date'] = " is not a valid date";
    if ($type == 'ymd')
      return (preg_match($ymd, $input) == 1);
    if ($type == 'dmy')
      return (preg_match($dmy, $input) == 1);
    if ($type == 'mdy')
      return (preg_match($mdy, $input) == 1);
    throw new Exception("Rule 'date' only accepts 'dmy', 'mdy', or 'ymd' as parameter");
    return false;
  }

  protected function email($input, $type)
  {
    $this->messages['email'] = " must be a valid email address";
    return (filter_var($input, FILTER_VALIDATE_EMAIL));
  }

  protected function url($input, $type)
  {
    $this->messages['url'] = " must be a valid web address";
    return (filter_var($input, FILTER_VALIDATE_URL));
  }

  protected function ip($input, $type)
  {
    $this->messages['ip'] = " must be a valid IP address";
    return (filter_var($input, FILTER_VALIDATE_IP));
  }

  protected function alphaNumeric($input, $type) {
    $this->messages['alphaNumeric'] = " may only contain [A-Za-z] and [0-9]";
    return (preg_match('/^[A-Za-z0-9]+$/i', $input));
  }

  protected function numeric($input, $type) {
      $this->messages['numeric'] = " may only contain [0-9]";
      return (preg_match('/^-?[0-9]+$/', $input));
  }

  protected function alpha($input, $type) {
      $this->messages['alpha'] = " may only contain [A-Za-z]";
      return (preg_match('/^[A-Za-z]+$/', $input));
  }

  protected function decimal($input, $type) {
      $this->messages['decimal'] = " must be a valid decimal";
      return (preg_match('/^\s*(\+|-)?((\d+(\.\d+)?)|(\.\d+))\s*$/', $input));
  }

  protected function currency($input, $type) {
      $this->messages['currency'] = " must be a valid currency value";
      return (preg_match('/^\s*(\+|-)?((\d+(\.\d\d)?)|(\.\d\d))\s*$/', $input));
  }

  protected function equal($input, $type) {
      $this->messages['equal'] = " must be equal to $type";
      return ($input == $type);
  }

  protected function time($input, $type) {
    $this->messages['time'] = " is not a valid time";
    return (preg_match('/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9]):([0-5]?[0-9])$/', $input));
  }

  protected function truthy($input, $type) {
    $this->messages['truthy'] = " is not valid";
    return (preg_match('/^(?:1|t(?:rue)?|y(?:es)?|ok(?:ay)?)$/i', $input));
  }

  protected function falsy($input, $type) {
    $this->messages['falsy'] = " is not valid";
    return (!(preg_match('/^(?:1|t(?:rue)?|y(?:es)?|ok(?:ay)?)$/i', $input)));
  }

  protected function strong($password, $type)
  {
    $this->messages['strong'] = " must contain at least one uppercase letter, lower case letter, number and special character.";
    if (!preg_match("#[0-9]+#", $password)) return false;
    if (!preg_match("#[a-zA-Z]+#", $password)) return false;
    if (!preg_match("#[\~\`\!\@\#\$\%\^\&\*\(\)\_\-\+\=\{\}\[\]\|\:\;\<\>\.\?\/]+#", $password)) return false;

    return true;
  }

  protected function weak($password, $type)
  {
    $this->messages['strong'] = " must contain at least one uppercase letter, lower case letter and number.";
    if (!preg_match("#[0-9]+#", $password)) return false;
    if (!preg_match("#[a-zA-Z]+#", $password)) return false;

    return true;
  }

}
