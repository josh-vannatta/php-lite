<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="/assets/app.css">
  </head>
  <body>
    <div class="container">
      <?php
        Migrate::users();
        Migrate::passwordResets();
        Migrate::sessions();
        Migrate::autoLogins();
      ?>
      <h4>Hello world!</h4>
    </div>
    <script type="text/javascript" src="/assets/app.js"></script>
  </body>
</html>
