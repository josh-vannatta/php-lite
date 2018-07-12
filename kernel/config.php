<?php

/* APPLICATION CONFIGURATION
 * ----------------------
 * Settings for all application features
 * can be easily saved and accessed here.
 * Access via App::get('config')[key]
 * or directly detailed below(->);
 */

return [

  // Email settings
  'email' => [
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'username' => 'de101c15524133',
    'password' => '0cbc3d88e19047',
    'enc_type' => 'tls'
  ],

  // Database settings
  'database' => [
    'username' => 'cpssnr',
    'password' => 'CPSS8R013!',
    'host' => 'localhost',
    'db_name' => 'DG_C2M2',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ],
  ],

  // Authentication settings
  'auth' => [
    'model' => 'users',
    'unique_key' => 'email',
    'session' => [
      'name' => 'dg_m2c2',
      'user' => 'cpssnr',
      'key' => 'assessment',
    ],
  ],

  // Application settings
  'app' => [
    'base_url' => 'http://assessment.nrel',
    'name' => 'Assessment Tool',
    // -> App::directory(key)
    'directory' => [
      'routes' => '../kernel/routes.php',
      'helpers' => '../kernel/helpers.php',
      'views' => '../resources/views/',
    ]
  ]

];
