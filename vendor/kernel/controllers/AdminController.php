<?php
class AdminController
{
  public function __construct()
  {
    if (App::admin() == false)
      Redirect::url('/admin');
    if (App::uri('system/accounts') && !in_array('acct_view',App::admin('permissions')))
     Redirect::url('/admin');
     if (App::uri('system/profile') && !App::uri(App::admin('email')) &&
        !in_array('acct_ctrl',App::admin('permissions')))
      Redirect::url('/admin');
    if (App::uri('system/create') && !in_array('acct_ctrl',App::admin('permissions')))
     Redirect::url('/admin');
  }

  public function dashboard()
  {
    $ga_start = '2017-01-01';
    $ga_end = date('Y-m-d', strtotime("last day of last month"));
    $ga_metrics = ['users', 'sessions'];
    $ga_filters = ['yearMonth'];

    $ga_data = GoogleAnalytics::getResults(
      $ga_start,  $ga_end, $ga_metrics, $ga_filters
    );

    $ga_data['yearMonth']['201801'] = [ 'users' => '167', 'sessions' => '40' ];
    $ga_data['yearMonth']['201712'] = [ 'users' => '191', 'sessions' => '26' ];
    $ga_data['yearMonth']['201711'] = [ 'users' => '162', 'sessions' => '35' ];
    $ga_data['yearMonth']['201710'] = [ 'users' => '171', 'sessions' => '41' ];
    $ga_data['yearMonth']['201709'] = [ 'users' => '158', 'sessions' => '32' ];

    $time_span = 5;
    $line_chart = [];
    $monthly_avg = 0;
    $page_visits = 0;
    foreach($ga_data['yearMonth'] as $month)
    {
      if (count($line_chart) < $time_span)
        $line_chart[] = $month['users'];

      $monthly_avg += $month['users'];
      $page_visits += $month['sessions'];
    }
    $monthly_avg = ceil($monthly_avg/$time_span);

    App::view('dashboard', compact('line_chart', 'monthly_avg', 'page_visits'));
  }

  public function index()
  {
    $accounts = App::database('admins')->all();
    App::view('system/index', compact('accounts'));
  }

  public function create()
  {
    App::view('system/create');
  }

  public function store()
  {
    $request = Request::all();
    $validator = new Validator($request, [
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if ($validator->fails())
       Redirect::back([
         'input_data' => $request,
         'errors' => $validator->errors
       ]);

    $admin = new Admin();
    $permissions = serialize(array_keys(
      Request::input(['news_ctrl', 'acct_view', 'acct_ctrl', 'mail_ctrl'])
    ));

    $role = 'System Moderator';
    if (isset($request['acct_ctrl'])) $role = 'System Administrator';

    $user_key = hash('crc32', microtime(true) . mt_rand() . $request['email']);

    $admin->define([
      'id' => $user_key,
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => password_hash($request['password'], PASSWORD_DEFAULT),
      'role' => $role,
      'permissions' => $permissions
    ]);

    App::database('admins')->insert($admin);
    Redirect::url("/admin/system/accounts");
  }

  public function edit($email)
  {
    $admin = App::database('admins')->where('email', '=', $email)[0];
    $admin->permissions = unserialize($admin->permissions);
    App::view('system/edit', compact('admin'));
  }

  public function update()
  {
    $current = App::database('admins')->where('email', '=', Request::input('current'))[0];

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

    $admin = new Admin();
    $role = $current->role;
    if (App::admin('email') == $current->email) {
      $permissions = $current->permissions;
    } else {
      $permissions = serialize(array_keys(
        Request::input(['news_ctrl', 'acct_view', 'acct_ctrl', 'mail_ctrl'])
      ));
      $role = 'System Moderator';
      if (isset($request['acct_ctrl'])) $role = 'System Administrator';
    }

    $new_pass = $current->password;
    if (isset($request['password']))
      $new_pass = password_hash($request['password'], PASSWORD_DEFAULT);

    $admin->define([
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => $new_pass,
      'role' => $role,
      'permissions' => $permissions
    ]);

    $admin->id = $current->id;

    App::database('admins')->update($admin);
    Redirect::url("/admin/system/accounts");
  }

  public function update_password()
  {
    $request = Request::all();
    $current = App::database('admins')->where('email', '=', $request['current'])[0];
    $request = Request::all();
    $validator = new Validator($request, [
      'password' => 'required'
    ]);

    if (!password_verify($request['current-password'], $current->password))
      Redirect::back(['errors' => ['The password you entered was incorrect'] ]);
    if ($validator->fails())
       Redirect::back([ 'errors' => $validator->errors ]);
   if ($request['password'] != $request['confirm-password'])
      Redirect::back([ 'errors' => ['The passwords you entered do not match'] ]);

    $new_pass = password_hash($request['password'], PASSWORD_DEFAULT);

    $admin = new Admin();
    $admin->define([
      'name' => $current->name,
      'email' => $current->email,
      'password' => $new_pass,
      'role' => $current->role,
      'permissions' => $current->permissions
    ]);

    $admin->id = $current->id;

    App::database('admins')->update($admin);
    Redirect::url("/admin/system/accounts");
  }


  public function destroy()
  {
    $admin = App::database('admins')->where('email', '=', Request::input('email'));
    App::database('admins')->destroy($admin[0]->id);
    Redirect::url("/admin/system/accounts");
  }

  public function clearMessages()
  {
    $messages = App::database('messages')->all();
    foreach ($messages as $message) {
      App::database('messages')->destroy($message->id);
    }
    Redirect::url("/admin/dashboard");
  }

}
