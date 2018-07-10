<?php

class PublicController
{

  public function basic()
  {
    Redirect::url('/news/page=1');
  }

   public function main($curPage)
   {
     $count = 10;
     $start = $count * ($curPage -1);
     $news_items = App::database('news_items')->orderBy("published")->getPage($start, $count);
     $numPages = ceil(App::database('news_items')->count() / $count);
     App::view('public/news_main', compact('news_items', 'curPage', 'numPages'));
   }

   public function release($title)
   {
     $release = App::database('news_items')->where('title', '=', addslashes(urldecode($title)))[0];
     App::view('public/news_release', compact('release'));
   }

   public function contact()
   {
     App::view('public/contact');
   }

   public function investors()
   {
     App::view('public/investors');
   }

   public function contactEmail($from)
   {
     $request = Request::all();
     unset($_SESSION['success']);
     $_SESSION['input_data'] = $request;
     $_SESSION['errors'] = [];
     foreach ($request as $key => $value) {
       if (($key == 'name-first' || $key == 'name-last' || $key == 'message' || $key == 'email') && $value == '')
         $_SESSION['errors'][$key] = '0';
       if ($key == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL) )
         $_SESSION['errors'][$key] = '0';
     }

     if (count($_SESSION['errors']) == 0){
       try {
         $sender = 'help@neuraptive.com';
         $name = $request['name-first'].' '.$request['name-last'];
         $subject = 'Email from '.$name.' from neuraptive.com';
         $body = App::render('public/emails/contact', compact('request'));
         $mailer = App::email_connect(
           $sender, $name, 'info@neuraptive.com', $subject, $body
         );
         $mailer->AddCC($request['email']);

         if ($mailer->send()) {
           $this->storeMessage($request);
           $_SESSION['success'] = '1';
         }
        } catch (Exception $e) {
          $_SESSION['success'] = '0';
        }
     }
     App::view('public/'.$from);
   }

   public function storeMessage($request) {
     $message = new Message();
     $message->define([
       'name' => $request['name-first'].' '.$request['name-last'],
       'country' => isset($request['country']) ? $request['country'] : '',
       'email' => $request['email'],
       'organization' => $request['organization'],
       'phone' => $request['phone'],
       'fax' => $request['fax'],
       'address' => $request['address'],
       'state' => isset($request['state']) ? $request['state'] : '',
       'city' => $request['city'],
       'zip' => $request['zip'],
       'message' => $request['message']
     ]);
     App::database('messages')->insert($message);
   }

}
