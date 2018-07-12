<?php

class Model
{

  public function define($fields)
  {
    foreach ($fields as $field => $value) {
      $this->fillable[$field] = $value;
    }

    return;
  }

}
