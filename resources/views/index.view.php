<?php
   App::view('layouts/master_top', [
    'page_title' => 'Home Page',
    'header_tabs' => 'home/partials/index-tabs'
   ]);
 ?>
  <section class="mdl-layout__tab-panel is-active" id="scroll-tab-1">
    <div class="page-content pt-5">
      <?php App::view('home/content/documentation/overview') ?>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-2">
    <div class="page-content pt-5">
      <?php App::view('home/content/documentation/database') ?>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-3">
    <div class="page-content pt-5">
      <?php App::view('home/content/documentation/security') ?>
    </div>
  </section>
  <section class="mdl-layout__tab-panel" id="scroll-tab-4">
    <div class="page-content pt-5">
      <?php App::view('home/content/documentation/front-end') ?>
    </div>
  </section>
<?php App::view('layouts/master_bottom'); ?>
