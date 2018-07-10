<?php

class Admin extends Model
{
  public $id;
  public $fillable = [
    'email' => '', 'password' => '', 'name' => '', 'role' => '', 'permissions' => ''
  ];
}
