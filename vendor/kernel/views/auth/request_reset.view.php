<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="google-signin-client_id" content="1057328742202-ikmjmc9vksnfve0c1vm78i0oopmsbdb7.apps.googleusercontent.com">
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics.readonly">
    <title>Admin | Reset My Password</title>
    <link rel="stylesheet" href="/assets/css/master.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript" rel="javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/admin/bootstrap.min.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/chart.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/helper-functions.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/form-scrubber.js"></script>
  </head>
  <body class="--login-body">
    <header>
      <a href="/" class="--transition">RETURN TO MAIN SITE</a>
    </header>
    <main>
      <div class="--login-module">
        <div class="--secure">
          <i class="material-icons">lock</i>
        </div>
        <p style="text-align: center; margin-top: 10px">Enter email below and you'll recieve a reset link in your inbox shortly. </p>
        <?php App::view('partials/errors') ?>
        <form id="create-news-form" method="post"
          style="letter-spacing: 0" action="/admin/password/attempt"
          fs--form fs--listen="<?php if (session('input_data')) echo 'now' ?>">
            <div class="form-group --responsive">
              <label for="title">Email</label>
              <input type="text" class="form-control"
                name="email"
                placeholder="Email"
                fs--input="Email"
                fs--rules="required|email|user_exists"
                value="<?= session('input_data', 'email') ?>">
            </div>
            <button type="submit" class="--button-gen --transition" fs--button>Submit</button>
          </form>
          <a href="/admin" class="--link-basic" style="font-style:normal">Return to login page</a>
      </div>
    </main>
    <script type="text/javascript" rel="javascript" src="/assets/js/admin/main.js"></script>
  </body>
</html>
