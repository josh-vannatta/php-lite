<?php

/* CONFIGURATION
 * ----------------------
 * We bind the user defined config options to the
 * global App container. Each property is available
 * directly by accessing App::get('config')[prop].
 */

App::bind('config', require '../kernel/config.php');

/* HELPER FUNCTIONS
 * ----------------------
 * We then load application-wide helper functions
 * which provide formatting and internal resources
 */

require App::directory('helpers');

/* DATABASE CONNECTION
 * ----------------------
 * The database PDO connection is established by
 * accessing user defined database configuration
 */

$db_connection = Connection::make(
  App::get('config')['database']
);

/* EXPOSE DATABASE
 * ----------------------
 * The database is bound to the App container.
 * Access via App::database(model). See
 * documentation for available methods.
 */

App::bind('database',
  new QueryBuilder($db_connection)
);

/* SESSION HANDLER
* ----------------------
* We establish the connection to the tables
* responsible for persistant sessions and set timeout.
* Access session config via App::session(key);
*/

if (App::database()->contains('sessions') &&
    App::database()->contains('autologin')) {
  $handler = new PersistentSessionHandler($db_connection);
  session_set_save_handler($handler);
}
// session_name(App::session('name'));
session_start();
$_SESSION['active'] = time();
// dd($_SESSION);

/* AUTHENTICATION
* ----------------------
* If the session is authenticated and matches
* user defined configuration, authenticate.
* Access authenticated user via App::auth(key)
*/

if (isset($_SESSION['authenticated']) ||
    isset($_SESSION[App::session('user')])) {
  App::authenticate($_SESSION[App::session('user')]);
  $auto_login = new AutoLogin($db_connection);
  $auto_login->checkCredentials();
}

/* PASSWORD RESETS
 * ----------------------
 * We find and destroy expired resets in password
 * reset table. **remove if handled via cron-job**
 */

// clear_resets();

/* CSRF TOKEN
 * ----------------------
 * Cross site request forgery token generated
 * accessed via App::get('csrf_token') or
 * form input created via csrf_token();
 */

 App::bind('csrf_token', Request::forgeryToken());

/* ROUTES
 * ----------------------
 * Load user-defined routes and populate
 * Router->routes, and pass request uri and
 * controller method.
 */

Router::load(App::directory('routes'))
  ->direct(
    Request::uri(),
    Request::method()
  );

/* USER PASSBACKS
 * ----------------------
 * Clear any inputs, messages, or errors passed
 * from the controller to the view.
 */

unset(
  $_SESSION['input_data'],
  $_SESSION['messages'],
  $_SESSION['errors']
);
