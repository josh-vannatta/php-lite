<?php
class LoginController
{

  public function index()
  {
    App::view('auth/login');
  }

  public function create()
  {
    App::view('auth/register');
  }

  public function login()
  {
    $request = Request::all();
    $validator = new Validator($request, [
      'email' => 'required|email',
      'password' => 'required'
    ]);

  if ($validator->fails())
     Redirect::back([
       'input_data' => $request,
       'errors' => $validator->errors
     ])
   ;

    $user = App::database('users')->where('email', '=', $request['email'])[0];

    if ($user && property_exists($user, 'password') &&
        password_verify($request['password'], $user->password)) {
        App::login($user->email);
        return Redirect::url('/');
      }
    ;


    return Redirect::back([
      'input_data' => $request,
      'errors' => ['Login failed. Check your username and password'],
    ]);
  }

  public function logout()
  {
    $auto_login = new AutoLogin(
      Connection::make(App::get('config')['database'])
    );
    $auto_login->logout(true);
    $_SESSION = [];
    $params = session_get_cookie_params();
    $params['lifetime'] = time() - 86400;
    setcookie(session_name(), '', ...array_values($params));
    session_destroy();
    Redirect::url('/');
  }

  public function confirm()
  {
    $user = App::database('admins')->where('email', '=', Request::input('email'));
    die(count($user) > 0);
  }

}
