<?php if(isset($_SESSION['errors'])): ?>
<div class="--feedback">
    <?php foreach ($_SESSION['errors'] as $error): ?>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
       <?= $error ?>
      </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
