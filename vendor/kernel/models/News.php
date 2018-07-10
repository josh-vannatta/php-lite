<?php

class News extends Model
{
  public $id;
  public $fillable = [
    'title' => '',
    'published' => '',
    'brief' => '',
    'picture' => '',
    'body' => '',
    'link' => ''
  ];
}
