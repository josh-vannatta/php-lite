<!-- Side Navigation -->
<?php $pm = App::admin('permissions'); ?>
<section class="admin-sidenav">
  <div class="--nav-contain --transition">
    <div class="--nav-logo">
      <?php App::view('vector/logo_white_new') ?>
      <img src="/assets/image/logo/logo_white_core.png" alt="Nueraptive Logo">
    </div>
    <ul class="--nav-full">
      <!-- Home / Dashboard -->
      <li><a class="--nav-section --transition <?php if (App::uri('dashboard')) echo '-active' ?>" href="/admin/dashboard">
          <i class="material-icons --nav-icon">pie_chart</i>
          <span class="--transition --title">Dashboard</span>
      </a></li>
      <!-- News Items -->
      <?php if ($pm != null && in_array('news_ctrl',$pm)) : ?>
      <li>
        <ul class="--collapse">
          <li>
            <a class="--collapse-header --nav-section --transition">
              <i class="material-icons --nav-icon">dvr</i>
              <span class="--transition --title">News Releases</span>
              <i class="material-icons --dropdown">expand_more</i>
            </a>
            <div class="--collapse-body">
              <ul>
                <li><a class="--nav-section --transition <?php if (App::uri('news/all')) echo '-active' ?>" href="/admin/news/all/page=1">All Releases</a></li>
                <li><a class="--nav-section --transition <?php if (App::uri('news/create')) echo '-active' ?>" href="/admin/news/create">Create new</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <!-- Settings -->
      <?php if ($pm != null && in_array('acct_view',$pm)) : ?>
      <li>
        <ul class="--collapse">
          <li>
            <a class="--collapse-header --nav-section --transition">
              <i class="material-icons --nav-icon">equalizer</i>
              <span class="--transition --title">System</span>
              <i class="material-icons --dropdown">expand_more</i>
            </a>
            <div class="--collapse-body">
              <ul>
                <li><a class="--nav-section --transition <?php if (App::uri('system/accounts')) echo '-active' ?>" href="/admin/system/accounts">Admin Accounts</a></li>
                <?php if ($pm != null && in_array('acct_ctrl',$pm)) : ?>
                <li><a class="--nav-section --transition <?php if (App::uri('system/create')) echo '-active' ?>" href="/admin/system/create">New Admin</a></li>
                <?php endif; ?>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      <?php endif; ?>
      <!-- Profile -->
      <li><a class="--nav-section --transition <?php if (App::uri(App::admin('email'))) echo '-active' ?>" href="/admin/system/profile=<?= App::admin('email') ?>">
          <i class="material-icons --nav-icon">account_box</i>
          <span class="--transition --title">Profile</span>
      </a></li>
    </ul>
  </div>
</section>
