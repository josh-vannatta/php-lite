<?php
   $page_title = 'Admin | All News';
   App::view('partials/header', compact('page_title'));
 ?>
    <section class="row">
      <div class="col-xs-12">
        <div class="--inline-header">
          <h3 class="--section-header">News Releases</h3>
          <a href="/admin/news/create" class="--link-block">CREATE NEW</a>
        </div>
        <?php if ($numPages > 1) App::view('partials/pagination', compact('numPages', 'curPage'))  ?>
      </div>
      <div class="col-xs-12">
        <ul class="--news-feed">
          <?php foreach($news as $item) : ?>
            <li class="--module">
              <div class="--news-item" href="/admin/news/edit/item=<?= $item->id ?>">
                <div class="--header">
                  <h4 class="--title"><?= $item->title ?></h4>
                  <p class="--subtitle"><?= formatDate($item->published, 'm/d/Y') ?></p>
                </div>
                <div class="--body row">
                  <div class="col-sm-10 --no-padding">
                    <p>
                      <?= $item->brief ?>
                    </p>
                    <a class="--link-basic" target="_blank" style="margin-top: 0px" href="/news/release/<?= urlencode(strtolower($item->title)) ?>">Read more...</a>
                  </div>
                  <div class="col-sm-2 --controls" style="padding-right: 0">
                    <a href="/admin/news/edit/item=<?= $item->id ?>" class="--link-block --basic">Edit</a>
                    <button type="button" onclick="deleteNewsItem(<?= $item->id ?>, '<?= addslashes($item->title) ?>')" class="--link-block --cancel">Delete</a>
                  </div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
    <!-- Modal Windows -->
    <section class="--modal --transition --hidden">
      <div id="delete-popup" class="--popup --transition --hidden">
        <div class="--close">
          <button class="--transition close-popup" type="button" name="cancel">X</button>
        </div>
        <form class="" action="/admin/news/delete" method="post">
          <div class="--content">
            <input id="delete-id" type="hidden" name="id" value="">
            <p class="--message">Permanently delete news announcement?</p>
            <h4 id="delete-title"></h4>
          </div>
          <div class="--action">
            <button type="submit" name="submit" class="--button-gen --cancel --transition">Delete</button>
            <button type="button" name="cancel" class="close-popup --button-gen --basic --transition">Cancel</button>
            <small class="--disclosure">*Cannot be undone once confirmed</small>
          </div>
        </form>
      </div>
    </section>
  <?php App::view('partials/footer') ?>
