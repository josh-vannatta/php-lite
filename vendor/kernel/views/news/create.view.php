<?php
   $page_title = 'Admin | Create News';
   App::view('partials/header', compact('page_title'));
 ?>
      <section class="row">
        <div class="col-xs-12">
          <h3 class="--section-header">Create New Release</h3>
        </div>
        <div class="col-md-10">
          <p>Create a news release to display on the Home page and the News page.
            The brief will display on the Home page and the body and  downloadable file will be accessible from the Release page.</p>
          <?php App::view('partials/errors') ?>
          <form id="create-news-form" class="news-item" method="post"
            style="letter-spacing: 0" action="/admin/news/store" enctype="multipart/form-data"
            fs--form fs--listen="<?php if (session('input_data')) echo 'now' ?>">
            <div >
                <div class="form-group --responsive">
                  <label for="title">Title</label>
                  <input type="text" class="form-control"
                    name="title"
                    placeholder="News title"
                    fs--input="Title"
                    fs--rules="required"
                    value="<?= session('input_data', 'title') ?>">
                </div>
                <div class="form-group --responsive">
                  <label for="published">Date published</label>
                  <input type="text" class="form-control fulldate-format"
                    name="published"
                    placeholder="DD/MM/YYYY"
                    fs--input="Date published"
                    fs--rules="required|date:mdy"
                    value="<?= session('input_data', 'published') ?>">
                </div>
                <div class="form-group --responsive --textarea">
                  <label for="brief">Brief description</label>
                  <textarea class="form-control"
                    name="brief"
                    placeholder="News breif"
                    rows="3"
                    fs--input="News brief"
                    fs--rules="required|range:{min:60,max:200}"
                  ><?= session('input_data', 'brief') ?></textarea>
                </div>
                <div class="form-group --responsive --textarea">
                  <label for="exampleInputPassword1">Full description</label>
                  <textarea class="form-control"
                    name="body"
                    placeholder="News body"
                    rows="8"
                    fs--input="News description"
                    fs--rules="required|min:120"
                  ><?= session('input_data', 'body') ?></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 30px">
                  <label for="link">File for download (optional)</label>
                  <div class="--file-input">
                    <button type="button" name="button" class="--transition">Choose File</button>
                    <span>No file chosen</span>
                    <input type="file" name="link" class="form-control-file">
                  </div>
                </div>
                <div class="form-group" style="margin-bottom: 30px">
                  <label for="picture">News image (optional)</label>
                  <div class="--file-input">
                    <button type="button" name="button" class="--transition">Choose File</button>
                    <span>No file chosen</span>
                    <input type="file" name="picture" class="form-control-file">
                  </div>
                </div>
                <button type="submit" style="margin: 30px 0 15px" class="--button-gen --transition" fs--button>Submit</button>
            </div>
          </form>
        </div>
    </section>
  <?php App::view('partials/footer') ?>
