<?php
  $page_title = 'Neuraptive | Investors';
  $title = 'Investors';
  $cur_page = 'investors';
  $page_description = 'Neuraptive - Investors';
  $crumbs = [
    '/' => 'Home',
    '/investors' => 'Investors',
  ];
  App::view('public/partials/header', compact('page_title', 'page_description', 'title', 'crumbs'));
 ?>

 <section class="subheader-section padding-xl no-padding-bottom">
   <div id="vision-container" class="vision-container wide-rule ">
     <h3 class="subheader-page subheader-std">Neuraptive is privately held. Current investors include members of the
       <a class="floating-link" href="http://centraltexasangelnetwork.com/" target="_blank">Central Texas Angel Network</a>,
       <a class="floating-link" href="http://www.newrhein.com/" target="_blank">New Rhein Healthcare Investors</a>, and
       several other angel investors. The Company has secured a $1M seed round of financing. Read more
       <a class="floating-link" href="http://www.neuraptive.com/distr/Neuraptive_NTx-Seed_8.18.17.pdf" target="_blank">here.</a>
       Neuraptive is currently soliciting Series A financing with institutional investors.</h3>
   </div>
 </section>

  <?php App::view('public/partials/contact_form' ,compact('cur_page')) ?>
 <?php App::view('public/partials/footer') ?>
