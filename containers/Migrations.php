<?php

class Migrate
{

  static public function passwordResets()
  {
    // Create password resets table
    try {
      App::database()->migrate('password_resets', [
        'token' => 'VARCHAR(128) NOT NULL',
        'email' => 'VARCHAR(128) NOT NULL',
        'expiry' => 'INT(11)'
      ]);
      echo "Password resets table created!<br />";
    } catch (\Exception $e) {
      dd($e);
    }
  }

  static public function users()
  {
    // Create users table
    try {
      App::database()->migrate('users', [
        'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
        'name' => 'VARCHAR(128)',
        'email' => 'VARCHAR(128) UNIQUE',
        'password' => 'VARCHAR(128)',
        'created_at' => 'TIMESTAMP NOT NULL',
        'updated_at' => 'TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()',
        'PRIMARY KEY' => '(id)'
      ]);
      echo "Users table created!<br />";
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
        'data' => 'TEXT NOT NULL'
      ]);
      echo "Session table created!<br />";
    } catch (\Exception $e) {
      dd($e);
    }
  }

  static public function autoLogins($value='')
  {
    // Create autologins table
    try {
      App::database()->migrate('autologin', [
        'user_key' => 'CHAR(8) NOT NULL',
        'token' => 'CHAR(32) NOT NULL',
        'data' => 'TEXT',
        'created_at' => 'TIMESTAMP NOT NULL',
        'used' => 'TINYINT(1) NOT NULL'
      ]);
      echo "Autologin table created!<br />";
    } catch (\Exception $e) {
      dd($e);
    }
  }

}
