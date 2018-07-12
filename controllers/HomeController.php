<?php

class HomeController
{

  public function index()
  {
    App::view('index');
  }

   public function contact()
   {
     App::view('home/contact');
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
         $endpoint = str_pos('https', $app_settings->base_url) ?
           str_replace('https://', '', $app_settings->base_url) :
           str_replace('http://', '', $app_settings->base_url);
         $sender = 'help@'.$endpoint;
         $name = $request['name-first'].' '.$request['name-last'];
         $subject = 'Email from '.$name.' from neuraptive.com';
         $body = App::render('emails/contact', compact('request'));
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
     App::view('public/contact_success');
   }

}
