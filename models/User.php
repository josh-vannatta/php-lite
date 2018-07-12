<?php

class User extends Model
{
  public $id;
  public $fillable = [
    'email' => '', 'password' => '', 'name' => ''
  ];
}
