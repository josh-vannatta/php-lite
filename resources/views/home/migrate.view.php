<?php
   App::view('layouts/master_top', [
    'page_title' => 'Home Page'
   ]);
 ?>
  <section class="mdl-layout__tab-panel is-active">
    <div class="page-content pt-5">
      <h3 class="mb-3">Are you sure you're ready to migrate the database tables?</h3>
      <p>
        This will take any database migrations defined in <code class="z-depth-1">containers/Migrations</code>
        and create tables in your database. Doing so will not replace any existing
        tables in your database. Make sure your database connection is secure and
        the application is in development mode. However, once you migrate you can't go back!
      </p>
      <p>
        Click the button below to proceed or <a href="<?= base_url() ?>/">return home</a>
      </p>
      <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mr-2" href="<?= base_url() ?>/migrate-confirm">
        Migrate
      </a>
      <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--alert" href="<?= base_url() ?>/">
        Go home
      </a>
    </div>
  </section>
<?php App::view('layouts/master_bottom'); ?>
