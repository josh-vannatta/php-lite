<?php
  $page_title = 'Neuraptive | Contact Us';
  $title = 'Contact Us';
  $cur_page = 'contact';
  $page_description = 'Neuraptive - Contact Us';
  $crumbs = [
    '/' => 'Home',
    '/contact' => 'Contact',
  ];
  App::view('public/partials/header', compact('page_title', 'page_description', 'title', 'crumbs'));
 ?>
 <section class="subheader-section padding-xl no-padding-bottom">
   <div id="vision-container" class="vision-container wide-rule ">
     <h3 class="subheader-page subheader-std">Want to know more about Neuraptive? Visit our <a class="floating-link" href="{{site.baseurl}}/frequently-asked">FAQ page</a> to view our most commonly asked questions or contact us by filling in the following form:</h3>
   </div>
 </section>
 <?php App::view('public/partials/contact_form', compact('cur_page')) ?>
 <?php App::view('public/partials/footer') ?>
