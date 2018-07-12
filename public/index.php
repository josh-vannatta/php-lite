<?php

/* INDEX
 * ----------------------
 * Hello fellow developer! This little MVC framework
 * was developed for YOU to build something complex
 * with just a few commands and methods.
 *
 * First we load the application-wide classes and
 * external depencies. Run `composer dump-autoload`
 * to generate.
 */

require '../vendor/autoload.php';

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
 * framework/Database/QueryBuilder for available
 * methods and queries.
 */

App::bind('database',
  new QueryBuilder($db_connection)
);

/* SESSION HANDLER
 * ----------------------
 * We establish the connection to the model
 * responsible for persistant sessions and set timeout.
 * Access session config via App::session(key);
 *
 * Visit {base_url}/session_table/generate to
 * create **fresh** session table;
 */

// $handler = new PersistentSessionHandler(
//   $db_connection
// );
// session_set_save_handler($handler);
session_start();
$_SESSION['active'] = time();

/* AUTHENTICATION
 * ----------------------
 * If the session is authenticated and matches
 * user defined configuration, authenticate.
 * Access authenticated user via App::auth(key)
 */

// if (isset($_SESSION['authenticated']) || isset($_SESSION[App::session('name')])) {
//     App::authenticate(App::session('name'));
//     $auto_login = new AutoLogin($db_connection);
//     $auto_login->checkCredentials();
// }

/* PASSWORD RESETS
 * ----------------------
 * Clear expired resets in password reset table.
 *
 * Visit {base_url}/password_table/generate to
 * create **fresh** password_resets table;
 */

// clear_resets();

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

/* DONE
 * ----------------------
 * New page loads, return to top of page.
 */
