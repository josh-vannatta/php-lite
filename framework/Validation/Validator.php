<?php

class Validator extends ValidatorRules
{
  private $rules;
  private $compare;
  private $request;
  public $errors = [];

  public function __construct($request, $compare)
  {
    $this->request = $request;
    $this->compare = $compare;
    $this->parseRules();
  }

  private function parseRules()
  {
    foreach ($this->compare as $input => $rules) {
      $rules = explode('|', $rules);
      $this->compare[$input] = $this->mapRules($rules);
    }
  }

  private function mapRules($rules)
  {
    $mapped = [];
    foreach ($rules as $rule) {
      $seperate = explode(':', $rule);
      $sub = strpos($rule, '{');
      if ($sub > -1)
        $seperate[1] = $this->mapRules(
          explode(',', substr($rule, $sub+1, -1))
        );
      $mapped[$seperate[0]] = (count($seperate) > 1) ? $seperate[1] : true;
    }
    return $mapped;
  }

  public function fails()
  {
    foreach ($this->compare as $input => $rules) {
      $test = $this->testRule($input, $rules);
      if (!$test) return true;
    }
    return false;
  }

  public function testRule($input, $rules)
  {
    foreach ($rules as $rule => $value) {
      if (method_exists($this, $rule))
      {
        if ($this->$rule(
          $this->request[$input],
          $value) == true) continue;

        $this->errors[] = ucwords($input).$this->messages[$rule];
        return false;
      }
      throw new Exception("Rule $rule does not exist");
      die();
    }
    return true;
  }

}
