<?php

class HomeController
{

  public function index()
  {
    App::view('index');
  }

   public function migrate()
   {
     App::view('home/migrate');
   }

   public function migrateConfirm()
   {
     App::view('home/migrate-confirm');
   }

   public function error()
   {
     App::view('home/error-404');
   }

}
