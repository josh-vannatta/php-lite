<body style="font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;">
<div text="#000000" bgcolor="#ffffff">
<p style="color: #000000">You have a message from: <strong><?= $request['name-first'].' '.$request['name-last'] ?></strong>
<p>
  <?php
    $message = '';
    if ($request['country'] != '') {
      $message .= 'From ';
        if ($request['city'] != '') {
        $message .= $request['city'] . ', ';
      }
      if ($request['state'] != '') {
        $message .= $request['state'] . ', ';
      }
      $message .= $request['country'];
      if ($request['organization'] != '') {
        $message .= ' with ' . $request['organization'];
      }
    }
    echo $message.'<br/>';
   ?>
</p>
<p style="color: #000000"><?= $request['message'] ?></p>
<p style="color: #000000">
  <i>Email:</i> <?= $request['email'] ?>
</p>
<?php if ($request['phone'] != ''): ?>
<p style="color: #000000">
  <i>Phone: </i> <?= $request['phone'] ?>
</p>
<?php elseif ($request['fax'] != ''): ?>
<p style="color: #000000">
  <i>Fax: </i> <?= $request['fax'] ?>
</p>
<?php elseif ($request['address'] != ''): ?>
<p style="color: #000000">
  <i>Address: </i> <?= $request['address'] ?>
</p>
<?php endif; ?>
</div>
</body>
