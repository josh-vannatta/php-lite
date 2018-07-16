<header class="mdl-layout__header --header">
  <div class="mdl-layout__header-row container rel">
    <!-- Title -->
    <a class="flex-center --title mr-5" href="<?= base_url(); ?>/">
      <div class="--icon mr-2">
        <img src="<?= base_url(); ?>/assets/favicon/android-chrome-512x512.png" class="w-100"></img>
      </div>
      <span class="mdl-layout-title">MVC Lite</span>
    </a>
    <!-- Navigation -->
    <nav class="mdl-navigation mdl-layout--large-screen-only">
      <?php App::view('partials/navigation') ?>
    </nav>
    <div class="mdl-layout-spacer"></div>
    <!-- Search Bar -->
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                mdl-textfield--floating-label mdl-textfield--align-right" style="width: auto">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="waterfall-exp">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" name="sample" id="waterfall-exp">
      </div>
    </div>
    <!-- Account actions  -->
    <?php if (!App::auth()): ?>
    <a href="<?= base_url(); ?>/login" class="mdl-layout__tab">Sign In</a>
    <?php else: ?>
    <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
      <i class="material-icons">account_circle</i>
    </button>
    <!-- Account submenu -->
    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
        for="demo-menu-lower-right">
      <li class="mdl-menu__item blank" id="app-login-select">
        <a href="#">My Account</a>
      </li>
      <li class="mdl-menu__item blank">
        <a href="<?= base_url(); ?>/logout">Sign out</a>
      </li>
    </ul>
  <?php endif; ?>
</div>
  <!-- Tabs -->
  <?php if (isset($header_tabs)) App::view($header_tabs); ?>
</header>
<div class="mdl-layout__drawer --header">
  <a class="d-flex flex-row align-items-center --title pt-5" style="padding-left: 40px" href="<?= base_url(); ?>/">
    <div class="--icon mr-2">
      <img src="<?= base_url(); ?>/assets/favicon/android-chrome-512x512.png" class="w-100"></img>
    </div>
    <span class="mdl-layout-title">MVC Lite</span>
  </a>
  <nav class="mdl-navigation">
    <?php App::view('partials/navigation') ?>
  </nav>
</div>
