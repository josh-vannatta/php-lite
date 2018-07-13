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
                mdl-textfield--floating-label mdl-textfield--align-right">
      <label class="mdl-button mdl-js-button mdl-button--icon"
             for="waterfall-exp">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" name="sample" id="waterfall-exp">
      </div>
    </div>
    <!-- Account actions  -->
    <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
      <i class="material-icons">account_circle</i>
    </button>
    <!-- Account submenu -->
    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
        for="demo-menu-lower-right">
      <li class="mdl-menu__item">Login</li>
      <li class="mdl-menu__item">Create account</li>
      <li disabled class="mdl-menu__item">Sign out</li>
    </ul>
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
