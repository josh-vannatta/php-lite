<?php

class Message extends Model
{
  public $id;
  public $fillable = [
    'name' => '',
    'country' => '',
    'email' => '',
    'organization' => '',
    'phone' => '',
    'fax' => '',
    'address' => '',
    'state' => '',
    'city' => '', 
    'zip' => '',
    'message' => '',
  ];
}
