<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="google-signin-client_id" content="1057328742202-ikmjmc9vksnfve0c1vm78i0oopmsbdb7.apps.googleusercontent.com">
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics.readonly">
    <title>Admin | Login</title>
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
        <h3>ADMINISTRATOR</h3>
        <p style="text-align: center">Please sign in to gain access</p>
        <?php App::view('partials/errors') ?>
        <?php App::view('partials/messages') ?>
        <form id="create-news-form" method="post"
          style="letter-spacing: 0" action="/admin/login"
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
            <div class="form-group --responsive">
              <label for="title">Password</label>
              <input type="password" class="form-control"
                name="password"
                placeholder="Password"
                fs--input="Password"
                fs--rules="required"
                value="<?= session('input_data', 'password') ?>">
            </div>
            <div class="form-check" style="margin-bottom: 15px">
              <input class="form-check-input" name="remember" type="checkbox" value="" id="defaultCheck1" style="height: 12px">
              <label class="form-check-label" for="defaultCheck1">
                Remember me
              </label>
            </div>
            <button type="submit" class="--button-gen --transition" fs--button>Submit</button>
          </form>
          <a href="/admin/forgot-password" class="--link-basic" style="font-style:normal">I forgot my password</a>
      </div>
    </main>
    <script type="text/javascript" rel="javascript" src="/assets/js/admin/main.js"></script>
  </body>
</html>
