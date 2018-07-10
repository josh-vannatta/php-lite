<section class="header-section" id="header-section">
  <div id="navtop-contain" class="navtop-contain">
    <div class="navfull-wrapper">
      <div id="navleft-contain" class="navleft-contain">
        <a href="/">
          <div id="nav-logo" class="nav-logo">
            <?php App::view('vector/logo_wide') ?>
          </div>
        </a>
      </div>
      <div id="navright-contain" class="navright-contain" style="display: block; visibility: visible;">
        <nav id="navupper-contain" class="navupper-contain">
          <div id="vision-link" class="navupper-group">
            <a href="/vision/" class=" navtop-link <?php if (App::uri('vision')) echo 'navmenu-current' ?>">VISION</a>
          </div>
          <div id="tech-link" class="navupper-group">
            <a href="javascript:;" class=" navtop-link <?php if (App::uri('technology')) echo 'navmenu-current' ?>">TECHNOLOGY</a>
            <ul id="tech-menu" class="navtop-submenu ">
              <li><a href="/technology/" class=" submenu-link <?php if (App::uri('technology') && !App::uri('core')) echo 'navmenu-current' ?>">CORE TECHNOLOGY</a></li>
              <li><a href="/frequently-asked/" class=" submenu-link <?php if (App::uri('core')) echo 'navmenu-current' ?>">FAQ</a></li>
            </ul>
          </div>
          <div id="products-link" class="navupper-group">
            <a href="javascript:;" class=" navtop-link <?php if (App::uri('products')) echo 'navmenu-current' ?>">PRODUCTS</a>
            <ul id="products-menu" class="navtop-submenu ">
              <li><a href="/products/" class=" submenu-link <?php if (App::uri('products') && !App::uri('axofuse')) echo 'navmenu-current' ?>">ALL PRODUCTS</a></li>
              <li><a href="/products/axofuse" class=" submenu-link <?php if (App::uri('axofuse')) echo 'navmenu-current' ?>">AXOFUSE<sup>®</sup></a></li>
            </ul>
          </div>
          <div id="about-link" class="navupper-group">
            <a href="javascript:;" class=" navtop-link <?php if (App::uri('about')) echo 'navmenu-current' ?>">ABOUT</a>
            <ul id="about-menu" class="navtop-submenu ">
              <li><a href="/about/" class=" submenu-link <?php if (App::uri('about') && !App::uri('team')) echo 'navmenu-current' ?>">ABOUT US</a></li>
              <li><a href="/about/team/" class=" submenu-link <?php if (App::uri('team')) echo 'navmenu-current' ?>">TEAM</a></li>
            </ul>
          </div>
          <div id="about-link" class="navupper-group">
            <a id="investors-link" href="/investors/" class=" navtop-link <?php if (App::uri('investors')) echo 'navmenu-current' ?>">INVESTORS</a>
          </div>
          <div id="about-link" class="navupper-group">
            <a id="contact-link" href="/contact/" class=" navtop-link <?php if (App::uri('contact')) echo 'navmenu-current' ?>">CONTACT US</a>
          </div>
        </nav>
      </div>
      <div id="navmobile-button" class="navmobile-button">
        <div id="hamburger-nav" class="hamburger-nav">
          <div onclick="mobileMenu(this)" id="hamburger-contain" class="hamburger-contain">
            <div class="hamburger-spoke hamburger-open"></div>
            <div class="hamburger-spoke hamburger-open"></div>
            <div class="hamburger-spoke hamburger-open"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php App::view('public/partials/nav_mobile') ?>
</section>
