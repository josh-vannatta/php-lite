<?php if(isset($_SESSION['messages'])): ?>
<div class="--feedback">
    <?php foreach ($_SESSION['messages'] as $message): ?>
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
       <?= $message ?>
      </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
