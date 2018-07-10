<?php
  $page_title = 'Neuraptive | News Releases';
  $title = 'News Releases';
  $page_description = 'Neuraptive news releases';
  $month = '';
  $crumbs = [
    '/' => 'Home',
    '/news/page=1' => 'News'
  ];
  App::view('public/partials/header', compact('page_title', 'page_description', 'title', 'crumbs'));
 ?>

 <main class="padding-lg">
   <div class="wide-rule">
   <?php foreach ($news_items as $release): ?>
     <?php if ($month != formatDate($release->published, 'F')): ?>
     <?php if ($month != '') echo '</section>';  $month = formatDate($release->published, 'F'); ?>
      <section class="news-section">
        <h2 class="subheader-main blue-trap"><?= $month ?></h2>
        <?php endif; ?>
        <article>
          <h4><?= formatDate($release->published, 'M d, Y') ?> / <?= $release->title ?></h4>
          <p><?= $release->brief ?></p>
          <a href="/news/release/<?= urlencode(strtolower($release->title)) ?>" class="floating-link">Read more</a>
       </article>
   <?php endforeach; ?>
     </section>
        <?php if ($numPages > 1) App::view('public/partials/pagination', compact('curPage', 'numPages')) ?>
   </div>
 </main>

 <?php App::view('public/partials/footer') ?>
