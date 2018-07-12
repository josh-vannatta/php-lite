<div id="navmobile-contain" class="navmobile-contain">
  <div id="navmobile-scroller" class="navmobile-scroller" onscroll="mobileIndicator()">
    <ul id="nav-mobile" class="nav-mobile">

      <li class="mobile-link">
        <a href="/">
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          HOME</a>
      </li>

      <li class="mobile-link">
        <a href="/vision/">
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          VISION</a>
      </li>

      <li class="mobile-link">
        <a href="/technology/">
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          TECHNOLOGY</a>
      </li>

      <li class="mobile-link">
        <a onclick="mobileSubmenu('#product-submenu', this, '#product-arrow')" href="javascript:;">
          <i id="product-arrow" class="material-icons mobile-arrow">arrow_drop_down</i>
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          PRODUCTS</a>
        <ul id="product-submenu" class="mobile-submenu">
          <li class="mobile-submenu-link mobile-link">
            <a href="/products/">
              <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
              ALL PRODUCTS</a>
          </li>
          <li class="mobile-submenu-link mobile-link">
            <a href="/products/axofuse/">
              <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
              AXOFUSE®</a>
          </li>
        </ul>
      </li>

      <li class="mobile-link">
        <a onclick="mobileSubmenu('#about-submenu', this, '#about-arrow')" href="javascript:;">
          <i id="about-arrow" class="material-icons mobile-arrow">arrow_drop_down</i>
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          ABOUT</a>
        <ul id="about-submenu" class="mobile-submenu">
          <li class="mobile-submenu-link mobile-link">
            <a href="/about/">
              <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
              ABOUT US</a>
          </li>
          <li class="mobile-submenu-link mobile-link">
            <a href="/about/team/">
              <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
              TEAM</a>
          </li>
        </ul>
      </li>

      <li class="mobile-link">
        <a href="/investors/">
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          INVESTOR</a>
      </li>

      <li class="mobile-link">
        <a href="/contact/">
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          CONTACT US</a>
      </li>

      <li class="mobile-link">
        <a href="/frequently-asked/">
          <i class="material-icons mobile-arrow mobile-arrow-link">arrow_drop_down</i>
          FAQ</a>
      </li>
    </ul>
  </div>
  <div class="mobile-indicator">
    <a onclick="mobileMenuScroll()" href="javascript:;">
      <i id="mobile-indicator"class="material-icons">expand_more</i>
    </a>
  </div>
</div>
