<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="google-signin-client_id" content="1057328742202-ikmjmc9vksnfve0c1vm78i0oopmsbdb7.apps.googleusercontent.com">
    <meta name="google-signin-scope" content="https://www.googleapis.com/auth/analytics.readonly">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="/assets/css/master.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/image/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/image/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/image/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/image/favicon/manifest.json">
    <link rel="mask-icon" href="/assets/image/favicon/safari-pinned-tab.svg" color="#be2021">
    <link rel="shortcut icon" href="/assets/image/favicon/favicon.ico">
    <meta name="msapplication-config" content="/assets/image/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <script type="text/javascript" rel="javascript" src="/assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/admin/bootstrap.min.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/chart.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/helper-functions.js"></script>
    <script type="text/javascript" rel="javascript" src="/assets/js/form-scrubber.js"></script>
  </head>
  <body>
  <div class="admin-container">
    <header>
      <?php App::view('partials/sidenav') ?>
    </header>
    <main class="admin-viewport --transition">
      <div class="container">
        <?php App::view('partials/userinfo') ?>
