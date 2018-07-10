<?php
  if (App::admin('email') != $admin->email && $admin->role == 'Website Administrator')
     Redirect::url('/admin');
   $page_title = "Admin | $admin->name";
   App::view('partials/header', compact('page_title'));
 ?>
      <section class="row">
        <div class="col-md-12">
          <h3 class="--section-header">
          <?php if ($admin->email !== App::admin('email')): ?>
            <?= $admin->name ?>'s Profile
          <?php else: ?>
            My Profile
          <?php endif; ?>
          </h3>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-10">
          <?php App::view('partials/errors') ?>
          <form id="edit-profile-form" class="news-item" method="post"
            style="letter-spacing: 0" action="/admin/system/update"
            fs--form fs--listen="<?php if (session('input_data')) echo 'now' ?>">
            <div >
              <input type="hidden" name="current" value="<?= $admin->email ?>">
                <div class="form-group --responsive --active">
                  <label for="title">Full name</label>
                  <input type="text" class="form-control"
                    name="name"
                    placeholder="Full name"
                    fs--input="The admin's full name"
                    fs--rules="required"
                    value="<?= $admin->name ?>">
                </div>
                <div class="form-group --responsive --active">
                  <label for="published">Email address</label>
                  <input type="text" class="form-control"
                    name="email"
                    placeholder="Email address"
                    fs--input="The admin's email address"
                    fs--rules="required|email"
                    value="<?= $admin->email ?>">
                </div>
                <?php if ($admin->email !== App::admin('email')): ?>
                  <?php App::view('system/edit_account', compact('admin')) ?>
                <?php else: ?>
                  <?php App::view('system/edit_profile', compact('admin')) ?>
                <?php endif; ?>
                <button type="submit" style="margin: 30px 0 15px" class="--button-gen --transition" fs--button>Submit</button>
            </div>
          </form>
        </div>
    </section>
  <?php App::view('partials/footer') ?>
