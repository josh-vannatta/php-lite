<?php
   $page_title = 'Admin | Create News';
   App::view('partials/header', compact('page_title'));
   $admin = new stdClass;
   $admin->permissions = null;
 ?>
      <section class="row">
        <div class="col-md-12">
          <h3 class="--section-header">New Administrator</h3>
        </div>
        <div class="col-lg-6 col-md-8 col-sm-10">
          <p>Add a new administrator login with select permissions</p>
          <?php App::view('partials/errors') ?>
          <form id="edit-profile-form" class="news-item" method="post"
            style="letter-spacing: 0" action="/admin/system/store"
            fs--form fs--listen="<?php if (session('input_data')) echo 'now' ?>">
            <div >
                <div class="form-group --responsive">
                  <label for="title">Full name</label>
                  <input type="text" class="form-control"
                    name="name"
                    placeholder="Full name"
                    fs--input="The admin's full name"
                    fs--rules="required"
                    value="<?= session('input_data', 'name') ?>">
                </div>
                <div class="form-group --responsive">
                  <label for="published">Email address</label>
                  <input type="text" class="form-control"
                    name="email"
                    placeholder="Email address"
                    fs--input="The admin's email address"
                    fs--rules="required|email"
                    value="<?= session('input_data', 'email') ?>">
                </div>
                <?php App::view('system/edit_account', compact('admin')) ?>
                <button type="submit" style="margin: 30px 0 15px" class="--button-gen --transition" fs--button>Submit</button>
            </div>
          </form>
        </div>
    </section>
  <?php App::view('partials/footer') ?>
