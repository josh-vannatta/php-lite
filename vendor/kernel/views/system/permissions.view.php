<?php $pm = unserialize($admin->permissions); ?>
<div class="col-sm-6" style="padding-left: 0">
  <?php $news = ($pm != null && in_array('news_ctrl',$pm)) ? '--active' : ''; ?>
  <div class="--permission <?= $news ?>">
    <div class="--node"></div>
    <h5 class="--no-margin">Create and modify the news</h5>
  </div>
</div>
<div class="col-sm-6" style="padding-left: 0">
  <?php $actc = ($pm != null && in_array('acct_ctrl',$pm)) ? '--active' : ''; ?>
  <div class="--permission <?= $actc ?>">
    <div class="--node"></div>
    <h5 class="--no-margin">Control administrator accounts</h5>
  </div>
</div>
<div class="col-sm-6" style="padding-left: 0">
  <?php $actv = ($pm != null && in_array('acct_view',$pm)) ? '--active' : ''; ?>
  <div class="--permission <?= $actv ?>">
    <div class="--node"></div>
    <h5 class="--no-margin">View administrator accounts</h5>
  </div>
</div>
