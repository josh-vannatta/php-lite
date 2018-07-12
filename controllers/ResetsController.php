<?php

class ResetsController
{
  public function generate()
  {
    // create database table query
  }

  public function index()
  {
    App::view('auth/request_reset');
  }

  public function attempt()
  {
    $request = Request::all();
    $email = $request['email'];
    $validator = new Validator($request, ['email' => 'required|email']);
    if ($validator->fails())
       Redirect::back([
         'input_data' => $request,
         'errors' => $validator->errors
       ])
     ;

    $token = bin2hex(random_bytes(16));
    $password_reset = new PasswordReset();
    $hash_token = password_hash($token, PASSWORD_DEFAULT);
    $password_reset->define([
      'token' => $hash_token,
      'email' => $email,
      'expiry' => strtotime('+1 day', time())
    ]);

    $app_settings = App::get('config')['app'];
    $reset_link = $app_settings->base_url."/reset-password?e=$email&t=$token";

    try {
      $endpoint = str_pos('https', $app_settings->base_url) ?
        str_replace('https://', '', $app_settings->base_url) :
        str_replace('http://', '', $app_settings->base_url);
      $sender = 'help@'.$endpoint;
      $name = $app_settings->name;
      $subject = 'Reset Your Password';
      $body = App::render('auth/reset_email', compact('email', 'reset_link'));
      $mailer = email_connect(
        $sender, $name, $email, $subject, $body
      );

      if ($mailer->send()) {
        App::database('password_resets')->destroy_where('email', '=', $email)->insert($password_reset);
        Redirect::url('/admin', [
          'messages' => ['Your password has been reset. You will recieve an email shortly with the reset link.']
        ]);
      }
    } catch (Exception $e) {
      dd($e);
      Redirect::back([
        'errors' => ['We experienced an error sending your reset link. Check your email credentials.']
      ]);
    };
  }

  public function edit()
  {
    App::view('auth/reset_password');
  }

  public function update()
  {
    $request = Request::all();
    $validator = new Validator($request, [
      'token' => 'required',
      'email' => 'required|email',
      'new-password' => 'required|min:8|strong',
    ]);

    if ($validator->fails())
       Redirect::back(['errors' => $validator->errors])
    ;

    if ($request['new-password'] != $request['password-confirm'])
      Redirect::back([
        'errors' => ['Your password confirmation did not match. Please try again.']
      ])
    ;

    $reset = App::database('password_resets')->where('email', '=', $request['email'])[0];
    if (password_verify($request['token'], $reset->token))
    {
      $current_user = App::database('admins')->where('email', '=', $request['email'])[0];
      $new_pass = password_hash($request['new-password'], PASSWORD_DEFAULT);
      $admin = new Admin();
      $admin->define([
        'name' => $current_user->name,
        'email' => $current_user->email,
        'password' => $new_pass,
        'role' => $current_user->role,
        'permissions' => $current_user->permissions
      ]);

      $admin->id = $current_user->id;
      App::database('admins')->update($admin);
      App::database('password_resets')->destroy_where('email', '=', $current_user->email);
      App::login($current_user->email);
    }
    Redirect::back([
      'errors' => ['Your password reset token has expired. Please request a new reset link email.']
    ]);
  }
}
