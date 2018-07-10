<?php
   $page_title = "Admin | ".$news->title;
   App::view('partials/header', compact('page_title'));
   if (session('input_data'))
   {
     $news->id = session('input_data', 'id');
     $news->title = session('input_data', 'title');
     $news->published = session('input_data', 'published');
     $news->brief = session('input_data', 'brief');
     $news->body = session('input_data', 'body');
   }
 ?>
      <section class="row">
        <div class="col-md-12">
          <h3 class="--section-header">Edit News Release</h3>
        </div>
        <div class="col-md-10">
          <?php App::view('partials/errors') ?>
          <form id="create-news-form" class="news-item" method="post"
            style="letter-spacing: 0" action="/admin/news/update" enctype="multipart/form-data"
            fs--form fs--listen="<?php if (session('input_data')) echo 'now' ?>">
            <input type="hidden" name="id" value="<?= $news->id ?>">
            <div>
                <div class="form-group --responsive --active">
                  <label for="title">Title</label>
                  <input type="text" class="form-control"
                    name="title"
                    placeholder="News title"
                    fs--input="Title"
                    fs--rules="required"
                    value="<?= $news->title ?>">
                </div>
                <div class="form-group --responsive --active">
                  <label for="published">Date published</label>
                  <input type="text" class="form-control fulldate-format"
                      name="published"
                      placeholder="DD/MM/YYYY"
                      fs--input="Date published"
                      fs--rules="required|date:mdy"
                      value="<?= formatDate($news->published, 'm/d/Y') ?>">
                </div>
                <div class="form-group --responsive --textarea --active">
                  <label for="brief">Brief description</label>
                  <textarea class="form-control"
                      name="brief"
                      placeholder="News breif"
                      rows="3"
                      fs--input="News brief"
                      fs--rules="required|range:{min:60,max:200}"
                      ><?= str_replace('<br />', '', $news->brief) ?></textarea>
                </div>
                <div class="form-group --responsive --textarea --active">
                  <label for="exampleInputPassword1">Full description</label>
                  <textarea class="form-control"
                      name="body"
                      placeholder="News body"
                      rows="8"
                      fs--input="News description"
                      fs--rules="required|min:200"
                      ><?= str_replace('<br />', '', $news->body) ?></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 30px">
                  <label for="link">Replace file for download (optional)</label>
                  <div class="--file-input">
                    <button type="button" name="button" class="--transition">Choose File</button>
                    <span>No file chosen</span>
                    <input type="file" name="link" class="form-control-file">
                  </div>
                </div>
                <div class="form-group" style="margin-bottom: 30px">
                  <label for="picture">Replace image (optional)</label>
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
