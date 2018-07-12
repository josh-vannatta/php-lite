<?php
class LoginController
{

  public function generate()
  {
    echo "Session table created";
  }

  public function index()
  {
    // If admin is logged in direct to dashboard
    if (session('admin_email') !== false)
      return Redirect::url('/admin/dashboard');
    // Else display login page
    App::view('login');
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

    $admin = App::database('admins')->where('email', '=', $request['email'])[0];

    if (property_exists($admin, 'password') &&
        password_verify($request['password'], $admin->password)) {
        login($admin->email);
        return Redirect::url('/admin/dashboard');
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
    Redirect::url('/admin');
  }

  public function confirm()
  {
    $user = App::database('admins')->where('email', '=', Request::input('email'));
    die(count($user) > 0);
  }

}
