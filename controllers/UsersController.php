<?php
class UsersController
{

  public function __construct()
  {
    if (!Request::equals(['/account/store']) && !App::auth())
      Redirect::url('/');
  }

  public function index($mail)
  {
    $users = App::database('users')->where('email', '=', $email);
    App::view('account/index', compact('users'));
  }

  public function store()
  {
    $request = Request::all();
    $validator = new Validator($request, [
      'first' => 'required',
      'last' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8'
    ]);

    if ($validator->fails() || $request['password'] !== $request['passwordconfirm'])
       Redirect::back([
         'input_data' => $request,
         'errors' => $validator->errors
       ])
     ;

   $user = new User();
   $user->define([
     'id' => generate_token($request['email']),
     'name' => $request['first'].' '.$request['last'],
     'email' => $request['email'],
     'password' => password_hash($request['password'], PASSWORD_DEFAULT)
   ]);

   App::database('users')->insert($user);
   login($user->email);
   Redirect::url("/");
  }

  public function edit($email)
  {
    $user = App::database('users')->where('email', '=', $email)[0];
    App::view("account/edit", compact('user'));
  }

  public function update()
  {
    $current_user = App::database('users')->where('email', '=', Request::input('current'))[0];

    $request = Request::all();
    $validator = new Validator($request, [
      'name' => 'required',
      'email' => 'required|email'
    ]);

    if ($validator->fails())
       Redirect::back([
         'input_data' => $request,
         'errors' => $validator->errors
       ]);

    $user = new Admin();
    $user->define([
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => password_hash($request['password'], PASSWORD_DEFAULT),
      'role' => $role,
      'permissions' => $permissions
    ]);

    $user->id = $current_user->id;

    App::database('users')->update($user);
    Redirect::url("account/$user->email");
  }

  public function update_password()
  {
    $request = Request::all();
    $current_user = App::database('users')->where('email', '=', $request['current'])[0];
    $request = Request::all();
    $validator = new Validator($request, [
      'password' => 'required'
    ]);

    if (!password_verify($request['current-password'], $current_user->password))
      Redirect::back(['errors' => ['The password you entered was incorrect'] ]);
    if ($validator->fails())
       Redirect::back([ 'errors' => $validator->errors ]);
   if ($request['password'] != $request['confirm-password'])
      Redirect::back([ 'errors' => ['The passwords you entered do not match'] ]);

    $new_pass = password_hash($request['password'], PASSWORD_DEFAULT);

    $user = new Admin();
    $user->define([
      'name' => $current_user->name,
      'email' => $current_user->email,
      'password' => $new_pass,
      'role' => $current_user->role,
      'permissions' => $current_user->permissions
    ]);

    $user->id = $current_user->id;

    App::database('users')->update($user);
    Redirect::url("account/$user->email");
  }


  public function destroy()
  {
    if (!Request::input('validate_request'))
      return Redirect::back();
    $user = App::database('users')->where('email', '=', Request::input('email'));
    App::database('users')->destroy($user[0]->id);
    Redirect::url("/");
  }

}
