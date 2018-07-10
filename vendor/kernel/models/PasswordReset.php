<?php

class PasswordReset extends Model
{
  public $fillable = [
    'token' => '',
    'email' => '',
    'expiry' => ''
  ];
}
