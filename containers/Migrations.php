<?php

class Migrate
{

  static public function passwordResets()
  {
    try {
      App::database()->migrate('password_resets', [
        'token' => 'VARCHAR(128) NOT NULL',
        'email' => 'VARCHAR(128) NOT NULL',
        'expiry' => 'INT(11)'
      ]);
    } catch (\Exception $e) {
      dd($e);
    }
  }
    // Create password resets table

  static public function users()
  {
    // Create users table
    try {
      App::database()->migrate('users', [
        'id' => 'CHAR(8)',
        'name' => 'VARCHAR(128)',
        'email' => 'VARCHAR(128) UNIQUE',
        'password' => 'VARCHAR(128)',
        'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
        'updated_at' => 'TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()',
        'PRIMARY KEY' => '(id)'
      ]);
    } catch (\Exception $e) {
      dd($e);
    }
  }

  static public function sessions($value='')
  {
    // Create sessions table
    try {
      App::database()->migrate('sessions', [
        'sid' => 'VARCHAR(128) NOT NULL',
        'expiry' => 'INT(11) NOT NULL',
        'data' => 'TEXT NOT NULL',
        'PRIMARY KEY' => '(sid)'
      ]);
    } catch (\Exception $e) {
      dd($e);
    }
  }

  static public function autoLogins($value='')
  {
    // Create autologins table
    try {
      App::database()->migrate('autologin', [
        App::session('key') => 'CHAR(8) NOT NULL',
        'token' => 'CHAR(32) NOT NULL',
        'data' => 'TEXT',
        'created_at' => 'TIMESTAMP NOT NULL DEFAULT NOW()',
        'used' => 'TINYINT(1) NOT NULL DEFAULT 0'
      ]);
    } catch (\Exception $e) {
      dd($e);
    }
  }

}
