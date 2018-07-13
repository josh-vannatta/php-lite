<?php
   App::view('layouts/master_top', [
    'page_title' => 'Home Page'
   ]);
 ?>
  <section class="mdl-layout__tab-panel is-active">
    <div class="page-content pt-5">
      <h4>Completed migrations listed below</h4>
      <p>
        <?php
          Migrate::users();
          Migrate::passwordResets();
          Migrate::sessions();
          Migrate::autoLogins();
        ?>
      </p>
      <p>
        If any migrations were defined and not listed above, please adjust your code and try again.
      </p>
      <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mr-2" href="<?= base_url() ?>/migrate-confirm">
        Try again
      </a>
      <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--alert" href="<?= base_url() ?>/">
        Go home
      </a>
    </div>
  </section>
<?php App::view('layouts/master_bottom'); ?>
