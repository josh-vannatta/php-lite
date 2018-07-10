<?php

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
    'username' => 'nt_admin',
    'password' => 'Synapse_Repair16',
    'host' => 'mysql:host=localhost;',
    'db_name' => 'dbname=nt_master',
    'options' => [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ],
  ],

  // Application settings
  'app' => [
    'kernel' => __DIR__.'/neuraptive',
  ]

];

// user: neurapti_admin
// db_name: neurapti_master
