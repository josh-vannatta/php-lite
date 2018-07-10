<?php
  $page_title = $release->title;
  $title = 'News Release';
  $page_description = $release->brief;
  $crumbs = [
    '/' => 'Home',
    '/news/page=1' => 'News',
  ];
  App::view('public/partials/header', compact('page_title', 'page_description', 'title', 'crumbs'));
 ?>

 <main class="padding-lg">
   <div class="wide-rule">
     <section class="news-release">
       <h2 class="subheader-main blue-trap"><?= $release->title ?></h2>
       <h4><?= formatDate($release->published, 'F d, Y') ?></h4>
       <div class="content">
         <?php if (($release->picture) != 'void.null'): ?>
          <img src="/assets/image/news/<?= $release->picture ?>" class="float-left-img">
         <?php endif; ?>
         <p><?= $release->body ?></p>
       </div>
       <?php if ($release->link != 'void.null'): ?>
       <a href="/distr/releases/<?= $release->link ?>" target="_blank" class="floating-link"><i class="material-icons">file_download</i>Download PDF</a>
       <?php endif; ?>
     </section>
   </div>
 </main>

 <?php App::view('public/partials/footer') ?>
