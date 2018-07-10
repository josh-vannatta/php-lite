<!-- User Information -->
<section class="row">
  <div class="col-md-12">
    <div class="--ui">
      <div class="--profile" onclick="javascript:location.href='/admin/system/profile=<?= App::admin('email')?>'">
        <div class="--pic">
          <?php App::view('vector/user_default') ?>
        </div>
        <div class="--details">
          <h4 class="--no-margin"><?= App::admin('name'); ?></h4>
          <p style="margin: 0; line-height: 1.8"><?= App::admin('role'); ?></p>
        </div>
      </div>
      <div class="--logout">
        <a href="/admin/logout" class="--transition">
          <p style="margin: 0 5px 2px">Log out</p>
          <?php App::view('vector/logout') ?>
        </a>
      </div>
    </div>
    <div class="--seperator"></div>
  </div>
</section>
